# 🌟 TALL Stack Chat App

![Cover Image](./cover.png)

A real-time chat application built with the **TALL stack** (TailwindCSS, Alpine.js, Laravel, Livewire).

---

## 🚀 Tech Stack

-   **Laravel 11** (with Breeze for authentication)
-   **Livewire 3** for reactive components
-   **Alpine.js** for lightweight interactivity
-   **MySQL** as the database
-   **Pusher** for real-time notifications

---

## ✨ Features

-   🔒 **Authentication**: Secure user login and registration
-   📱 **Responsive Design**: Mobile and desktop-friendly
-   📩 **Real-Time Messaging**: Instant messaging with notifications
-   ✅ **Message Read Status**: Know when your message is read
-   🗑️ **Delete Conversations**: Remove unwanted chats
-   🔍 **View Deleted Conversations**: Recover deleted chats
-   ⏱️ **Queued Notifications**: Handle broadcast notifications efficiently

---

## 🛠️ Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

    ```bash
    git clone https://github.com/your-username/repo-name.git
    cd repo-name
    ```

2. **Install Dependencies**

    ```bash
    composer install
    ```

3. **Set Up Environment**

    - Copy the example `.env` file:
        ```bash
        cp .env.example .env
        ```
    - Create a database and update the `.env` file with your DB credentials and Pusher settings.

4. **Run Migrations and Seeders**

    ```bash
    php artisan migrate --seed
    ```

5. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6. **Install Frontend Dependencies**

    ```bash
    npm install && npm run dev
    ```

7. **Start the Queue Worker**

    ```bash
    php artisan queue:work
    ```

8. **Serve the Application**
    ```bash
    php artisan serve
    ```

---

## 🧑‍💻 Getting Started

After setup, choose a user from the seeded database and log in to explore the app! 🎉

---

Feel free to contribute or report issues. Star ⭐ the repo if you find it helpful!
