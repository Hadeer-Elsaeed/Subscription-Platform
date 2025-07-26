# Subscription-Platform

This is a simple Laravel-based RESTful API that allows users to subscribe to websites and receive emails when new posts are published.

## Requirements

- PHP 8.2+
- Composer
- MySQL
- Mail configuration (.env)

---

## Installation & Setup

```bash
# 1. Clone the repo
git clone Subscription-Platform
cd web-subscriptions

# 2. Install dependencies
composer install

# 3. Set up environment
cp .env.example .env
php artisan key:generate

4. Configure your .env file
- Set DB credentials
- Set MAIL credentials ("I used Mailtrap")

# 5. Run migrations and seed data
php artisan migrate --seed

# 6. Run the queue worker (in separate terminal)
php artisan queue:work

# 7. Start the server
php artisan serve

```


## API Endpoints

### 1- Subscribe to a Website

```bash
POST http://localhost:8000/api/websites/{website_id}/subscribe

body
{
    "user_id" : 1
}
```

### 2- Create a Post for a Website

```bash
POST http://localhost:8000/api/websites/{website_id}/posts

body 
{
    "title" : "post1",
    "description": "There is the first post to test"
}
```

### Send Emails to Subscribers
This command checks for all new posts and sends them to subscribers using queued jobs.

```bash
php artisan SendPostsEmails
```

- It will only send posts that haven’t already been sent to a subscriber.

- It uses the Laravel queue system (make sure queue:work is running).

- Emails include post title and description.

### Seeded Data

5 Websites

10 Users

10 Posts

Sample pivot data between users and websites

```bash
php artisan migrate:fresh --seed

```

### Postman Collection

It's added here in the repo, with file name "web-sub.postman_collection.json"