# AfterBug for Laravel

[![StyleCI](https://styleci.io/repos/128367842/shield?style=flat)](https://styleci.io/repos/66539893)
[![Total Downloads](https://poser.pugx.org/afterbug/afterbug-laravel/downloads)](https://packagist.org/packages/afterbug/afterbug-laravel)
[![Latest Stable Version](https://poser.pugx.org/afterbug/afterbug-laravel/v/stable)](https://packagist.org/packages/afterbug/afterbug-laravel)
[![Latest Unstable Version](https://poser.pugx.org/afterbug/afterbug-laravel/v/unstable)](https://packagist.org/packages/afterbug/afterbug-laravel)
[![License](https://poser.pugx.org/afterbug/afterbug-laravel/license)](https://packagist.org/packages/afterbug/afterbug-laravel)

This library detects errors and exceptions in your Laravel application and reports them to AfterBug for alerts and reporting.

## Features

- Automatically report exceptions and errors
- Send customized diagnostic data
- Attach user information to determine how many people are affected by the error.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


Either run

```
composer require afterbug/afterbug-laravel "~1.0"
```

Add `afterbug/afterbug` to your composer.json

```
"afterbug/afterbug-laravel": "~1.0"
```


## Usage

#### Register the ServiceProvider in config/app.php

```php
'providers' => [
    // ...
    AfterBug\AfterBugLaravel\AfterBugServiceProvider::class,
],
```

#### Publish the default configuration

```
php artisan vendor:publish --provider='AfterBug\AfterBugLaravel\AfterBugServiceProvider'
```

#### Add AfterBug reporting to app/Exceptions/Handler.php:

```
public function report(Exception $e)
{
    if ($this->shouldReport($e)) {
        AfterBug::catchException($e);
    }

    return parent::report($e);
}
```

#### Callbacks

Set a callback to customize the data.

```php
AfterBug::registerCallback(function ($config) {
    $config->setMetaData([
        'custom' => 'Your custom data', 
    ]);
})->catchException($e);
```

#### Add your AfterBug Api Key to .env:

AFTERBUG_API_KEY=Your_API_Key
