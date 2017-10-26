# pangpondpon/tswink

Generate typescript classes from Laravel models.

## Installation
Run `composer require pangpondpon/tswink`

If you're using Laravel 5.4 or below, add this to `providers` array inside config/app.php
```
TsWink\TswinkServiceProvider::class,
```
Publish the config using `php artisan vendor:publish` and select `TsWink\TswinkServiceProvider`.

Change the config to suite your project
```
<?php

return [
    // Destination of typescript classes
    'ts_classes_destination' => 'resources/assets/src/models',
];

```

## Usage
Run this artisan command
```
php artisan tswink:generate
```

The file will be in your selected directory in config file.