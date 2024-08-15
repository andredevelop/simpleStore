$(function(){
	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');
	const btnEdit = $('[name=edit]');
	var userContainer = $('.user-wrap .container');

	$('#form-edit').submit(function(){
		var els = new FormData(this);

		loading.show();
		btnEvent('disable',btnEdit);

		$.ajax({
			url:include_path+'ajax/editUser.php',
			type:'post',
			dataType:'json',
			data:els,
			cache:false,
			contentType: false,
			processData: false,
			xhr: function(){
				var myXhr = $.ajaxSettings.xhr();
				if(myXhr.upload){
					myXhr.upload.addEventListener('progress',function(){},false);
				}
				return myXhr;
			}
		}).done(function(data){
			if(data.success){
				loading.hide();
				btnEvent('enable',btnEdit);
				showNotification('success');

				var timeoutId = setTimeout(function(){
			        location.reload();
			        clearTimeout(timeoutId);
			    }, 1000);
			}

			if(data.error){
				loading.hide();
				btnEvent('enable',btnEdit);
				showNotification('error');
			}
		})

		return false;
	})


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
			btn.val('Editar');
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
					textNotification.text('Usuário editado!');
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
					textNotification.text('Nem dados em branco, nem imagem grande demais!');
					setTimeout(function(){
						notification.fadeOut();
					},2500);
				},300);
			}
		}
	}

})
