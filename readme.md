<h1>Intoduction</h1>
<p>I found some hosting problems with zips uploading, and some routine things we do when we extract a Laravel Project, So I decided to make a PHP script that automates all these things, and once it finishes, the project direcly works in the hosting</p>
<h2 style="color: lightseagreen;">How to use ?</h2>
<ol>
    <li>What it mainly depends on:</li>
    <ul>
        <li>It is built mainly to extract zips on github that has the public.zip, and the dist.zip</li>
    </ul>
    <br>
    <li>The Github Repo:</li>
    <ul>
        <li>You will have two zip files, one has the index.php, the root of the Laravel project in general, and since that index.php is in public directory by default, the zip will be named public.zip by default, using winrar</li>
        <li>The Second one Will be the zip has the whole project, including the Laravel default directories like: resources, storage, database...etc</li>
        <li>You will have to change the $url variable to the one you have in the github, changing is explained in the extraction script itself, see this repo I have to know the structure well: https://github.com/Abdallah-Medhat75/Laravel_Project</li>
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
<p>The extract file, and the functions.php, the file that has the functions, will be deleted automatically after everything is done, the laravel project is the only thing will be left after the process is done</p>