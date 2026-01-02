# 🌟 TALL Stack Chat App

![Cover Image](./cover.png)

A modern, real-time chat application built with the **TALL stack** (TailwindCSS, Alpine.js, Laravel, Livewire). This application demonstrates advanced real-time messaging capabilities with user authentication, message read receipts, conversation management, and a responsive design.

-   [View Realtime Messaging Flow](REALTIME_FLOW.md)

## 📖 **Table of Contents**

-   [🌟 Features](#-features)
-   [🚀 Tech Stack](#-tech-stack)
-   [🏗️ Architecture Overview](#️-architecture-overview)
-   [📋 Prerequisites](#-prerequisites)
-   [🛠️ Installation](#️-installation)
-   [⚙️ Configuration](#️-configuration)
-   [🧑‍💻 Getting Started](#-getting-started)
-   [🔧 Development Tools](#-development-tools)
-   [📊 Database Schema](#-database-schema)
-   [🌐 API Endpoints](#-api-endpoints)
-   [🚀 Deployment](#-deployment)
-   [🐳 Docker Support](#-docker-support)
-   [🔧 Troubleshooting](#-troubleshooting)
-   [🤝 Contributing](#-contributing)
-   [📝 License](#-license)

---

## 🚀 Tech Stack

### 🔧 **Backend**

-   **Laravel 11** - PHP framework with latest features
-   **Laravel Breeze** - Authentication scaffolding
-   **Livewire 3** - Full-stack reactive components
-   **Livewire Volt** - Single-file components
-   **Pusher PHP Server** - Real-time broadcasting
-   **Laravel Telescope** - Application monitoring and debugging

### 🎨 **Frontend**

-   **TailwindCSS** - Utility-first CSS framework
-   **Alpine.js** - Lightweight JavaScript framework
-   **Vite** - Modern build tool and dev server
-   **Pusher JS** - WebSocket client for real-time features

### 🗄️ **Database**

-   **SQLite** (default) - Lightweight, serverless database
-   **MySQL/PostgreSQL** - Alternative database options
-   **Eloquent ORM** - Laravel's database abstraction

### 🔧 **Development Tools**

-   **Pest** - Modern testing framework
-   **Laravel Pint** - Code style fixer
-   **Composer** - PHP dependency management
-   **npm** - JavaScript package management
-   **Concurrently** - Run multiple commands simultaneously

### 📡 **Broadcasting & Queues**

-   **Pusher Channels** - Real-time WebSocket service
-   **Laravel Echo** - WebSocket client wrapper
-   **Database Queue Driver** - Job queue management
-   **Laravel Notifications** - Multi-channel notifications

---

## 🏗️ Architecture Overview

### 📱 **Application Structure**

```
app/
├── Http/Controllers/     # HTTP request handlers
├── Livewire/            # Livewire components
│   ├── Chat/           # Chat-related components
│   ├── Forms/          # Form components
│   └── Actions/        # User actions
├── Models/             # Eloquent models
│   ├── User.php       # User model with relationships
│   ├── Conversation.php # Conversation model
│   └── Message.php     # Message model
├── Notifications/      # Notification classes
└── View/Components/    # Blade components
```

### 🔄 **Real-Time Flow**

1. **User sends message** → Livewire component processes
2. **Message saved** → Database stores message
3. **Notification dispatched** → Queue job created
4. **Pusher broadcasts** → WebSocket sends to receiver
5. **Real-time update** → Receiver's UI updates instantly
6. **Read receipt** → Automatic read status when viewed

### 🌐 **Component Architecture**

-   **Chat Index** - Conversation list and user selection
-   **Chat Component** - Individual conversation view
-   **Message Form** - Message input and sending
-   **Users Component** - User listing and management
-   **Authentication** - Login/register workflows

---

## ✨ Features

### 🔐 **Authentication & User Management**

-   **Secure Registration & Login** with Laravel Breeze
-   **Email Verification** support
-   **Password Reset** functionality
-   **User Profile Management**
-   **10 Seeded Test Users** for development

### 💬 **Real-Time Messaging**

-   **Instant Messaging** with Pusher WebSocket integration
-   **Real-Time Message Delivery** with live updates
-   **Message Read Receipts** - see when messages are read
-   **Typing Indicators** (visual feedback)
-   **Message Pagination** - load older messages on demand
-   **Auto-scroll** to latest messages

### 🗨️ **Conversation Management**

-   **Private One-on-One Chats**
-   **Conversation List** with last message preview
-   **Unread Message Counter** per conversation
-   **Soft Delete Conversations** (recoverable)
-   **View Deleted Conversations** functionality
-   **Conversation History** preservation

### 📱 **User Experience**

-   **Fully Responsive Design** (mobile, tablet, desktop)
-   **Modern UI** with TailwindCSS
-   **Real-time Updates** without page refresh
-   **Optimistic UI Updates**
-   **Loading States** and smooth animations
-   **Keyboard Shortcuts** support

### ⚡ **Performance & Reliability**

-   **Queued Notifications** for efficient broadcasting
-   **Database Optimization** with proper indexing
-   **Lazy Loading** of messages
-   **Caching Strategies** for better performance
-   **Error Handling** with user-friendly messages

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

-   **PHP 8.2+**
-   **Composer**
-   **Node.js** (18+ recommended)
-   **npm**

---

## 🛠️ Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

    ```bash
    git clone <your-repository-url>
    cd <your-project-directory>
    ```

2. **Install PHP Dependencies**

    ```bash
    composer install
    ```

3. **Install Frontend Dependencies**

    ```bash
    npm install
    ```

4. **Set Up Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure Database & Broadcasting**

    The project uses SQLite by default (no additional setup needed). To use MySQL/PostgreSQL, update your `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

    For real-time features, configure Pusher in your `.env`:

    ```env
    PUSHER_APP_ID=your_app_id
    PUSHER_APP_KEY=your_app_key
    PUSHER_APP_SECRET=your_app_secret
    PUSHER_APP_CLUSTER=your_app_cluster
    ```

6. **Run Database Migrations and Seeders**

    ```bash
    php artisan migrate --seed
    ```

7. **Start Development Environment**

    **Option A: Quick Start (All services at once)**

    ```bash
    composer run dev
    ```

    This starts the server, queue worker, logs, and Vite dev server simultaneously.

    **Option B: Manual Start (Individual services)**

    ```bash
    # Terminal 1: Start the server
    php artisan serve

    # Terminal 2: Start the queue worker
    php artisan queue:work

    # Terminal 3: Start Vite dev server
    npm run dev
    ```

---

## ⚙️ Configuration

### 🔧 **Environment Variables**

#### **Application Settings**

```env
APP_NAME="TALL Chat App"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=UTC
```

#### **Database Configuration**

```env
# SQLite (Default - No additional setup needed)
DB_CONNECTION=sqlite

# MySQL Alternative
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tall_chat
DB_USERNAME=root
DB_PASSWORD=your_password

# PostgreSQL Alternative
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tall_chat
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

#### **Pusher Real-Time Configuration**

```env
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1
```

#### **Queue & Cache Settings**

```env
QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database
```

#### **Mail Configuration**

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@tallchat.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 🌐 **Pusher Setup Guide**

1. **Create Pusher Account** at [pusher.com](https://pusher.com)
2. **Create new Channels app**
3. **Copy credentials** to your `.env` file
4. **Enable client events** in Pusher dashboard
5. **Test connection** with `php artisan tinker`

### 🔒 **Security Configuration**

#### **CORS Settings** (if needed for API)

```env
SANCTUM_STATEFUL_DOMAINS=localhost:3000,127.0.0.1:3000
```

#### **Session Configuration**

```env
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_SECURE_COOKIE=false
```

---

## 🧑‍💻 Getting Started

After setup, the application will be available at `http://localhost:8000`. You can:

1. **Register a new account** or **login with seeded users**
2. **Start chatting** with other users in real-time
3. **Explore features** like message read status and conversation management

The database is seeded with 10 test users for development.

---

## 🔧 Development Tools

### 🔍 **Debugging & Monitoring**

-   **Laravel Telescope**: Available at `/telescope` for debugging and monitoring
-   **Laravel Pail**: Real-time log monitoring with `php artisan pail`
-   **Debug Bar**: Database queries and performance metrics
-   **Queue Monitoring**: Use `php artisan queue:work --verbose` for detailed output

### 🧪 **Testing & Quality**

-   **Run Tests**: `./vendor/bin/pest`
-   **Test Coverage**: `./vendor/bin/pest --coverage`
-   **Code Style**: `./vendor/bin/pint` (auto-fix)
-   **Code Analysis**: `./vendor/bin/phpstan analyse` (if installed)

### ⚡ **Development Commands**

```bash
# Quick development setup (all services)
composer run dev

# Individual commands
php artisan serve                    # Start web server
php artisan queue:work              # Process background jobs
php artisan pail                    # Monitor logs
npm run dev                         # Start Vite dev server
npm run build                       # Build for production

# Database commands
php artisan migrate:fresh --seed    # Reset database with test data
php artisan tinker                  # Interactive PHP shell
php artisan route:list              # Show all routes

# Cache commands
php artisan config:cache            # Cache configuration
php artisan route:cache             # Cache routes
php artisan view:cache              # Cache views
php artisan cache:clear             # Clear application cache
```

---

## 📊 Database Schema

### 👥 **Users Table**

```sql
- id (Primary Key)
- name (String)
- email (String, Unique)
- email_verified_at (Timestamp, Nullable)
- password (String, Hashed)
- remember_token (String, Nullable)
- created_at (Timestamp)
- updated_at (Timestamp)
```

### 💬 **Conversations Table**

```sql
- id (Primary Key)
- sender_id (Foreign Key → users.id)
- receiver_id (Foreign Key → users.id)
- deleted_at (Timestamp, Nullable) # Soft Deletes
- created_at (Timestamp)
- updated_at (Timestamp)
```

### 📝 **Messages Table**

```sql
- id (Primary Key)
- conversation_id (Foreign Key → conversations.id)
- sender_id (Foreign Key → users.id)
- receiver_id (Foreign Key → users.id)
- body (Text) # Message content
- read_at (Timestamp, Nullable) # Read receipt
- sender_deleted_at (Timestamp, Nullable) # Soft delete for sender
- receiver_deleted_at (Timestamp, Nullable) # Soft delete for receiver
- created_at (Timestamp)
- updated_at (Timestamp)
```

### 🔗 **Relationships**

-   **User** has many **Conversations** (as sender or receiver)
-   **Conversation** has many **Messages**
-   **Message** belongs to **Conversation**, **Sender**, and **Receiver**

---

## 🌐 API Endpoints

### 🔐 **Authentication Routes**

```
GET  /login              # Login form
POST /login              # Process login
GET  /register           # Registration form
POST /register           # Process registration
POST /logout             # Logout user
GET  /forgot-password    # Password reset form
POST /forgot-password    # Send reset email
GET  /reset-password     # Reset password form
POST /reset-password     # Process password reset
```

### 💬 **Chat Routes**

```
GET  /chat               # Chat index (conversation list)
GET  /chat/{conversation} # Individual conversation view
GET  /users              # User listing for starting conversations
```

### 📡 **WebSocket Channels**

```
Private Channel: users.{user_id}     # User-specific notifications
Private Channel: App.Models.User.{id} # User model updates
```

### 🔔 **Livewire Components**

-   **Chat\Index** - Main chat interface with conversation list
-   **Chat\Chat** - Individual conversation component
-   **Chat\MessageForm** - Message input and sending
-   **Chat\ChatList** - Conversation list management
-   **Users** - User selection for new conversations

---

## 🚀 Deployment

### 🌐 **Production Deployment**

#### **Server Requirements**

-   **PHP 8.2+** with extensions: mbstring, xml, ctype, json, fileinfo, openssl, pdo, tokenizer
-   **Composer** for dependency management
-   **Node.js 18+** and npm for asset building
-   **Web server** (Apache/Nginx)
-   **Database** (MySQL 8.0+, PostgreSQL 13+, or SQLite)
-   **Redis** (recommended for sessions/cache in production)

#### **Deployment Steps**

```bash
# 1. Clone and setup
git clone <your-repo-url> tall-chat-app
cd tall-chat-app

# 2. Install dependencies
composer install --optimize-autoloader --no-dev
npm ci && npm run build

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Configure production environment
# Edit .env with production values:
# APP_ENV=production
# APP_DEBUG=false
# DB_* settings
# PUSHER_* settings

# 5. Database setup
php artisan migrate --force

# 6. Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### **Web Server Configuration**

**Nginx Example:**

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/tall-chat-app/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 🔄 **Queue Worker Setup**

```bash
# Install supervisor for queue management
sudo apt install supervisor

# Create supervisor config: /etc/supervisor/conf.d/tall-chat-queue.conf
[program:tall-chat-queue]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/tall-chat-app/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/path/to/tall-chat-app/storage/logs/worker.log

# Start supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start tall-chat-queue:*
```

---

## 🐳 Docker Support

### 🏗️ **Docker Setup**

A Dockerfile is included for containerized deployment:

```bash
# Build the image
docker build -t tall-chat-app .

# Run with environment variables
docker run -d \
  -p 8000:8000 \
  -e APP_KEY=your_app_key \
  -e DB_CONNECTION=sqlite \
  -e PUSHER_APP_ID=your_pusher_id \
  -e PUSHER_APP_KEY=your_pusher_key \
  -e PUSHER_APP_SECRET=your_pusher_secret \
  -e PUSHER_APP_CLUSTER=your_cluster \
  --name tall-chat \
  tall-chat-app
```

### 🐙 **Docker Compose**

```yaml
version: "3.8"
services:
    app:
        build: .
        ports:
            - "8000:8000"
        environment:
            - APP_ENV=production
            - APP_KEY=${APP_KEY}
            - DB_CONNECTION=mysql
            - DB_HOST=db
            - DB_DATABASE=tall_chat
            - DB_USERNAME=root
            - DB_PASSWORD=secret
        depends_on:
            - db
            - redis

    db:
        image: mysql:8.0
        environment:
            - MYSQL_ROOT_PASSWORD=secret
            - MYSQL_DATABASE=tall_chat
        volumes:
            - mysql_data:/var/lib/mysql

    redis:
        image: redis:alpine

volumes:
    mysql_data:
```

---

## 🔧 Troubleshooting

### ❗ **Common Issues**

#### **WebSocket Connection Issues**

```bash
# Check Pusher credentials
php artisan tinker
>>> broadcast(new App\Events\TestEvent());

# Verify Pusher configuration
php artisan config:clear
php artisan cache:clear
```

#### **Queue Jobs Not Processing**

```bash
# Check queue table
php artisan queue:table
php artisan migrate

# Restart queue worker
php artisan queue:restart
php artisan queue:work --verbose
```

#### **Database Connection Errors**

```bash
# SQLite permission issues
sudo chmod 666 database/database.sqlite
sudo chmod 777 database/

# MySQL connection issues
php artisan migrate:status
```

#### **Assets Not Loading**

```bash
# Clear compiled views
php artisan view:clear

# Rebuild assets
npm run build
```

### 🐛 **Debug Mode**

```env
# Enable debug mode in .env
APP_DEBUG=true
LOG_LEVEL=debug

# Monitor logs
php artisan pail
tail -f storage/logs/laravel.log
```

### 📊 **Performance Issues**

```bash
# Clear all caches
php artisan optimize:clear

# Enable caching
php artisan optimize
```

---

## 🤝 Contributing

We welcome contributions to improve the TALL Stack Chat App! Here's how you can help:

### 🔄 **Development Workflow**

1. **Fork the Repository**

```bash
git clone https://github.com/your-username/tall-chat-app.git
cd tall-chat-app
```

2. **Create a Feature Branch**

```bash
git checkout -b feature/amazing-feature
```

3. **Set Up Development Environment**

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

4. **Make Your Changes**

    - Follow PSR-12 coding standards
    - Write tests for new features
    - Update documentation as needed

5. **Test Your Changes**

```bash
./vendor/bin/pest
./vendor/bin/pint
```

6. **Commit and Push**

```bash
git add .
git commit -m "Add amazing feature"
git push origin feature/amazing-feature
```

7. **Create Pull Request**

### 📝 **Contribution Guidelines**

#### **Code Style**

-   Follow **PSR-12** PHP coding standards
-   Use **Laravel conventions** for naming and structure
-   Run `./vendor/bin/pint` before committing
-   Write **clear, descriptive commit messages**

#### **Testing Requirements**

-   Add **tests** for new features
-   Ensure **existing tests pass**
-   Maintain **test coverage** above 80%
-   Test both **happy path** and **edge cases**

#### **Documentation**

-   Update **README.md** for new features
-   Add **inline comments** for complex logic
-   Update **API documentation** if applicable
-   Include **usage examples**

### 🐛 **Bug Reports**

When reporting bugs, please include:

-   **PHP/Laravel version**
-   **Steps to reproduce**
-   **Expected vs actual behavior**
-   **Error logs/screenshots**
-   **Environment details**

### 💡 **Feature Requests**

For new features, please:

-   **Check existing issues** first
-   **Describe the use case**
-   **Explain the proposed solution**
-   **Consider backward compatibility**

### 🏆 **Recognition**

Contributors will be:

-   **Listed in CONTRIBUTORS.md**
-   **Credited in release notes**
-   **Mentioned in documentation**

---

## 📚 Additional Resources

### 📖 **Learning Resources**

-   [Laravel Documentation](https://laravel.com/docs)
-   [Livewire Documentation](https://livewire.laravel.com)
-   [TailwindCSS Documentation](https://tailwindcss.com/docs)
-   [Pusher Channels Documentation](https://pusher.com/docs/channels)
-   [Pest Testing Framework](https://pestphp.com)

### 🛠️ **Development Tools**

-   [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
-   [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
-   [PHPStan](https://phpstan.org) for static analysis
-   [Larastan](https://github.com/nunomaduro/larastan) for Laravel-specific analysis

### 🌐 **Community**

-   [Laravel Community](https://laravel.com/community)
-   [Livewire Discord](https://discord.gg/livewire)
-   [PHP Developers Community](https://phpdeveloper.org)

---

## 📄 **Changelog**

### Version 1.0.0 (Latest)

-   ✅ Initial release with core chat functionality
-   ✅ Real-time messaging with Pusher
-   ✅ User authentication with Laravel Breeze
-   ✅ Message read receipts
-   ✅ Conversation management
-   ✅ Responsive design
-   ✅ Docker support
-   ✅ Comprehensive testing suite

### Roadmap

-   🔜 **Group Chat Support**
-   🔜 **File/Image Sharing**
-   🔜 **Message Search**
-   🔜 **Emoji Reactions**
-   🔜 **Voice Messages**
-   🔜 **Dark Mode Theme**

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 Acknowledgments

-   **Laravel Team** for the amazing framework
-   **Livewire Team** for making real-time PHP applications simple
-   **TailwindCSS** for the utility-first CSS framework
-   **Pusher** for reliable WebSocket infrastructure
-   **Open Source Community** for continuous inspiration

---

## 📞 Support

If you find this project helpful:

-   ⭐ **Star the repository**
-   🐛 **Report bugs** via GitHub issues
-   💡 **Suggest features** via GitHub discussions
-   🤝 **Contribute** via pull requests
-   📢 **Share** with the community

**Happy Coding! 🚀**
