<?php
Phar::mapPhar('xapp.phar');
define('XAPP_PHAR', true);
return (require 'phar://xapp.phar/index.php');
__HALT_COMPILER();
