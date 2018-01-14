<?php
require_once('./engine/init.php');
echo Modules::getModule(__ACTION, __MODULE);
print_r($modules['news']->settings);
