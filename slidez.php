<?php
// --- SLIDESHOW IMAGES FROM p-users/*/work ---
$images = [];
$pusersDir = __DIR__ . '/p-users';

if (is_dir($pusersDir)) {
    $userFolders = scandir($pusersDir);
    foreach ($userFolders as $userFolder) {
        if ($userFolder === '.' || $userFolder === '..') continue;
        $workDir = $pusersDir . '/' . $userFolder . '/work';
        if (is_dir($workDir)) {
            $workFiles = scandir($workDir);
            foreach ($workFiles as $file) {
                if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                    $images[] = 'p-users/' . $userFolder . '/work/' . $file;
                }
            }
        }
    }
}
// Randomize the order of images
shuffle($images);
?>