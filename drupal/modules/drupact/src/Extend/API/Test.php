<?php

namespace Drupal\drupact\Extend\API;

use Drupal\drupact\Interface\DrupactEndpointInterface;

class Test implements DrupactEndpointInterface {
    public function getEndpointId(): string
    {
        return '';
    }
}