<?php
function createTempDir()
{
    $path=dirname(dirname(dirname(__DIR__))).'/storage/temp';
     createDir($path, 0777,true);
     $path = $path.'/images';
     createDir($path, 0777,true);
     return $path;
}
if(!function_exists('createDir')) {
    function createDir($path, $mode, $recursive = false)
    {
        if (!file_exists($path)) {
            $oldmask = umask(0);
            mkdir($path, $mode, $recursive);
            umask($oldmask);
        }
    }
}