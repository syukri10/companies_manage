# Manage Companies System (Laravel 12)

## ⚙️ Requirements

- PHP Version >= 8.2 ([Download PHP](https://www.php.net/downloads.php))  
- Composer ([Install Composer](https://getcomposer.org))  
- Laravel 12  
- A web server (Apache, Nginx) or Laravel's built-in server  (Laragon)

## 📦 Installation (Step-by-Step)

Follow these steps to set up the project locally:

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/syukri10/companies_manage.git
cd companies_manage
```

### 2️⃣ Install PHP Dependencies with Composer

Make sure Composer is installed.

If this is your first time setting up the project:
```bash
composer install
```
If you've already installed it before and are updating:
```bash
composer update
```

### 3️⃣ Copy Environment File

Create a .env file based on the example:

```bash
cp .env.example .env
```

### 4️⃣ Migrate Database and Seeder

Open your .env file and update the following lines:

```bash
php artisan migrate --seed
```


### 5️⃣ Storage Link

```bash
php artisan storage:link
```

### 6️⃣ Generate the Application Key

```bash
php artisan key:generate
```

### 7️⃣ Start the Development Server

```bash
php artisan serve
```
Then visit the app at:

```arduino
http://localhost:8000
```
### 8️⃣ Log in to The System!
Email:
```bash
admin@gmail.com
```
Password:
```bash
password
```

## ✅ You're Ready!
Open your browser and enjoy your personal TODO list manager!
Tasks will be saved during your session and cleared when you close the browser tab or go inactive.
