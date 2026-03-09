<?php
// Get field configuration details
exec('php vendor/bin/drush.php config:export --diff', $output);

// Look for field_page_sections configuration
echo "Searching for field_page_sections configuration...\n\n";

foreach ($output as $line) {
    if (strpos($line, 'field') !== false) {
        echo $line . "\n";
    }
}
?>
