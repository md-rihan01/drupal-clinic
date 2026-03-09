<?php

/**
 * Quick field audit script - run via browser to discover fields
 */

chdir(__DIR__ . '/../../..');
require_once 'web/core/includes/bootstrap.inc';

\Drupal::classResolver();

$app_root = __DIR__ . '/../../..';
$site_path = 'web/sites/default';
$kernel = \Drupal\Core\DrupalKernel::createFromRequest(\Symfony\Component\HttpFoundation\Request::createFromGlobals(), \Drupal\Core\Bootstrap::getAutoloader(), 'prod');
$kernel->setSitePath($site_path);
$kernel->boot();

// Query all fields on page content type
$entity_field_manager = \Drupal::service('entity_field.manager');

echo "=== Fields on 'page' Content Type ===\n";
$fields = $entity_field_manager->getFieldDefinitions('node', 'page');
foreach ($fields as $field_name => $field_definition) {
    echo "$field_name: " . $field_definition->getType() . "\n";
}

echo "\n=== Fields on 'departments' Content Type ===\n";
try {
    $fields = $entity_field_manager->getFieldDefinitions('node', 'departments');
    foreach ($fields as $field_name => $field_definition) {
        echo "$field_name: " . $field_definition->getType() . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
