$(document).ready(function () {
    console.log("📌 form.js loaded!");

    // ======== متغیرهای اصلی ========
    let userId = localStorage.getItem('userId') || null;
    let currentStep = parseInt(localStorage.getItem('currentStep')) || 0;

    const uploadPositions = {
        male: ['روبرو', 'پشت سر', 'فرق سر', 'کنار سر'],
        female: ['روبرو', 'بالای سر', 'فرق سر']
    };

    // ======== هدایت به مرحله مشخص ========
    function goToStep(step) {
        $('.step').addClass('d-none').removeClass('active');
        $('#step-' + step).removeClass('d-none').addClass('active');
        updateProgress(step);
        localStorage.setItem('currentStep', step);

        // مرحله آپلود → رندر باکس‌ها
        if (step === 3) {
            const gender = localStorage.getItem('gender');
            if (gender) {
                renderUploadBoxes(gender);
                loadUploadedThumbnails();
            } else {
                alert('جنسیت مشخص نیست. لطفاً مرحله ۱ را کامل کنید.');
                goToStep(1);
            }
        }

        if (step === 6) {
            // وقتی به نتیجه رسیدیم → پاک‌سازی مرحله ذخیره‌شده
            localStorage.removeItem('currentStep');
        }
    }

    // ======== آپدیت نوار پیشرفت ========
    function updateProgress(step) {
        $('#step-current').text(step);
        const percent = Math.floor((step / 6) * 100);
        $('#progress-bar').css('width', percent + '%');
    }

    // ======== ساخت باکس‌های آپلود ========
    function renderUploadBoxes(gender = 'male') {
        const container = $('#upload-zones');
        container.empty();

        uploadPositions[gender].forEach((label, index) => {
            const box = `
                <div class="col-12 col-lg-6">
                    <label class="upload-box" data-index="${index}" data-position="${label}">
                        <span class="d-block fw-bold mb-2">${label}</span>
                        <input type="file" name="pic${index + 1}" accept="image/*">
                        <div class="progress d-none">
                            <div class="progress-bar" style="width: 0%;"></div>
                        </div>
                        <img src="" class="thumbnail d-none">
                    </label>
                </div>
            `;
            container.append(box);
        });
    }

    // ======== بارگذاری thumbnail های ذخیره‌شده ========
    function loadUploadedThumbnails() {
        const uploads = JSON.parse(localStorage.getItem('uploadedPics') || '{}');
        for (const name in uploads) {
            const url = uploads[name];
            const $box = $(`.upload-box input[name="${name}"]`).closest('.upload-box');
            if ($box.length) {
                $box.addClass('upload-success');
                $box.find('.thumbnail').attr('src', url).removeClass('d-none');
            }
        }
    }

    // ======== شروع کار از مرحله ذخیره‌شده ========
    goToStep(currentStep);

    // ======== رویداد شروع فرم ========
    $('#agree-btn').click(function () {
        goToStep(1);
    });

    // ======== مرحله ۱: اطلاعات اولیه ========
    $('#form-step-1').on('submit', function (e) {
        e.preventDefault();

        // گرفتن gender از radio
        const gender = $('input[name="gender"]:checked').val();
        if (!gender) {
            alert('لطفاً جنسیت را انتخاب کنید');
            return;
        }

        $.post('/step1', $(this).serialize(), function (response) {
            if (response.success) {
                userId = response.user_id;
                localStorage.setItem('userId', userId);
                localStorage.setItem('gender', gender);
                goToStep(2);
            } else {
                alert(response.message || 'خطا در ارسال اطلاعات');
            }
        }, 'json');
    });

    // ======== مرحله ۲: الگوی ریزش ========
    $('#form-step-2').submit(function (e) {
        e.preventDefault();
        const data = $(this).serialize() + '&user_id=' + userId;

        $.post('/step2', data, function (response) {
            if (response.success) {
                goToStep(3);
            } else {
                alert(response.message || 'خطا در مرحله ۲');
            }
        }, 'json');
    });

    // ذخیره pattern انتخاب‌شده
    $(document).on('change', 'input[name="loss_pattern"]', function () {
        $('.pattern-option').removeClass('selected').find('.pattern-img').each(function () {
            $(this).attr('src', $(this).data('gray'));
        });

        const $selected = $(this).closest('.pattern-option');
        $selected.addClass('selected');
        $selected.find('.pattern-img').attr('src', $selected.find('.pattern-img').data('colored'));

        localStorage.setItem('loss_pattern', $(this).val());
    });

    // ======== مرحله ۳: آپلود ========
    $('#form-step-3').submit(function (e) {
        e.preventDefault();
        goToStep(4);
    });

    // آپلود فایل
    $(document).on('change', '.upload-box input[type="file"]', function () {
        const fileInput = this;
        const file = fileInput.files[0];
        if (!file) return;

        const $box = $(this).closest('.upload-box');
        const $progress = $box.find('.progress');
        const $bar = $progress.find('.progress-bar');
        const $thumb = $box.find('.thumbnail');

        const formData = new FormData();
        formData.append('user_id', localStorage.getItem('userId'));
        formData.append(fileInput.name, file);
        formData.append('position', $box.find('span').text());

        $progress.removeClass('d-none');
        $bar.css('width', '0%');

        $.ajax({
            url: '/step3',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (evt) {
                    if (evt.lengthComputable) {
                        const percent = (evt.loaded / evt.total) * 100;
                        $bar.css('width', percent + '%');
                    }
                }, false);
                return xhr;
            },

            success: function (res) {
                if (res.success) {
                    const url = res.file;

                    // نمایش thumbnail
                    $thumb.attr('src', url).removeClass('d-none');

                    // مخفی کردن progress
                    $progress.addClass('d-none');
                    $bar.css('width', '0%');

                    // افزودن کلاس موفقیت
                    $box.addClass('upload-success');

                    // ذخیره مسیر تو localStorage
                    const uploads = JSON.parse(localStorage.getItem('uploadedPics') || '{}');
                    uploads[fileInput.name] = url;
                    localStorage.setItem('uploadedPics', JSON.stringify(uploads));
                } else {
                    alert(res.message || 'خطا در آپلود');
                }
            }

        });
    });

    // ======== مرحله ۴: سوالات پزشکی ========
    $('input[name="has_medical"]').change(function () {
        $('#medical-fields').toggleClass('d-none', $(this).val() !== 'yes');
    });

    $('input[name="has_meds"]').change(function () {
        $('#meds-fields').toggleClass('d-none', $(this).val() !== 'yes');
    });

    $(document).on('change', 'input[name="has_medical"]', function () {
    // حذف کلاس active از همه
    $('input[name="has_medical"]').parent().removeClass('active');
    // اضافه کردن به گزینه انتخاب‌شده
    if ($(this).is(':checked')) {
        $(this).parent().addClass('active');
    }

    // نمایش/مخفی کردن فیلدهای بیماری
    $('#medical-fields').toggleClass('d-none', $(this).val() !== 'yes');
    });

    // تغییر استایل دکمه‌های رادیو برای مصرف دارو
    $(document).on('change', 'input[name="has_meds"]', function () {
        $('input[name="has_meds"]').parent().removeClass('active');
        if ($(this).is(':checked')) {
            $(this).parent().addClass('active');
        }

        $('#meds-fields').toggleClass('d-none', $(this).val() !== 'yes');
    });

    $('#form-step-4').submit(function (e) {
        e.preventDefault();
        const data = $(this).serialize() + '&user_id=' + userId;

        $.post('/step4', data, function (response) {
            if (response.success) {
                goToStep(5);
            } else {
                alert(response.message || 'خطا در مرحله ۴');
            }
        }, 'json');
    });

    // ======== مرحله ۵: اطلاعات تماس ========
    console.log("Binding form-step-5");
$(document).on('submit', '#form-step-5', function (e) {
    e.preventDefault();
    console.log("Step 5 submitted ✅");

    let userId = localStorage.getItem('userId'); // ← اضافه شد
    if (!userId) {
        alert('کاربر شناسایی نشد، لطفاً دوباره مراحل را شروع کنید');
        return;
    }

    let data = $(this).serialize() + '&user_id=' + userId;

    $.post('/step5', data, function (response) {
        console.log("DEBUG /step5:", response); 
        if (response.success) {
            let method = '';
            let graftCount = '';
            let analysis = '';
            let isJson = false;

            try {
                const parsed = JSON.parse(response.ai_result);
                method = parsed.method || 'FIT';
                graftCount = parsed.graft_count || '';
                analysis = parsed.analysis || '';
                isJson = true;
            } catch (e) {
                // fallback اگر JSON نبود
                analysis = response.ai_result;
                method = 'FIT';
            }

            $('#ai-result-box').html(`
                <div class="ai-result-container">
                    <h4>روش پیشنهادی: <span class="method-text">${method}</span></h4>
                    <p class="analysis-text">${analysis}</p>
                    ${graftCount ? `
                        <div class="graft-count-box">
                            <strong>تخمین تعداد گرافت:</strong> ${graftCount} گرافت
                        </div>` : ''}
                </div>
            `);

            let summary = `
                <li><strong>نام:</strong> ${response.user.first_name} ${response.user.last_name}</li>
                <li><strong>جنسیت:</strong> ${response.user.gender}</li>
                <li><strong>سن:</strong> ${response.user.age}</li>
                <li><strong>شهر:</strong> ${response.user.city}, ${response.user.state}</li>
            `;
            $('#user-summary-list').html(summary);

            goToStep(6);
        } else {
            alert(response.message);
        }
    }, 'json');

});


    // ======== دانلود PDF و ریست فرم ========
    $('#download-pdf').click(function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const resultText = $('#ai-result-box').text();
        const userSummary = $('#user-summary-list').text();

        doc.setFont("Helvetica");
        doc.text("نتیجه مشاوره کاشت مو", 10, 10);
        doc.text(resultText, 10, 20);
        doc.text("خلاصه اطلاعات:", 10, 50);
        doc.text(userSummary, 10, 60);

        doc.save("diagnosis.pdf");
    });

    // ======== دکمه برگشت به مرحله قبل ========
    $('.btn-prev').click(function () {
        const current = parseInt(localStorage.getItem('currentStep') || 1);
        const prev = Math.max(1, current - 1);
        goToStep(prev);
    });

    $(document).on('click', '#reset-form', function () {
            if (confirm('آیا مطمئن هستید که می‌خواهید فرم را از ابتدا شروع کنید؟')) {
                localStorage.clear(); // پاک کردن همه داده‌های ذخیره‌شده
                window.location.reload(); // رفرش به Step 0
            }
    });

});
