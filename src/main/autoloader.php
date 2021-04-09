<?php

    function fcms_autoloader($className) {
        if (strpos($className, '\\') !== FALSE) {
            $parts = explode("\\", $className);
            $className = $parts[count($parts) - 1];
        }

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