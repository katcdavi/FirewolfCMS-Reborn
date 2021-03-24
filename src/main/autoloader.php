<?php

    function fcms_autoloader($className)
    {
        $searchQuery = DIRECTORY_SEPARATOR."$className.php";
        $baseFolder = ".".DIRECTORY_SEPARATOR."src";

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($baseFolder)
        );

        foreach ($files as $file) {
            if (strpos($file, $searchQuery) !== false) {
                require_once($file);
                return;
            }
        }
    }