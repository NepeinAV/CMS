<!DOCTYPE html>
<html lang="ru">

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?echo Modules::getModuleTitle();?></title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="/templates/<?echo __TEMPLATE;?>/news/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="/templates/<?echo __TEMPLATE;?>/news/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="/templates/<?echo __TEMPLATE;?>/news/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>

<body>
    <?global $USER; if ($USER->isUserSignedIn()):?>
            <script>window.location.href = '/';</script>
        <?endif;?>
        <?echo Template::addTmp('header', 'news');?>
		<div class="section">
			<div class="container">
                <div class="section-row">
                    <div class="section-title">
                        <h2>Регистрация</h2>
                    </div>
            <?echo Modules::getModule('index', 'regform');?>
            </div>
            </div>
        </div>
    </div>
</body>

</html>