<?php

namespace Drupal\drupact\Extend\core\Endpoint;

interface IEndpoint {
    public function getEndpointId(): string;
    public function getEndpointName(): string;
    public function getEndpointPath(): string;
}
