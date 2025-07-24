<?php

namespace Drupal\drupact\Controller;

use Drupal\Core\Controller\ControllerBase;

class ConfigurationController extends ControllerBase {
    public function getFormTitleCallback(): string {
        return 'Drupact ' . $this->t('Configuration');
    }
}