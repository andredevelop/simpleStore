$(function(){

	var idSelected = [];
	const dialogBox = $('.dialogBox-layer');
	const yes = $('.yes');
	const not = $('.not');
	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');

	mainAction();

	function mainAction(){
		$('body').on('click','.task-single',function(){
			var task = $(this);
			var id = task.attr('id');
			var index = idSelected.indexOf(id);

			if(index !== -1){
				idSelected.splice(index,1);
			}else{
				idSelected.push(id);
			}

			deleteTask(idSelected);
			colorRow(task);
		})
	}

// -------

	function deleteTask(ids){
		dialogBox.css('display','flex');

		yes.click(()=>{
			loading.show();
			$.ajax({
				url:include_path+'ajax/deleteTask.php',
				type:'post',
				dataType:'json',
				data:{'id':ids}
			}).done(function(data){
				if(data.success){
					loading.hide();
					dialogBox.css('display','none');
					$('.task-single[selected]').remove();
					showNotification('success');
					returnTaskBell();
				}

				if(data.error){
					loading.hide();
					dialogBox.css('display','none');
					showNotification('error');
				}
			})
		})

		not.click(()=>{
			loading.hide();
			downRow($('.task-single[selected]'));
			$('.task-single[selected]').removeAttr('selected');
			ids = [];
			idSelected = [];
			dialogBox.css('display','none');
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

	function colorRow(task){
		if(!task.attr('selected')){
			task.attr('selected','true');
			upRow(task);
		}else if(task.attr('selected')){
			task.removeAttr('selected');
			downRow(task);
		}
	}

	function upRow(task){
		task.css({
			transition:'.4s',
			transform:'translateY(-5px)'
		})
	}

	function downRow(task){
		task.css({
			transition:'.4s',
			transform:'translateY(0px)'
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
					textNotification.text('Tarefa deletada!');
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
					textNotification.text('Algo deu errado!');
					setTimeout(function(){
						notification.fadeOut();
					},2500);
				},300);
			}
		}
	}
})

