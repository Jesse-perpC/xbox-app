<?php
$THIS_PATH = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
$srcRoot = $THIS_PATH . '';
$buildRoot = $THIS_PATH . "/";

$phar = new Phar($buildRoot . "/xapp.phar",
	FilesystemIterator::CURRENT_AS_FILEINFO |       FilesystemIterator::KEY_AS_FILENAME, "xapp.phar");

//$phar["index.php"] = file_get_contents(realpath($srcRoot . "../index.php"));
$phar->buildFromDirectory($srcRoot,'/.php$/');
//$phar["common.php"] = file_get_contents($srcRoot . "/common.php");
//$phar->setStub($phar->createDefaultStub("index.php"));
$phar->createDefaultStub(file_get_contents(realpath($srcRoot . "../phar-stub.php")));


//copy($srcRoot . "/config.ini", $buildRoot . "/config.ini");