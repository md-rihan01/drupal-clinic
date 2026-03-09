<?php
/**
 * Config Import Script
 */

chdir(__DIR__);
$drupal_root = getcwd();
require_once 'web/core/includes/bootstrap.inc';

\Drupal\Core\DrupalKernel::bootEnvironment();

$app_root = __DIR__;
$site_path = 'web/sites/default';

$autoloader = require_once $app_root . '/vendor/autoload.php';
$kernel = new \Drupal\Core\DrupalKernel('production', $autoloader, FALSE);
$kernel->setSitePath($site_path);
$kernel->boot();

// Import configurations
$config_importer = \Drupal::service('config.importer');

if ($config_importer->alreadyImporting()) {
    echo "Configuration is already being imported.\n";
    exit(1);
}

try {
    $config_importer->import();
    echo "Configuration imported successfully!\n";
    echo "New field 'field_contact_section' has been created.\n";
    
    // Clear cache
    drupal_flush_all_caches();
    echo "Cache cleared.\n";
    
    exit(0);
} catch (\Exception $e) {
    echo "Error importing configuration: " . $e->getMessage() . "\n";
    exit(1);
}
