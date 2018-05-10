# AfterBug for PHP

[![StyleCI](https://styleci.io/repos/131471848/shield?style=flat)](https://styleci.io/repos/66539893)
[![Total Downloads](https://poser.pugx.org/afterbug/afterbug/downloads)](https://packagist.org/packages/afterbug/afterbug)
[![Latest Stable Version](https://poser.pugx.org/afterbug/afterbug/v/stable)](https://packagist.org/packages/afterbug/afterbug)
[![Latest Unstable Version](https://poser.pugx.org/afterbug/afterbug/v/unstable)](https://packagist.org/packages/afterbug/afterbug)
[![License](https://poser.pugx.org/afterbug/afterbug/license)](https://packagist.org/packages/afterbug/afterbug)

This library detects errors and exceptions in your PHP application and reports them to AfterBug for alerts and reporting.

## Features

- Automatically report exceptions and errors
- Send customized diagnostic data
- Attach user information to determine how many people are affected by the error.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


Either run

```
composer require afterbug/afterbug "~1.0"
```

Add `afterbug/afterbug` to your composer.json

```
"afterbug/afterbug": "~1.0"
```


## Usage

```php
$afterbug = AfterBug\Client::make('AFTERBUG_API_KEY')

// Register AfterBug error handler
AfterBug\Exceptions\ErrorHandler::register($afterbug);

// will be reported by the exception handler
throw new \Exception('testing exception handler');
```

### Callbacks

Set a callback to customize the data.

```php
$afterbug->registerCallback(function ($config) {
    $config->setEnvironment('Production')
        ->setUser([
            'id' => 1,
            'name' => 'Alfa'
        ])
        ->setMetaData([
            'custom' => 'Your custom data'
        ]);
});
```

## Integration with frameworks

Other packages exists to integrate this SDK into the most common frameworks.

### Official Integrations

The following integrations are supported by AfterBug team.

- [Laravel](https://github.com/AfterBug/afterbug-laravel)
- [Yii Framework](https://github.com/AfterBug/afterbug-yii)
- Feel free to create a port to your favorite framework!
