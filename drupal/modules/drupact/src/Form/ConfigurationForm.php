<?php

namespace Drupal\drupact\Form;

use Drupal\drupact\Extend\core\Filesystem\Filesystem;
use Drupal\drupact\Logger;
use DirectoryIterator;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ConfigurationForm extends FormBase {
    public function getFormId(): string
    {
        return 'drupact.form.configuration';
    }

    public function buildForm(array $form, FormStateInterface $form_state): array|RedirectResponse
    {
        $fs = new Filesystem();
        $fs->walkApiDir();
        return [];
    }

    public function validateForm(array &$form, FormStateInterface $form_state): void
    {

    }

    public function submitForm(array &$form, FormStateInterface $form_state): void
    {

    }
}
