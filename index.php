<?php
    require_once('./engine/exceptions/init.php');
    require_once('./engine/init.php');
    try {
        echo Modules::getModule(__ACTION, __MODULE);
    } catch (SQLException $e) {
        echo $e->getMessage();
    } catch (FileException $e) {
        echo $e->getMessage();
    }
