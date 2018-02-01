<?php
    require_once('./engine/exceptions/init.php');
    try {
        require_once('./engine/init.php');
        echo Modules::getModule(__ACTION, __MODULE);
    } catch (SQLException $e) {
        echo $e->getMessage();
    } catch (FileException $e) {
        echo $e->getMessage();
    }
