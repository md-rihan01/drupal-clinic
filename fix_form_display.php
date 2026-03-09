#!/usr/bin/env php
<?php
// Bootstrap Drupal
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __FILE__;
$_SERVER['DOCUMENT_ROOT'] = __DIR__;

require_once __DIR__ . '/web/autoload.php';

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$kernel = DrupalKernel::createFromRequest($request, require __DIR__ . '/web/autoload.php', 'prod', FALSE);
$kernel->bootEnvironment();
$kernel->boot();

// Get config factory
$configFactory = \Drupal::configFactory();

// Load the entity form display
$formDisplay = $configFactory->getEditable('core.entity_form_display.node.page.default');

// Ensure field_page_sections is in hidden
$formDisplay->set('hidden.field_page_sections', TRUE);

// Remove from content if present
$content = $formDisplay->get('content');
if (is_array($content) && isset($content['field_page_sections'])) {
    unset($content['field_page_sections']);
    $formDisplay->set('content', $content);
}

// Save the configuration
$formDisplay->save();

echo "✓ Configuration updated successfully!\n";
echo "  - field_page_sections hidden from form\n";
