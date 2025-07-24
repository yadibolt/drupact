<?php

namespace Drupal\drupact;

use Drupal;

class Logger {
    public const channel = 'Drupact';
    public const prefix = '[DrupactLogger]';

    public function __construct() {
    }

    public static function insert(string $message, $tokens = []): void {
        $message = Logger::prefix . ' ' . $message;
        Drupal::logger(Logger::channel)->error($message, $tokens);
    }
}