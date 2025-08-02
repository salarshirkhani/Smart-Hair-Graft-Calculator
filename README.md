# 🧑‍⚕️ Hair Transplant Estimator – Multi-Step AI Consultation Form

This project is a **multi-step form** that allows users to receive an AI-powered consultation for hair transplant procedures. By answering a few questions and uploading images, the system analyzes the data using **OpenAI GPT** and provides:

* The **recommended hair transplant technique** .
* An **estimated number of grafts** required.
* A **professional medical analysis**.

---

## 🚀 Features

* Interactive **multi-step form** with a modern and responsive UI
* **Step-by-step data saving** to the database
* **Image uploads** for different angles of the scalp
* **Medical and concern questionnaire**
* **OpenAI GPT integration** for expert analysis
* Automatic **graft estimation** stored in the database
* **PDF report generation** with jsPDF
* **Simple MVC architecture** (lightweight, no heavy frameworks)
* AJAX and LocalStorage-based **step navigation**
* Use Composer
---

## 🛠️ Tech Stack

* **Backend:** PHP (Custom MVC Pattern)
* **Frontend:** HTML5, SCSS (CSS3), JavaScript (jQuery)
* **Database:** MySQL
* **AI Integration:** [OpenAI PHP Client](https://github.com/openai-php/client)
* **PDF Generation:** jsPDF
* **Architecture:** MVC (Model–View–Controller)

---

## 🏗️ Project Structure

```
app/
│── Controllers/
│   └── EstimatorController.php     # Main controller for form handling
│
│── Models/
│   ├── User.php                    # User base information
│   ├── UserMeta.php                 # User metadata (city, concerns, etc.)
│   ├── hair_pic.php                  # Uploaded hair images
│   └── Diagnosis.php                # AI analysis and graft results
│
Core/
│   ├── Controller.php               # Base controller class
│   ├── Router.php                   # App router
│   └── OpenAIService.php            # OpenAI API service
│
public/
│   ├── uploads/                     # Uploaded user images
│   ├── assets/
│   │   ├── css/                     # Stylesheets
│   │   └── js/                      # JavaScript (form.js)
│   └── index.php                    # Entry point
│
views/
│   └── estimator/
│       └── form.php                  # Multi-step form template
│
.env                                  # Environment settings (API Key, DB)
```

---

## 🗂️ File Descriptions

* **EstimatorController.php** – Handles all steps (Step 1–5), image upload, OpenAI prompt creation, result storage, and rendering.
* **User.php** – Manages basic user data (name, mobile, gender, age).
* **UserMeta.php** – Stores user metadata (city, state, concerns, medical conditions).
* **hair_pic.php** – Handles uploaded images.
* **Diagnosis.php** – Stores final AI recommendations and graft count.
* **OpenAIService.php** – Communicates with OpenAI GPT API.
* **form.js** – Controls frontend step navigation, AJAX requests, image uploads with progress bar, displays AI results, and PDF generation.
* **form.php** – Main HTML template with multi-step structure (Intro → Pattern selection → Image upload → Medical questions → Contact info → AI result).
* **SCSS/CSS** – Modern and responsive styles for each step.

---

## 🧠 Workflow

1. **Step 0** → Introduction and tool disclaimer
2. **Step 1** → Gender and age selection → Creates initial user record
3. **Step 2** → Select hair loss pattern
4. **Step 3** → Upload images of scalp (optional)
5. **Step 4** → Medical and concern questionnaire
6. **Step 5** → Contact and final info

   * Collects all user data
   * Builds a structured AI prompt
   * Calls GPT model for expert consultation
   * Estimates graft count and stores in `Diagnosis`
7. **Step 6** → Displays AI analysis and graft count + Download PDF button

---

## 🧾 Database Schema

### `users`

| Column      | Description       |
| ----------- | ----------------- |
| id          | User ID           |
| first\_name | First name        |
| last\_name  | Last name         |
| gender      | Gender            |
| age         | Age               |
| mobile      | Mobile number     |
| created\_at | Created timestamp |

### `user_meta`

| Column      | Description              |
| ----------- | ------------------------ |
| id          | Meta ID                  |
| user\_id    | User ID                  |
| meta\_key   | Key (concern, city, ...) |
| meta\_value | Value                    |
| type        | Data type                |
| created\_at | Created timestamp        |

### `hair_pics`

| Column      | Description        |
| ----------- | ------------------ |
| id          | Picture ID         |
| user\_id    | User ID            |
| file        | File path          |
| position    | Image angle        |
| created\_at | Uploaded timestamp |

### `diagnosis`

| Column       | Description              |
| ------------ | ------------------------ |
| id           | Diagnosis ID             |
| user\_id     | User ID                  |
| method       | Recommended method (FIT) |
| graft\_count | Estimated graft count    |
| branch       | Branch (default: Tehran) |
| ai\_result   | AI analysis text         |
| created\_at  | Stored timestamp         |

---

## 🔑 OpenAI Integration

* API Key is stored in `.env`
* Uses official **openai-php/client**
* Sends a **structured medical prompt**:

```json
{
  "method": "FIT",
  "graft_count": 3000,
  "analysis": "Medical and professional hair transplant advice."
}
```

* Graft count and analysis are saved directly in the database for reporting and PDF.

---

## 🎨 Frontend Design

* Primary color: Orange `#ff6600`
* Rounded buttons with `18px` radius
* Dynamic progress bar
* Card-based form with soft shadows and white background
* Fully responsive (mobile and tablet optimized)
* Modular SCSS with variables and reusable styles

---

## 🔧 Modifying and Extending

* **Add new steps:** Add method to `EstimatorController` + update `form.js`
* **Change AI behavior:** Modify `buildPrompt` in `EstimatorController`
* **Add fields:** Update `UserMeta` + form inputs
* **Multilingual support:** Translate `views` and `form.js`
* **PDF styling:** Update jsPDF generation in `form.js`

---

## ⚙️ Installation

1. Clone repository:

   ```bash
   git clone https://github.com/yourusername/hair-transplant-estimator.git
   ```
2. Configure `.env` with database credentials and OpenAI API Key.
3. Run database migrations or import the provided SQL schema.
4. Launch the project on a PHP server (e.g., XAMPP).
5. Open the browser at `http://localhost/`.

---

## 📄 License

This project is licensed under the MIT License.

---

