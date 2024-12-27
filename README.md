# API Logger for Laravel

A simple Laravel package to log API requests and responses.

## Installation

You can install the package via composer:

```bash
composer require debugged/apilogger
```

## Configuration

1. Publish the migration:
```bash
php artisan vendor:publish --provider="debugged\ApiLogger\ApiLoggerServiceProvider" --tag="migrations"
```

2. Run the migrations:
```bash
php artisan migrate
```

3. Add the middleware to your `app/Http/Kernel.php` file in the `$middlewareGroups` array:

```php
protected $middlewareGroups = [
    'api' => [
        // ... other middleware
        \debugged\ApiLogger\Http\Middleware\APILog::class,
    ],
];
```

## Usage

Once installed and configured, the package will automatically log all API requests and responses to the `logs` table. Each log entry includes:

- HTTP method
- URL
- IP address
- User agent
- Request data
- Response data
- Status code
- Timestamps

## License

The MIT License (MIT).
