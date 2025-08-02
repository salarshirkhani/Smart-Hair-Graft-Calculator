<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\hair_pic;
use App\Models\Diagnosis;

class EstimatorController extends Controller {

    public function form() {
        $this->render('estimator/form', [ 'title' => 'فرم کاشت مو' ]);
    }

    // --- Step 1: Basic info ---
    public function handleStep1() {
        header('Content-Type: application/json');

        $gender = $_POST['gender'] ?? '';
        $age = $_POST['age'] ?? '';
        $confidence = $_POST['confidence'] ?? '';

        if (!$gender || !$age) {
            echo json_encode(['success' => false, 'message' => 'اطلاعات ناقص']);
            return;
        }

        $userModel = new User();
        $userId = $userModel->create([
            'first_name' => '',
            'last_name'  => '',
            'gender'     => $gender,
            'age'        => $age,
            'mobile'     => ''
        ]);

        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'خطا در ساخت کاربر']);
            return;
        }

        $metaModel = new UserMeta();
        $metaModel->addMeta($userId, 'confidence', $confidence, 'data');

        echo json_encode(['success' => true, 'user_id' => $userId]);
    }

    // --- Step 2: Hair loss pattern ---
    public function handleStep2() {
        header('Content-Type: application/json');

        $userId = $_POST['user_id'] ?? '';
        $lossPattern = $_POST['loss_pattern'] ?? '';

        if (!$userId || !$lossPattern) {
            echo json_encode(['success' => false, 'message' => 'اطلاعات ناقص']);
            return;
        }

        $metaModel = new UserMeta();
        $metaModel->addMeta($userId, 'loss_pattern', $lossPattern, 'data');

        echo json_encode(['success' => true]);
    }

    // --- Step 3: Photo upload ---
    public function handleStep3() {
        header('Content-Type: application/json');

        $userId = $_POST['user_id'] ?? null;
        $position = $_POST['position'] ?? '';

        if (!$userId || empty($_FILES)) {
            echo json_encode(['success' => false, 'message' => 'داده نامعتبر']);
            return;
        }

        $uploadDir = __DIR__ . '/../../public/uploads/' . $userId;
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES as $fileInfo) {
            $fileName = uniqid() . '_' . basename($fileInfo['name']);
            $targetPath = $uploadDir . '/' . $fileName;

            if (move_uploaded_file($fileInfo['tmp_name'], $targetPath)) {
                $filePath = '/uploads/' . $userId . '/' . $fileName;

                $picModel = new hair_pic();
                $picModel->insertPic((int)$userId, $filePath, $position);

                echo json_encode([
                    'success' => true,
                    'file'    => $filePath,
                    'position'=> $position
                ]);
                return;
            }
        }

        echo json_encode(['success' => false, 'message' => 'آپلود ناموفق']);
    }

    // --- Step 4: Medical questions ---
    public function handleStep4() {
        header('Content-Type: application/json');

        $userId = $_POST['user_id'] ?? '';
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'User ID لازم است']);
            return;
        }

        $metaModel = new UserMeta();
        $metaModel->addMeta($userId, 'concern', $_POST['concern'] ?? '', 'data');

        $metaModel->addMeta($userId, 'has_medical', $_POST['has_medical'] ?? 'no', 'data');
        if ($_POST['has_medical'] === 'yes') {
            $metaModel->addMeta($userId, 'scalp_conditions', $_POST['scalp_conditions'] ?? '', 'data');
            $metaModel->addMeta($userId, 'other_conditions', $_POST['other_conditions'] ?? '', 'data');
        }

        $metaModel->addMeta($userId, 'has_meds', $_POST['has_meds'] ?? 'no', 'data');
        if ($_POST['has_meds'] === 'yes') {
            $metaModel->addMeta($userId, 'meds_list', $_POST['meds_list'] ?? '', 'data');
        }

        echo json_encode(['success' => true]);
    }

    // --- Step 5: Final info + AI Diagnosis ---
    public function handleStep5() {
        header('Content-Type: application/json');

        $userId = $_POST['user_id'] ?? '';
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'User ID لازم است']);
            return;
        }

        $userModel = new User();
        $user = $userModel->findById($userId);
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'کاربر یافت نشد']);
            return;
        }

        // Update basic info
        $firstName = $_POST['first_name'] ?? '';
        $lastName  = $_POST['last_name'] ?? '';
        $mobile    = $_POST['mobile'] ?? '';
        $state     = $_POST['state'] ?? '';
        $city      = $_POST['city'] ?? '';

        global $conn;
        $conn->query("UPDATE users SET first_name='$firstName', last_name='$lastName', mobile='$mobile' WHERE id=$userId");

        $metaModel = new UserMeta();
        $metaModel->addMeta($userId, 'city', $city, 'data');
        $metaModel->addMeta($userId, 'state', $state, 'data');
        $metaModel->addMeta($userId, 'social', $_POST['social'] ?? '', 'data');

        // Gather meta and photos
        $userMeta = $metaModel->getAllMetaForUser($userId);
        $picsModel = new hair_pic();
        $pics = $picsModel->getPicsByUser($userId);

        // Build prompt and call AI
        $prompt = $this->buildPrompt($user, $userMeta, $pics);
        $aiResult = $this->callAI($prompt);

        // Store diagnosis (FIT only)
        $diagnosis = new Diagnosis();
        $diagnosis->create([
            'user_id'    => $userId,
            'method'     => 'FIT',
            'graft_count'=> $this->extractGraftCount($aiResult),
            'branch'     => 'تهران',
            'ai_result'  => $aiResult
        ]);

        echo json_encode(['success' => true, 'ai_result' => $aiResult]);
    }

    // --- Helpers ---

    private function buildPrompt($user, $meta, $pics) {
        $photoUrls = array_map(fn($p) => $_SERVER['HTTP_HOST'].$p['file'], $pics);

        return "
        You are a professional hair transplant consultant.
        Always recommend FIT technique only.

        Patient Info:
        - Gender: {$user['gender']}
        - Age: {$user['age']}
        - Hair Loss Pattern: {$meta['loss_pattern']}
        - Main Concern: {$meta['concern']}
        - Medical Conditions: {$meta['scalp_conditions']} / {$meta['other_conditions']}
        - Medications: {$meta['meds_list']}
        - Photos: ".implode(', ', $photoUrls)."

        Respond in Persian, short and professional.
        ";
    }

    private function callAI($prompt) {
        $client = \OpenAI::client(getenv('OPENAI_API_KEY'));
        $res = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are an expert hair transplant consultant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
        return $res['choices'][0]['message']['content'];
    }

    private function extractGraftCount($aiText) {
        if (preg_match('/(\\d{3,4})/', $aiText, $m)) return (int)$m[1];
        return 2500; // fallback
    }
}
