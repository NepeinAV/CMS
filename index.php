<?php
    require_once('./engine/init.php');
    require_once('./modules/' . __MODULE . '/desc.php');
?>
<html>

    <head>
        <meta charset="utf8">
        <title><?echo Localization::addTitle();?></title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 0;
                background: #fafafa;
                font: 14px arial;
            }

            .flex {
                display: flex;
            }

            aside {
                width: 300px;
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                background: #dfdfdf;
                padding: 20px;
                overflow-y: auto;
            }
            
            article{
                margin-left:300px;
                padding: 20px;
            }
            
            h1{
                margin-top: 0;
            }
        </style>
        <?echo Template::getStylesheet()?>
    </head>

    <body>
        <?echo Template::addTmp('index');?>
        <?echo Template::addTmp('footer');?>
    </body>

</html>

