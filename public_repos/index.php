<?php

    // The two variables mentioned in readme.md
    // First one: The url to the github repo ( Must change ! ), this is a working link btw, a Laravel project I have
    $url = 'https://github.com/Abdallah-Medhat75/Laravel_Project/archive/refs/heads/master.zip';
    // Second one: the path to the vendor and bootstrap in the index.php, it's optional, you can change that variable if you don't like the name core or any other reason
    $correctPath = 'core';

    $zip = new ZipArchive;
    $zipFile = 'test.zip';
    file_put_contents($zipFile, file_get_contents($url));

    if ($zip->open($zipFile) === TRUE) {
        $zip->extractTo(__DIR__);
        $zip->close();
        echo 'Initial Extraction Done Successfully !<br>' . PHP_EOL;
    } else {
        echo 'Extraction Failed';
    }

    require_once __DIR__ . '/functions.php';
    
    fullLaravelExtraction();
    mkdir(__DIR__ . "/$correctPath");
    fullLaravelExtraction(__DIR__ . "/$correctPath");

    correctingDirs("/../", "/$correctPath/", __DIR__ . '/index.php');

    // Deleting The Extraction Files After Everything is Done
    deleteNoNeedFiles($zipFile);

    // Run these lines below if you changed this file name to anything other than index to make it auto deleted after extraction dones
    // unlink(__FILE__);
    // echo "The Main PHP File Has Been Deleted Successfully !<br>";