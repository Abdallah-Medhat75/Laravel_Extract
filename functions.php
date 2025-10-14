<?php

    /***** FOR LINUX DEBIAN-BASED USERS ONLY *******/
    // If You will run this from the command line make sure to change the owner to become you to avoid any warning or unexpected things
    // First you need to become one of the sudoers, sign in as the root user, using this command:
    /* su - */
    // Then write the root password, after you signed in, you must have access to sudo to do this, run:
    /* sudo usermod -aG sudo YOUR_USERNAME */
    // change that YOUR_USERNAME with your actual user name, then restart the system
    // After Becoming One From The sudoers, you can run this command if you will run this code from the command line:
    /* sudo chown -R $USER:$USER . */
    // If You will run it from a browser using apache, you will have to make the owner www-data, which is apache user, to make apache do anything without problems
    /* sudo chown -R www-data:www-data . */

    $extractDir = '';
    $mainExtractDirExist = false;
    
    function deleteFullDir($dirPath) {
        $files = array_diff(scandir($dirPath), ['.', '..']);
        foreach ($files as $file) {
            $fullPath = $dirPath . '/' . $file;
            if (is_dir($fullPath)) {
                deleteFullDir($fullPath);
            } else {
                unlink($fullPath);
            }
        }
        return rmdir($dirPath);
    }
    function getDirsOnly($dirPath) {
        $result = [];
        $files = scandir($dirPath);
        foreach ($files as $dir) {
            $dirFullPath = $dirPath . '/' . $dir;
            if ($dir != '.' && $dir != '..' && is_dir($dirFullPath)) {
                array_push($result, $dirFullPath);
            }
        }
        return $result;
    }
    function correctingDirs($original, $replacement, $filePath) {
        $oldContents = file_get_contents($filePath);
        $newContents = str_replace($original, $replacement, $oldContents);
        file_put_contents($filePath, $newContents);
    }
    // Main Extraction Function
    function fullLaravelExtraction($absPath = __DIR__) {
        global $zip, $mainExtractDirExist, $extractDir;
        $order = $absPath == __DIR__ ? 3 : 2;

        if (!$mainExtractDirExist) {
            $extractDir = getDirsOnly(__DIR__)[0];
            $mainExtractDirExist = true;
        }

        $targetZip = scandir($extractDir)[$order];
        $zip->open($extractDir . '/' . $targetZip);
        $zip->extractTo($absPath);
        $zip->close();
        echo "Main Extraction ZIP File " . $targetZip . " Deleted Successfully<br>" . PHP_EOL;
    }
    function deleteNoNeedFiles($file) {
        global $extractDir;
        unlink(__DIR__ . '/functions.php');
        echo 'Functions PHP File Has Been Deleted Successfully !<br>' . PHP_EOL;

        deleteFullDir($extractDir);

        unlink($file);
        echo 'Main Extraction ZIP Removed Successfully !<br>' . PHP_EOL;
    }