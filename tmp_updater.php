<?php
$file = 'composer.json';
$content = file_get_contents($file);
$content = str_replace('"7.0.*"', '"7.2.*"', $content);
file_put_contents($file, $content);
echo "Updated composer.json\n";
