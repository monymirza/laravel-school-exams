
# 🎓 Laravel Exam System

This Laravel project is an online examination system designed for educational institutions. It allows **Teachers** to create exams and **Students** to take them. Scores are automatically calculated based on the answers to each question.

---

## 🛠 Features

- 👩‍🏫 **Teacher Dashboard**
  - Create and manage exams
  - Add, edit, or delete questions
  - Set exam duration and total marks
  - View results of all students

- 👨‍🎓 **Student Dashboard**
  - View available exams
  - Attempt exams within the time limit
  - Auto-submission on timeout
  - View results and scores

- 📊 **Score Calculation**
  - Automatic scoring based on correct answers
  - Per-question mark allocation
  - Instant feedback after submission

---

## 🧱 Built With

- Laravel 10+
- Blade Templates / Vue.js (if applicable)
- MySQL
- Bootstrap / Tailwind CSS

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.1+
- Composer
- MySQL
- Node.js & NPM (for frontend assets)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/laravel-exam-system.git
   cd laravel-exam-system
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Set up the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your `.env` file with database credentials.

5. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

---

## 🧪 Usage

- Register as a **Teacher** or **Student**
- Teachers can:
  - Create exams from the dashboard
  - Add multiple questions with correct answers
- Students can:
  - See available exams
  - Take exams
  - Get results after submission

---

## 👤 User Roles

| Role     | Capabilities                                      |
|----------|---------------------------------------------------|
| Teacher  | Create exams, manage questions, view results      |
| Student  | Attempt exams, view scores                        |

---

## 🗃 Database Structure (Simplified)

- **users** – Common user table (role-based)
- **exams** – Contains exams created by teachers
- **questions** – Holds questions for each exam
- **answers** – Stores student answers
- **results** – Stores score after exam submission

---

## ✅ To-Do / Future Enhancements

- Question types: MCQs, True/False, Short Answers
- Real-time countdown timer
- Export results (PDF/CSV)
- Email notifications for results
- Admin dashboard for system overview

---

## 🧑‍💻 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙌 Acknowledgements

- Laravel Documentation
- Bootstrap / Tailwind CSS
- Vue.js / Axios (if used)
