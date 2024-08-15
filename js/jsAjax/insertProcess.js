$(function(){

	const formAdd = $('#form-add');
	const btnSignup = $('[name=signup]');
	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');
	var search = $('[name=search]');

	formAdd.submit(function(){
		loading.show();
		
		btnEvent('disable',btnSignup);

		var dataSerie = $(this).serialize();

		$.ajax({
			url:include_path+'ajax/insertProcess.php',
			type:'post',
			dataType:'json',
			data:dataSerie
		}).done(function(data){
			if(data.success){
				loading.hide();
				search.trigger('keyup');
				btnEvent('enable',btnSignup);
				showNotification('success');
			}

			if(data.error){
				loading.hide();
				btnEvent('enable',btnSignup);
				showNotification('error');
			}
		})

		return false;
	})

// --------	

	function btnEvent(status,btn){
		if(status == 'disable'){
			btn.attr('disabled',true);
			btn.removeClass('bgKelyGreen');
			btn.addClass('bg222');
			btn.val('Carregando...');
		}else if(status == 'enable'){
			btn.attr('disabled',false);
			btn.addClass('bgKelyGreen');
			btn.removeClass('bg222');
			btn.val('Cadastrar');
		}
	}

	function showNotification(status){
		if(status == 'success'){
			timeout();
			function timeout(){
				setTimeout(function(){
					notification.fadeIn();
					notification.addClass('bgBlue');
					notification.removeClass('bgYellow');
					notification.addClass('textWhite');
					notification.removeClass('text222');
					textNotification.text('Processo cadastrado!');
					setTimeout(function(){
						notification.fadeOut();
					},2500);
				},300);
			}
		}else if(status == 'error'){
			timeout();
			function timeout(){
				setTimeout(function(){
					notification.fadeIn();
					notification.addClass('bgYellow');
					notification.removeClass('bgBlue');
					notification.addClass('text222');
					notification.removeClass('textWhite');
					textNotification.text('Não deixe dados em branco!');
					setTimeout(function(){
						notification.fadeOut();
					},2500);
				},300);
			}
		}
	}

})