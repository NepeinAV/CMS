<!DOCTYPE html>
<html lang="ru">

<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?echo Modules::getModuleTitle();?> - Добавление новости</title>

		<script src="<?echo Template::includeStatic('js/jquery.min.js');?>"></script>
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
		<link href="<?echo Template::includeStatic('css/summernote-lite.css');?>" rel="stylesheet">
		<script src="<?echo Template::includeStatic('js/summernote-lite.js');?>"></script>
    </head>

<body>
    <?echo Template::addTmp('header', 'news');?>
    <div class="section">
		<div class="container">
            <?echo Components::getComponent('addarticle', 'postingform');?>
        </div>
    </div>

		<script>
			$(document).ready(function() {
				$('#summernote').summernote({
					toolbar: [
						// [groupName, [list of button]]
						['style'],
						['style', ['bold', 'italic', 'underline', 'clear'],],
						['font', ['strikethrough', 'superscript', 'subscript']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['ul', 'ol', 'paragraph']],
						['height', ['height']]
					],
					popover: {
						air: [
							['color', ['color']],
							['font', ['bold', 'underline', 'clear']]
						]
					},
					placeholder: 'Введите текст новости',
					height: 300, 
					tabsize: 4,
				});

				document.querySelector('#send-article').addEventListener('click', e => {
                e.preventDefault();
                const code = $('#summernote').summernote('code');
                document.querySelector('input[name="text"]').value = code;
                document.querySelector('form[name="addarticle_form"]').submit();
            });
			});	
		</script>
</body>

</html>