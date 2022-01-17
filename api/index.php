<?php
// CORS HEADERS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
date_default_timezone_set('America/Sao_Paulo');


require_once "./libs/vendor/autoload.php";
$dir = new DirectoryIterator("settings");
foreach ($dir as $fileInfo) {
	if($fileInfo->getExtension() == 'php'){
		include_once './settings/'. $fileInfo->getFilename();
	}
}

$Constructor = new Constructor($_GET);
echo $Constructor->Init();


// foreach ($dir as $fileInfo) {
// 	if(pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION) == 'php'){
// 		include_once './settings/'. $fileInfo->getFilename();
// 	}
// }

