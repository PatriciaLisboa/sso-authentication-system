# SSO Authentication System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![OAuth](https://img.shields.io/badge/OAuth-2.0-FF6B6B?style=for-the-badge)
![OpenID Connect](https://img.shields.io/badge/OpenID_Connect-FF6B6B?style=for-the-badge)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)

A robust and secure Single Sign-On (SSO) authentication system implemented with Laravel, supporting OAuth 2.0 and OpenID Connect. This project provides a complete solution for authentication, authorization, and digital identity management.

## 🚀 Features

- **Multi-factor Authentication (MFA)**: Support for two-factor authentication using Google Authenticator
- **OAuth 2.0**: Complete implementation of the OAuth 2.0 protocol for secure authorization
- **OpenID Connect**: Support for the OpenID Connect protocol for authentication and identity management
- **OAuth Clients Management**: Intuitive interface for creating and managing OAuth clients
- **Scopes Management**: Granular permission control through OAuth scopes
- **Tokens Management**: View and revoke access tokens
- **Audit Logging**: Complete tracking of all system actions
- **Responsive Interface**: Modern and responsive design using Bootstrap 5 and Bootstrap Icons
- **Intuitive Dashboard**: Control panel with system overview and quick access to functionalities

## 🛠️ Technologies Used

- **Laravel 10**: PHP framework for web development
- **Laravel Passport**: OAuth 2.0 implementation for Laravel
- **Bootstrap 5**: CSS framework for responsive design
- **Bootstrap Icons**: Icon library for modern interface
- **Vite**: Build tool for frontend assets
- **SQLite**: Database for development (configurable for other databases)
- **PHP 8.3**: Latest PHP version with modern features

## 📋 Prerequisites

- PHP 8.3 or higher
- Composer 2.0 or higher
- Node.js 18 or higher and NPM
- Git

## 🔧 Installation

1. Clone the repository:
```bash
git clone git@github.com:PatriciaLisboa/SSO-Authentication-System.git
cd SSO-Authentication-System
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file and configure it:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure the database in the `.env` file:
```bash
DB_CONNECTION=sqlite
```

6. Create the SQLite database file:
```bash
touch database/database.sqlite
```

7. Run the migrations:
```bash
php artisan migrate
```

8. Compile the assets:
```bash
npm run build
```

9. Start the server:
```bash
php artisan serve
```

10. Access the initial setup route to create a test user and client:
```
http://127.0.0.1:8000/setup-test
```

## 🔐 Test Credentials

After running the initial setup route, you can log in with:

- **Email**: test@example.com
- **Password**: password123

## 📚 API Documentation

The system exposes standard OAuth 2.0 and OpenID Connect endpoints:

- **Authorization**: `/oauth/authorize`
- **Token**: `/oauth/token`
- **UserInfo**: `/oauth/userinfo`
- **JWKS**: `/oauth/jwks`

### API Usage Example

```bash
# Get access token
curl -X POST http://localhost:8000/oauth/token \
  -H "Content-Type: application/json" \
  -d '{
    "grant_type": "password",
    "client_id": "client-id",
    "client_secret": "client-secret",
    "username": "test@example.com",
    "password": "password123",
    "scope": "*"
  }'
```

## 🔍 Audit Logs

The system maintains a detailed record of all actions performed, including:

- Resource creation, updates, and deletion
- Authentication and authorization
- Token management
- Configuration changes

