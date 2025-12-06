# Tinder-like API (Laravel 12)

A simple Tinder-like backend API built with Laravel 12.  
Features include listing people, liking/disliking interactions, and viewing liked people.  
Swagger/OpenAPI is integrated for interactive API documentation.

---

## 🚀 Features
- List recommended people with pagination (`/api/tinder`)
- Like or dislike a person (`/api/tinder/interact`)
- View liked people (`/api/liked`)
- Popularity alert via email when a person exceeds 50 likes
- Swagger UI documentation (`/api/documentation`)

---

## 🛠️ Requirements
- PHP >= 8.2
- Composer
- Laravel 12
- MySQL/MariaDB
- Node.js & npm (optional, for frontend integration)

---

## ⚙️ Installation

1. Clone repository:
   ```bash
   git clone https://github.com/yourusername/php_tinder_app.git
   cd php_tinder_app
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy `.env` file and configure database:
   ```bash
   cp .env.example .env
   ```

   Set the following in `.env`:
   ```
   DB_DATABASE=php_tinder_app
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

4. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

5. Start local server:
   ```bash
   php artisan serve
   ```

---

## 🗄️ Database Details

**Database name:** `php_tinder_app`

### Tables

#### `people`
| Column     | Type      | Description                        |
|------------|-----------|------------------------------------|
| id         | INT (PK)  | Auto-increment primary key         |
| name       | VARCHAR   | Person's name                      |
| age        | INT       | Person's age                       |
| pictures   | JSON      | Array of picture URLs              |
| location   | VARCHAR   | Person's location (city, country)  |
| created_at | TIMESTAMP | Record creation time               |
| updated_at | TIMESTAMP | Record update time                 |

#### `interactions`
| Column     | Type      | Description                        |
|------------|-----------|------------------------------------|
| id         | INT (PK)  | Auto-increment primary key         |
| person_id  | INT (FK)  | References `people.id`             |
| type       | ENUM      | Interaction type (`like`, `dislike`) |
| created_at | TIMESTAMP | Record creation time               |
| updated_at | TIMESTAMP | Record update time                 |

---

## 📚 API Documentation

Swagger UI is available at:
```
http://127.0.0.1:8000/api/documentation
```

OpenAPI spec file is located at:
```
docs/openapi.yaml
```

---

## 🧪 Example Seeder

Seeder file: `database/seeders/PersonSeeder.php`

```php
$data = [
    [
        'name' => 'John Smith',
        'age' => 30,
        'pictures' => json_encode([
            'https://example.com/images/john1.jpg',
            'https://example.com/images/john2.jpg'
        ]),
        'location' => 'New York, USA'
    ],
    [
        'name' => 'Emily Johnson',
        'age' => 28,
        'pictures' => json_encode([
            'https://example.com/images/emily1.jpg'
        ]),
        'location' => 'Los Angeles, USA'
    ],
    [
        'name' => 'Michael Brown',
        'age' => 26,
        'pictures' => json_encode([
            'https://example.com/images/michael1.jpg',
            'https://example.com/images/michael2.jpg'
        ]),
        'location' => 'Chicago, USA'
    ],
];
```

---

## 📧 Popularity Alert

When a person receives more than 50 likes, an email notification is sent to:
```
admin@tinder.com
```

---

## 📝 License
This project is licensed under the MIT License.
```