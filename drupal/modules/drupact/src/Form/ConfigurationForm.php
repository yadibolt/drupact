<?php

namespace Drupal\drupact\Form;

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
        $this->scanModuleDirectory();
        return [];
    }

    public function validateForm(array &$form, FormStateInterface $form_state): void
    {

    }

    public function submitForm(array &$form, FormStateInterface $form_state): void
    {

    }

    protected function scanModuleDirectory() {
        $class_path = 'Drupal\drupact\Extend\API\\';
        $interface_path = 'Drupal\drupact\Interface\\';
        $directory_path = __DRUPACT_ROOT__ . '\src\Extend\API';


        foreach(new DirectoryIterator($directory_path) as $file_info) {
            if ($file_info->isFile() && $file_info->getExtension() === 'php') {
                $file_name = str_replace('.php', '', $file_info->getFilename());

                $file_path = $file_info->getPathname();
                $file_classes = $this->getFileClassNames($file_path);

                if (!in_array($class_path . $file_name, $file_classes)) {
                    Logger::insert('@filename.php does not have the right classname: @classname', [
                        '@filename' => $file_name,
                        '@classname' => $file_name,
                    ]);

                    return;
                }

                var_dump(class_implements($class_path . $file_name));
                var_dump($interface_path . 'DrupactEndpointInterface');

                if (!class_implements($class_path . $file_name) || !in_array($interface_path . 'DrupactEndpointInterface', class_implements($class_path . $file_name))) {
                     Logger::insert('@filename.php is missing "DrupactEndpointInterface" interface implementation.', [
                        '@filename' => $file_name,
                    ]);

                    return;
                }
            }
        }
    }

    protected function getFileClassNames($path_to_file = null): array|null {
        if (empty($path_to_file)) {
            Logger::insert('Function @function is missing a path to file argument value.', [
                '@function' => 'getFileClassNames',
            ]);
            return null;
        }

        $classes_before = get_declared_classes();
        require_once $path_to_file;
        $classes_after = get_declared_classes();

        return array_diff($classes_after, $classes_before);
    }
}