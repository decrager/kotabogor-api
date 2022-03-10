<?php
$targetFolder = __DIR__.'/../../kotabogor-api/storage/app/public';
$linkFolder = __DIR__.'/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed';
?>