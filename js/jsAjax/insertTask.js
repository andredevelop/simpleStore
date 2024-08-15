$(function(){

	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');
	const section_form_edit = $('.box-edit-container');

	insertTask();
	function insertTask(){
		$('form').submit(function(){
			loading.show();
			var dataValue = $(this).serialize();
			$.ajax({
				url:include_path+'ajax/insertTask.php',
				method:'post',
				dataType:'json',
				data: dataValue
			}).done(function(data){

				if(data.success){
					loading.hide();
					showNotification('success');
					returnTaskBell($('[name=date]'));
					returnTask($('[name=date]'));
				}

				if(data.error){
					loading.hide();
					showNotification('error');
				}

			})

			return false;
		})
	}

	changeDayOnClick();
	function changeDayOnClick(){
		$('body').on('click','td[day]',function(){
			loading.show();
			$('td').removeClass('active-day');
			$(this).addClass('active-day');

			var newDay = $(this).attr('day').split('/');

			if(newDay[1] < 10){
				var newDay = newDay[0]+'/'+newDay[1]+'/'+newDay[2];
			}else{
				var newDay = newDay[0]+'/'+newDay[1]+'/'+newDay[2];
			}

			changeDate(newDay);

			updateTasks();
		})
	}
	

	function changeDate(format){
		$('input[type=hidden]').attr('value',format);
		$('form h3').html('Adicionar tarefas para: '+ format);
		loading.show();
	}

	function updateTasks(){
		$('.task-single').remove();
		returnTask();
		returnTaskBell();
	}

	function returnTask(){
		$.ajax({
			url:include_path+'ajax/returnTask.php',
			type:'post',
			data:{'data':$('[name=date]').val()},
			success:function(data){
				$('.box-task').html(data);
				loading.hide();
			}
		})
	}

	function returnTaskBell(){
		$.ajax({
			url:include_path+'ajax/returnTaskBell.php',
			type:'post',
			data:{'dataClick':$('[name=date]').val()},
			success:function(data){
				$('.task-table').html(data);
				loading.hide();
			}
		})
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
					textNotification.text('Tarefa cadastrada!');
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