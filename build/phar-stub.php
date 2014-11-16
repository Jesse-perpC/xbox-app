<?php
Phar::mapPhar('xapp.phar');
define('XAPP_PHAR', true);
define('XAPP_PHAR_FILE_PREFIX', 'phar://xapp.phar');
return (require 'phar://xapp.phar/index.php');
__HALT_COMPILER();
