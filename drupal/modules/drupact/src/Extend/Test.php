<?php

namespace Drupal\drupact\Extend\API;

use Drupal\drupact\Interface\IEndpoint;

class Test implements IEndpoint {
    public function getEndpointId(): string
    {
        return '';
    }
}
