<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Prottasha website starter

A reusable Laravel 13 + Blade starting point with responsive public pages, registration, login/remember-me, email verification, password recovery, a verified-user dashboard, profile and password settings, account deletion, and a database-backed contact form. Authentication uses Laravel's session guard and password broker. Forms include CSRF protection, validation, and throttling for sensitive actions.

### Run locally

1. Run `composer install`.
2. On a new copy, copy `.env.example` to `.env`, configure your database, and run `php artisan key:generate`. Never replace an existing application key.
3. Run `php artisan migrate`.
4. Run `php artisan serve`, then open `http://localhost:8000` and register an account.

The starter's stylesheet is served directly from `public/css/site.css`; Node and a Vite build are not required for these pages. Google Fonts is optional, with local font fallbacks.

### Configure and extend

- Set `APP_NAME`, `APP_URL`, `SITE_NAME`, and `SITE_EMAIL` in `.env`. The branding defaults and description live in `config/site.php`.
- Shared layout: `resources/views/layouts/app.blade.php`; public pages: `resources/views/pages`; authentication pages: `resources/views/auth`; routes: `routes/web.php`.
- In local development, `MAIL_MAILER=log` writes verification and password reset links to `storage/logs/laravel.log`. Configure SMTP before sending real mail. Set `APP_URL` to the actual site URL before generating email links.
- Contact messages are saved in the `contact_messages` table. An admin inbox, message email notifications, payments, and business-specific features are not included.
- Privacy and Terms pages are explicitly marked starter templates. Replace them, the About copy, and the example contact address before launch.
- Add new member pages to the `auth` / `auth.session` route group and apply `verified` where needed. There is no default administrator account.
- Use `APP_DEBUG=false` and HTTPS in production. Never commit `.env`.

### Tests

Run `php artisan test`. Tests use an isolated SQLite in-memory database and need the PDO SQLite extension. With the current local PHP installation, use `php -d extension=pdo_sqlite vendor/phpunit/phpunit/phpunit` to enable it just for the test process. The feature tests cover account access, verification signatures, password reset tokens, validation, throttling, profile updates, account deletion, and contact submission.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
