$(function(){

	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');
	const section_form_edit = $('.box-edit-container');
	var search = $('[name=search]');
	var tabBody = $('.tab-body');

	section_form_edit.on('submit','#form-edit',function(){
		loading.show();
		var dataSerie = $(this).serialize();
		btnEvent('disable',$('[name=edit]'));

		$.ajax({
			url:include_path+'ajax/editHearding.php',
			type:'post',
			dataType:'json',
			data:dataSerie
		}).done(function(data){
			if(data.success){
				loading.hide();
				search.trigger('keyup');
				btnEvent('enable',$('[name=edit]'));
				showNotification('success');
			}

			if(data.error){
				loading.hide();
				btnEvent('enable',$('[name=edit]'));
				showNotification('error');
			}
		})

	    return false;
	})

	tabBody.on('click','.btnOpenEdit',function(){
		let id = $(this).attr('id');
		parseToEdit(id);
	})

	function parseToEdit(id){
    	$.ajax({
	        url: include_path+"ajax/returnEditHearding.php",
	        type: "post",
	        data: {id: id}
	    }).done(function(data){
	    	section_form_edit.html(data);
	    	applyMask();
	    })
	}

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
					textNotification.text('Audiência editada!');
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

	function applyMask(){
		$('[format=cnpj]').mask('99.999.999/9999-99');
		$('[format=cpf]').mask('999.999.999-99');
		$('[format=phone]').mask('(00) 0 0000-0000');
		$('[format=date]').mask('99/99/9999');
		$('[format=hour]').mask('00:00');

		if ($('#form-edit [name=person_type]').val() == 'PF') {
			$('#form-edit #title-type-person').html('CPF:');
			$('#form-edit [format=cpf]').css('display','block');
			$('#form-edit [format=cpf]').attr('name','doc');
			$('#form-edit [format=cpf]').removeAttr('disabled');
			$('#form-edit [format=cnpj]').css('display','none');
			$('#form-edit [format=cnpj]').attr('disabled');
			$('#form-edit [format=cnpj]').removeAttr('name');
		}else if($('#form-edit [name=person_type]').val() == 'PJ') {
			$('#form-edit #title-type-person').html('CNPJ:');
			$('#form-edit [format=cnpj]').css('display','block');
			$('#form-edit [format=cnpj]').attr('name','doc');
			$('#form-edit [format=cnpj]').removeAttr('disabled');
			$('#form-edit [format=cpf]').css('display','none');
			$('#form-edit [format=cpf]').attr('disabled');
			$('#form-edit [format=cpf]').removeAttr('name');
		}
	}

})