<h1>Intoduction</h1>
<p>I found some hosting problems with zips uploading, and some routine things we do when we extract a Laravel Project, So I decided to make a PHP script that automates all these things, and once it finishes, the project directly works in the hosting</p>
<h2 style="color: lightseagreen;">How to use ?</h2>
<ol>
    <li>What it mainly depends on:</li>
    <ul>
        <li>It is built mainly to extract zips on github that has the public.zip, and the dist.zip, like this one: https://github.com/Abdallah-Medhat75/Laravel_Project/archive/refs/heads/master.zip</li>
    </ul>
    <br>
    <li>The Github Repo:</li>
    <ul>
        <li>You will have two zip files, one has the index.php, the root of the Laravel project in general, and since that index.php is in public directory by default, the zip will be named public.zip by default, using winrar</li>
        <li>The Second one Will be the zip has the whole project, including the Laravel default directories like: resources, storage, database...etc</li>
        <li>You will have to change the $url variable to the one you have in the github, changing is explained in the extraction script itself, see this repo I have, to know the structure well: https://github.com/Abdallah-Medhat75/Laravel_Project</li>
        <li>NOTE: Get the link of the Zip file, when you click Code button you will see a one called " Download ZIP " below, the link to that file that you will copy</li>
    </ul>
    <br>
    <li>Rules to make it work with no problems: </li>
    <ul>
        <li>The two compressed file must be with the extension .zip, because the PHP script uses the built-in zip class</li>
        <li>The zip that has the whole laravel project must be alphabitically before public.zip, letters: A B C D E F G H I J K L M N O</li>
        <li>To avoid that headache name the zip " dist "</li>
    </ul>
</ol>
<h2 style="color: #2196f3">Notes: </h2>
<p>The extract file, and the functions.php, the file that has the functions, will be deleted automatically after everything is done, the working extracted laravel project is the only thing will be left after the process is done</p>
<p>Take a look here to for this deleting script, because both repos are strongly related: https://github.com/Abdallah-Medhat75/Deleting</p>

<h2>Optimization: </h2>
<p>Added Small Optimization to the code, first the main extraction ZIP which is called test.zip, was extracting its content twice, I avoided this by making it extracting once, and in the second time the function call the $extractDir doesn't change because of the changed flag $mainExtractDirExist + That made the feedback of the process more logical and clear, I am not sure if it's 100% stable like the old code, but I will find if there's vulnerabilities</p>

<h2>For Linux Debian-based Users Only: </h2>
<p>If You will run this from the command line make sure to change the owner to become you to avoid any warning or unexpected things</p>
<p>First you need to become one of the sudoers, sign in as the root user, using this command:</p>
<pre>
    <code>su -</code>
</pre>
<p>Then write the root password, after you signed in, you must have access to sudo to do this, run: </p>
<pre>
    <code>sudo usermod -aG sudo YOUR_USERNAME</code>
</pre>
<p>change that YOUR_USERNAME with your actual user name, then restart the operating system</p>
<p>After Becoming One From The sudoers, you can run this command if you will run this code from the TERMINAL:</p>
<pre>
    <code>sudo chown -R $USER:$USER .</code>
</pre>
<p>If You will run it from a browser using apache, you will have to make the owner www-data, which is apache user, to make apache do anything without problems</p>
<pre>
    <code>sudo chown -R www-data:www-data .</code>
</pre>