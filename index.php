<?php
require_once('/engine/main.php');
require_once('/engine/dbcon.php');
require_once('/engine/rdset.php');
require_once('/engine/loc.php');
require_once('/engine/tmp.php');
require_once('/modules/' . __MODULE . '/desc.php');
?>
<html>
    <head>
        <meta charset="utf8">
        <title><?echo $TMP->addTitle();?></title>
        <style>
            body{
                margin:0;
                padding:0;
                font: 14px arial;
                background: #fafafa;
            }
            .wrap{
                width: 1366px;
                margin:0 auto;
            }
            .lang{
                height:180px;
                margin:0;

            }
            menu{
                margin: 0;
                padding: 0;
                background: #4577D4;
            }
            menu li{
                display: inline-block;
                padding: 15px 20px;
            }
            menu li:hover{
                background: #0A67A3;
            }
            menu a{
                color:white;
                font-weight: bold;
                text-decoration: none;
            }
            .body{
                background:#fff;
                height:800px;
            }
        </style>
    </head>
    <body>
        <?echo $TMP->addTmp('header');?>
        <?echo $TMP->addTmp('index');?>
        <?echo $TMP->addTmp('footer');?>
    </body>
</html>