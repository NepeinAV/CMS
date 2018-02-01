<?php
require_once('./engine/init.php');
echo Modules::getModule(__ACTION, __MODULE);
echo '<pre>';
print_r($MODULES);
