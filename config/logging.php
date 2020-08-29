<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['slack-error', 'slack-warning', 'slack-info', 'daily'],
            'ignore_exceptions' => true,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'slack-error' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL_ERROR'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'error',
        ],

        'slack-warning' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL_WARNING'),
            'username' => 'Laravel Log',
            'emoji' => ':warning:',
            'level' => 'warning',
        ],

        'slack-info' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL_INFO'),
            'username' => 'Laravel Log',
            'emoji' => ':information_source:',
            'level' => 'info',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'telegram_errors' => [
            'driver' => 'daily',
            'days' => 7,
            'bubble' => false,
            'level' => 'error',
            'path' => storage_path('logs/telegram_errors.log'),
        ],

        'telegram_info' => [
            'driver' => 'daily',
            'days' => 7,
            'bubble' => false,
            'level' => 'debug',
            'path' => storage_path('logs/telegram_info.log'),
        ],
    ],

];
