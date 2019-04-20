<!DOCTYPE html>
<html lang="ru">

    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?echo Modules::getModuleTitle();?> - <?print(News::getArticleField('title'));?></title>

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
        <?echo Template::addTmp('header');?>
		<div class="section">
			<div class="container">
				<div class="row">
                    <div class="col-md-8">
                        <div class="section-row sticky-container">
                            <div class="main-post">
                                <h3><?print(News::getArticleField('title'));?></h3>
                                <?echo News::getArticleField('text');?>
                            </div>
                        </div>

                        <div class="section-row">
                            <div class="post-author">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="media-object" src="<?echo User::getUserDataByID(News::getArticleField('user_id'), 'avatar_url');?>" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h3><?echo User::getUserDataByID(News::getArticleField('user_id'), 'name');?></h3>
                                        </div>
                                        <ul class="author-social">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                        <?echo Components::getComponent('index', 'comments', ['p_module' => 'news', 'for_id' => true]);?>
                        <?echo Components::getComponent('index', 'pagenavigator', ['p_module' => 'news', 'p_component' => 'comments'])?>
                        <?echo Components::getComponent('index', 'postingform', ['p_module' => 'news']);?>

                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
