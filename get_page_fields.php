<?php

$bundle = 'page';

echo "Fields for 'page' content type:\n";
echo "================================\n\n";

// Use exec to run drush field:info
exec('php vendor/bin/drush.php field:info node ' . $bundle, $output, $return_code);

// Parse and display output
foreach ($output as $line) {
    echo $line . "\n";
}

// Now get base fields
echo "\n\nBase fields for 'node' entity type:\n";
echo "====================================\n\n";

exec('php vendor/bin/drush.php field:base-info node', $base_output, $return_code);

foreach ($base_output as $line) {
    echo $line . "\n";
}
?>
