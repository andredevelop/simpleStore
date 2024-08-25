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

	<header class="bgYellow bg222">
		<div class="container dspFlexWrap">
			<div class="text-header w50">
				<a class="text222" href="home">Sylph</a>
			</div><!-- text-header -->

			<div class="header-buttons w50">
				<a class="text222" href="">Login</a>
				<a class="text222" href="">Cadastre-se</a>
			</div><!-- header-buttons -->
		</div><!-- container -->
	</header>

	<main>
		<i class="fa-solid fa-bars btn-menu text222"></i>

		<aside class="bgWhite">
			<i class="fa-solid fa-bars btn-menu text222"></i>

			<div class="menu">
				<div class="<?php Spawn::selectMenuSide('clientes'); ?>">
					<a data-id="ico" href="clientes"><i class="fa-solid fa-user"></i></a>
					<a data-id="link" href="clientes">Clientes</a>
				</div>
				<div class="<?php Spawn::selectMenuSide('processos'); ?>">
					<a data-id="ico" href="processos"><i class="fa-solid fa-folder"></i></a>
					<a data-id="link" href="processos">Processos</a>
				</div>
				<div class="<?php Spawn::selectMenuSide('audiencias'); ?>">
					<a data-id="ico" href="audiencias"><i class="fa-solid fa-folder"></i></a>
					<a data-id="link" href="audiencias">Audiencias</a>
				</div>
				<div class="<?php Spawn::selectMenuSide('parte-contraria'); ?>">
					<a data-id="ico" href="parte-contraria"><i class="fa-solid fa-gavel"></i></a>
					<a data-id="link" href="parte-contraria">Parte contrária</a>
				</div>
				<div class="<?php Spawn::selectMenuSide('agenda'); ?>">
					<a data-id="ico" href="agenda"><i class="fa-regular fa-calendar-days"></i></a>
					<a data-id="link" href="agenda">Agenda</a>
				</div>
				
			</div><!-- menu -->
		</aside>

		<div class="content">
			<?php Spawn::spawnPage(); ?>
		</div><!-- content -->

		<div class="upage-arrow bg222 textWhite">
			<i class="fa-regular fa-up"></i>
		</div><!-- upage-arrow -->
	</main>

<?php Spawn::spawnScriptsJs(); ?>
</body>
</html>
