<?php

namespace Drupal\drupact\Extend\core\Filesystem;

use DirectoryIterator;
use Drupal\drupact\Extend\core\Logger\Logger;
use RuntimeException;
use UnexpectedValueException;

class Filesystem {
  public const string NAMESPACE_API = 'Drupal\drupact\Extend\api\\';
  public const string NAMESPACE_ENDPOINT_INTERFACE = 'Drupal\drupact\Extend\core\Endpoint\\';
  public const string API_DIR = __DRUPACT_ROOT__ . '\src\Extend\api';
  public const string INAME_ENDPOINT = 'IEndpoint';

  public function __construct() {}

  public function walkApiDir(): array|null {
    try {
      foreach (new DirectoryIterator(self::API_DIR) as $fi) {
        $validated = $this->_validateApiFile($fi);
        if (!$validated) {
          Logger::insert('File @file is not a valid Drupact API file. Skipping initialization.', [
            '@file' => $fi->getFilename(),
          ]);
          return null;
        }
      }
    } catch (UnexpectedValueException $e) {
      Logger::insert('Path cannot be opened. Exception: @exception', [
        '@exception' => $e->getMessage(),
      ]);
      return null;
    } catch (RuntimeException $e) {
      Logger::insert('Expected "string", but empty path provided. Exception: @exception', [
        '@exception' => $e->getMessage(),
      ]);
      return null;
    }

    return null;
  }

  private function _getFileClassNames(string $path): array|null {
    if (empty($path)) {
      Logger::insert('Function @function is missing a file path in argument value.', [
        '@function' => 'getFileClassNames',
      ]);
      return null;
    }

    if (!file_exists($path)) {
      Logger::insert('File @file does not exist.', [
        '@file' => $path,
      ]);
      return null;
    }

    $fclasses = get_declared_classes();

    require_once $path;
    $fclasses_after = get_declared_classes();

    return array_diff($fclasses, $fclasses_after);
  }

  private function _validateApiFile(DirectoryIterator $fi): bool {
    if (!$fi->isFile() || $fi->getExtension() !== 'php') return false;

    $fname = str_replace('.php', '', $fi->getFilename());
    $fpath = $fi->getPathname();

    $fclasses = $this->_getFileClassNames($fpath);
    if (empty($fclasses)) return false;

    if (!in_array(self::NAMESPACE_API . $fname, $fclasses)) {
      Logger::insert('@filename does not have "@classname" class.', [
        '@filename' => $fi->getFilename(),
        '@classname' => $fname,
      ]);
      return false;
    }

    if (!class_implements(self::NAMESPACE_API . $fname) ||
      !in_array(self::NAMESPACE_ENDPOINT_INTERFACE . self::INAME_ENDPOINT,
        class_implements(self::NAMESPACE_API . $fname))) {
      Logger::insert('@filename is missing "@interface" interface implementation.', [
        '@filename' => $fi->getFilename(),
        '@interface' => self::INAME_ENDPOINT,
      ]);
      return false;
    }

    return true;
  }
}
