<?php

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
    function deleteNoNeedFiles($file) {
        unlink(__DIR__ . '/functions.php');
        echo "Functions PHP File Has Been Deleted Successfully !<br>";

        unlink($file);
        echo "Initial Extraction ZIP Removed Successfully !<br>";
    }