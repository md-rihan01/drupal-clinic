<?php
// Load Drupal
require_once __DIR__ . '/web/core/includes/bootstrap.inc';
\Drupal::classResolver()
  ->getInstanceFromDefinition('Drupal\Core\DrupalKernel')
  ->bootEnvironment();

// Get and modify form display config
$config = \Drupal::configFactory()->getEditable('core.entity_form_display.node.page.default');
$settings = $config->getRawData();

// Move field_page_sections from content to hidden
if (isset($settings['content']['field_page_sections'])) {
    unset($settings['content']['field_page_sections']);
    $settings['hidden']['field_page_sections'] = true;
    $config->setData($settings)->save();
    echo "✓ field_page_sections hidden from form display\n";
} else {
    echo "! field_page_sections already hidden or not found\n";
}
?>
