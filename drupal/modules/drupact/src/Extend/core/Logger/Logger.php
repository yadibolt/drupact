<?php

namespace Drupal\drupact\Extend\core\Logger;

use Drupal;

class Logger {
    public const string channel = 'Drupact';
    public const string prefix = '[DrupactLogger]';

    public function __construct() {}

    public static function insert(string $message, $tokens = []): void {
        $message = Logger::prefix . ' ' . $message;
        Drupal::logger(Logger::channel)->error($message, $tokens);
    }
}
