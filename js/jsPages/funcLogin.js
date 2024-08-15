$(function(){

const notification = $('.notification');
const textNotification = $('.textNotification');
const loading = $('.loading');

var login = $('.login');
var inputLogin = $('.login input');
let h3Login = $('.login h3');
var signUp = $('.signUp');
var inputSignup = $('.signUp input');
let h3Signup = $('.signUp h3');
let btn = $('[name=signup]');
var name = $('[name=name]');
var email = $('[name=email]');
var pass = $('[name=password]');

changeBgColor();
registerUser();
countPassLeng();

function changeBgColor(){

	inputSignup.css('scale','0');
	$('.signUp form span').css('color','transparent');
	h3Signup.css({
		'color':'#222',
		'top':'50%',
		'font-size':'40px'
	});
	h3Login.css({
		'color':'#F8F8F8',
		'top':'0',
		'font-size':'30px'
	});

	login.click(function(){

		$('.bg222').css('transition','1s');
		h3Login.css({
			'color':'#F8F8F8',
			'top':'0',
			'font-size':'30px',
			'transition':'0.5s'
		});
		$('.login form span').css({
			'color':'#F8F8F8',
			'transition':'0.3s'
		});
		$('.login form a').css({
			'color':'#F8F8F8',
			'transition':'0.3s'
		});
		login.addClass('bg222');
		signUp.removeClass('bg222');
		inputLogin.css({
			'scale':1,
			'transition':'0.3s'
		});
		inputSignup.css({
			'scale':0,
			'transition':'0.3s'
		});
		$('.signUp form span').css({
			'color':'transparent',
			'transition':'0.3s'
		});
		h3Signup.css({
			'color':'#222',
			'top':'50%',
			'font-size':'40px',
			'transition':'0.5s'
		});
		$('.switch').css({
			'scale':1,
			'transition':'.3s'
		});
		$('.bg222').css('transition','1s');

	})

	signUp.click(function(){

		$('.bg222').css('transition','1s');
		h3Signup.css({
			'color':'#F8F8F8',
			'top':'0',
			'font-size':'30px',
			'transition':'0.5s'
		});
		$('.login form span').css({
			'color':'transparent',
			'transition':'0.3s'
		});
		$('.login form a').css({
			'color':'transparent',
			'transition':'0.3s'
		});
		signUp.addClass('bg222');
		login.removeClass('bg222');
		inputSignup.css({
			'scale':1,
			'transition':'0.3s'
		});
		inputLogin.css({
			'scale':0,
			'transition':'0.3s'
		});
		$('.signUp form span').not('#passLeng').css({
			'color':'#F8F8F8',
			'transition':'0.3s'
		});
		h3Login.css({
			'color':'#222',
			'top':'50%',
			'font-size':'40px',
			'transition':'0.5s'
		});
		$('.switch').css({
			'scale':0,
			'transition':'.3s'
		});
		$('.bg222').css('transition','1s');
	})
}

function registerUser(){
	var form = $('.signUp > form');

	form.submit(function(){
		loading.show();

		var dataSerie = $(this).serialize(); 
		$.ajax({
			url:include_path+'ajax/registerUser.php',
			type:'post',
			dataType:'json',
			data:dataSerie
		}).done(function(data){
			if(data.success){
				loading.hide();
				showNotification('success');
				form[0].reset();
			}else{
				loading.hide();
				showNotification('error');
			}
		})

		return false;
	})

}

function countPassLeng(){
	$('.signUp [name=password]').keypress(function(){
		var passCount = $(this).val();
		if(passCount.length < 7){
			$('#passLeng').html('<span id="passLeng" class="textRed">A senha deve conter no mínimo <b>8</b> caracteres</span>');
		}else{
			$('#passLeng').html('<span id="passLeng" class="textKelyGreen">Sua senha <b>atende</b> o tamanho desejado</span>');
		}
	})
}

function showNotification($status){
	if($status == 'success'){
		timeout();
		function timeout(){
			setTimeout(function(){
				notification.fadeIn();
				notification.addClass('bgBlue');
				notification.removeClass('bgYellow');
				notification.addClass('textWhite');
				notification.removeClass('text222');
				textNotification.text('Cadastrado realizado!');
				setTimeout(function(){
					notification.fadeOut();
				},2500);
			},300);
		}
	}else if($status == 'error'){
		timeout();
		function timeout(){
			setTimeout(function(){
				notification.fadeIn();
				notification.addClass('bgYellow');
				notification.removeClass('bgBlue');
				notification.addClass('text222');
				notification.removeClass('textWhite');
				textNotification.text('Erro: e-mail já cadastrado ou senha curta!');
				setTimeout(function(){
					notification.fadeOut();
				},2500);
			},300);
		}
	}
}

})