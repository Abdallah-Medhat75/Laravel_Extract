<?php

    // Here we will use cURL instead of normal file_get_contents() because it works better without problems for auth headers, redirects, SSL...etc

    // The three main variables for private repos
    // First one: The url to the Github REST API to fetch the ZIP from your private repo
    // Check this to understand the flow for private repos: https://docs.github.com/rest/repos/contents#download-a-repository-archive-zip
    $url = 'https://api.github.com//repos/{your-username}/{repo}/zipball/{the-branch-you-are-working-on}';
    // Second One: the Personal Access Token (PAT) you generate to access the REST API, sent via Authorization header
    // You can generate a one by going into this link: https://github.com/settings/tokens
    // Or manually: Click on Your Profile => Settings => Developer Settings => Personal Access Tokens
    // Classic Tokens start with ghp_ , make sure to copy the token after it's generated because you can't access it again, you will have to generate a new one if you lost it
    $token = 'ghp_the_rest_of_your_token';
    // Second one: the path to the vendor and bootstrap in the index.php, it's optional, you can change that variable if you don't like the name core or any other reason
    $correctPath = 'core';

    // $ch is a convention name for Curl Handle, like $i is short hand for index, in loops
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        // VERY VERY IMPORTANT CURL OPTION, A MUST: Returns the response to use it later, instead of echoing it directly in the page
        CURLOPT_RETURNTRANSFER => true,
        // ANOTHER MUST AND VERY IMPORTANT: Makes Curl Follow the redirect, a URL to the ZIP github generates after you are authorized and sends Location header to go that URL
        CURLOPT_FOLLOWLOCATION => true,
        // All headers are listed here: https://docs.github.com/rest/repos/contents#download-a-repository-archive-zip
        CURLOPT_HTTPHEADER => [
            "Accept: application/vnd.github+json",
            "Authorization: Bearer $token",
            "X-GitHub-Api-Version: 2022-11-28",
            // User-Agent header is a MUST, cURL doesn't set it automatically, so github REST API refuse the request, causing probelms, so you had to put it
            "User-Agent: Laravel_Extract"
        ]
    ]);

    // Send The Request After The Config Is Done
    $content = curl_exec($ch);

    // Debugging if there's errors
    if (curl_errno($ch)) {
        echo 'Curl Erro: ' . curl_error($ch);
    }

    // Close the Curl Session, important to avoid problems and unxpected behaviours later
    curl_close($ch);

    $zip = new ZipArchive;
    $zipFile = 'test.zip';
    file_put_contents($zipFile, $content);

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