<?php 
	User::verifyCookie();
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
	<?php echo Spawn::spawnLinkFile('all','css/cssGlobal','globalStyle.css'); ?><!-- global style -->
	<link rel="stylesheet" href="css/cssPages/loginStyle.css" /><!-- login style -->
	<title>Seja bem-bindo(a)</title>
</head>
<body>
	<base base="<?php echo INCLUDE_PATH ?>" /><!-- base -->
	<div class="loading"><img src="images/load3.gif"></div><!-- loading -->

	<div class="notification">
		<h4 class="textNotification">Algo deu errado!</h4>
	</div><!-- notification -->
	
	<div class="mainLogin">
		<?php 
			if(isset($_POST['login'])){
				User::startLogin($_POST['email'],$_POST['password']);
			}
		?>
		<div class="container containerLogin bgF8 textF8">
			<section class="login w50 bg222">
				<form method="post">
					<h3>Login</h3>
					<span>E-mail:</span>
					<input type="email" name="email" placeholder="E-mail...">
					<span>Password:</span>
					<input type="password" name="password" placeholder="Password...">
					<input id="recordPass" type="checkbox" name="recordPass">
					<label title="save password" for="recordPass" class="switch bgF8">
						<span class="toggle bgKelyGreen"></span><!-- toggle -->
					</label><!-- recordPass -->
					<input type="submit" name="login" class="bgF8" value="Login">
					<a class="textF8" href="#">Esqueceu a senha?</a>
				</form>
			</section><!-- login -->

			<section class="signUp w50">
				<form method="post">
					<h3>Register</h3>
					<span>Name:</span>
					<input required type="text" name="name" placeholder="Name">
					<span>E-mail:</span>
					<input required type="email" name="email" placeholder="E-mail">
					<span>Password:</span>
					<span id="passLeng"></span>
					<input required type="password" name="password" placeholder="Password">

					<input type="hidden" name="permission" value="2">
					<input type="submit" name="signup" class="bgF8" value="Signup">
				</form>
			</section><!-- singUp -->

		</div><!-- container -->
	</div><!-- mainLogin -->

<?php Spawn::spawnLinkFile('all','js/jsLibs','jquery.js'); ?><!-- jquery -->
<?php Spawn::spawnLinkFile('all','js/jsPages','funcLogin.js'); ?><!-- funcAside -->
<?php Spawn::spawnLinkFile('all','js/jsGlobal','const.js'); ?><!-- funcAside -->
</body>
</html>