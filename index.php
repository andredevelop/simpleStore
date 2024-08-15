<?php
	include('config.php');
	Spawn::spawnBarUrl('home');
	// $userImg = $_SESSION['image'];

	if(isset($_GET['loggout'])){
		User::loggout();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- font open sans -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- metatags -->
	<meta name="description" content="Desenvolvedor fullstack - advocacia - autonomia e foco do cliente - controle seus casos."/>
	<meta name="keywords" content="desenvolvimento web,seo,marketing digital,programação,cursos online,web design,front-end,web developer,back-end,php,pacajus,controle financeiro" />
	<meta name="robots" content="index,follow" />
	<meta name="author" content="Francisco André | Dev. Web" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
	<!-- charset -->
	<!-- font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
	<script src="https://kit.fontawesome.com/d76df92ddf.js" crossorigin="anonymous"></script>
	<!-- icone do site -->
	<link rel="shortcut icon" type="image-x/png" href="<?php echo INCLUDE_PATH ?>favicon.ico" />
	<!-- estilo -->
	<?php Spawn::spawnLinkCss(); ?>
	<title>Bem-vindo(a)!</title>
</head>
<body>
	<base base="<?php echo INCLUDE_PATH ?>" /><!-- base -->
	<div class="loading"><img src="images/load3.gif"></div><!-- loading -->

	<header class="bgBlue textWhite">
		<div class="container dspFlexWrap">
			<div class="text-header w50">
				<span>Bem-vindo(a)!</span>
			</div><!-- text-header -->

			<div class="header-buttons w50">
				<a class="textF8" href="">Login</a>
				<a class="textF8" href="">Cadastre-se</a>
			</div><!-- header-buttons -->
		</div><!-- container -->
	</header>

	<main>
		<div class="content">
			<?php Spawn::spawnPage(); ?>
		</div><!-- content -->

		<div class="upage-arrow bgLightGray textWhite">
			<i class="fa-regular fa-up"></i>
		</div><!-- upage-arrow -->
	</main>

<?php Spawn::spawnScriptsJs(); ?>
</body>
</html>
