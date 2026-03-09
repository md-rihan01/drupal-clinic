<?php
// Quick Drupal bootstrap and paragraph deletion script
define('DRUPAL_ROOT', __DIR__);

$autoloader = require_once __DIR__ . '/web/autoload.php';

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

try {
    $request = Request::createFromGlobals();
    $kernel = DrupalKernel::createFromRequest($request, $autoloader, 'prod');
    $kernel->boot();
    \Drupal::service('kernel')->initializeContainer();
    
    // Load and delete all paragraphs
    $storage = \Drupal::entityTypeManager()->getStorage('paragraph');
    $query = $storage->getQuery()->accessCheck(FALSE);
    $ids = $query->execute();
    
    if ($ids) {
        $paragraphs = $storage->loadMultiple($ids);
        $storage->delete($paragraphs);
        echo "✓ Deleted " . count($ids) . " paragraph entities\n";
    } else {
        echo "- No paragraphs to delete\n";
    }
    
    // Now try to uninstall
    echo "\nAttempting to uninstall modules...\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
