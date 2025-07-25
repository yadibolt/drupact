<?php

namespace Drupal\drupact\Extend\API;

use Drupal\drupact\Extend\core\Endpoint\IEndpoint;

class Test implements IEndpoint {
    public function getEndpointId(): string
    {
        return '';
    }

    public function getEndpointName(): string
    {
        return '';
    }

    public function getEndpointPath(): string
    {
        return '';
    }
}
