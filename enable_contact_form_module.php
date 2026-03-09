<?php
/**
 * Enable Contact Form Integration module
 */

// Set up Drupal environment
chdir(__DIR__);
$app_root = getcwd();
$site_path = 'web/sites/default';

$autoloader = require_once $app_root . '/vendor/autoload.php';

// Create and boot the kernel
$kernel = new \Drupal\Core\DrupalKernel('prod', $autoloader);
$kernel->setSitePath($site_path);
$kernel->boot();

// Enable the module
try {
    \Drupal::service('module_installer')->install(['contact_form_integration']);
    echo "Contact Form Integration module enabled successfully!\n";
    drupal_flush_all_caches();
    echo "Cache cleared.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
