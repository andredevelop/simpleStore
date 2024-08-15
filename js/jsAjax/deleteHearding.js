$(function(){

	var idSelected = [];
	const btnDellAll = $('.btnDellAll');
	const btnDellSelect = $('.btnDellSelect');
	const dialogBox = $('.dialogBox-layer');
	const yes = $('.yes');
	const not = $('.not');
	const loading = $('.loading');
	const notification = $('.notification');
	const textNotification = $('.textNotification');
	var search = $('[name=search]');

	toFix();
	mainAction();

	function mainAction(){
		$('body').on('click','.row',function(){
			btnDellSelect.show();
			btnDellAll.hide();
			var row = $(this);
			var id = row.attr('id');
			var index = idSelected.indexOf(id);

			if(index !== -1){
				idSelected.splice(index,1);
			}else{
				idSelected.push(id);
			}

			btnDellSelect.click(()=>{
				deleteRow(idSelected);
			})

			colorRow(row);
		})

		btnDellAll.click(function(){
			let row = $('.row');
			colorRow(row);

			idSelected = $('.row').map(function(){
				return this.id;
			}).get();

			deleteRow(idSelected);
		})
	}

// -------

	function deleteRow(ids){
		dialogBox.css('display','flex');

		yes.click(()=>{
			loading.show();
			$.ajax({
				url:include_path+'ajax/deleteHearding.php',
				type:'post',
				dataType:'json',
				data:{'id':ids}
			}).done(function(data){
				if(data.success){
					loading.hide();
					dialogBox.css('display','none');
					$('.row[selected]').remove();
					search.trigger('keyup');
					showNotification('success');
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
			downRow($('.row[selected]'));
			$('.row[selected]').removeClass('bgCleanGray');
			$('.row[selected]').removeAttr('selected');
			if($('.row[selected]').length == 0){
				btnDellSelect.hide();
				btnDellAll.show();
			}
			ids = [];
			idSelected = [];
			dialogBox.css('display','none');
		})
	}

	function colorRow(row){
		if(!row.attr('selected')){
			row.addClass('bgCleanGray');
			row.attr('selected','true');
			upRow(row);
		}else if(row.attr('selected')){
			row.removeClass('bgCleanGray');
			row.removeAttr('selected');
			downRow(row);
			if($('.row[selected]').length == 0){
				btnDellSelect.hide();
				btnDellAll.show();
			}
		}
	}

	function upRow(row){
		row.css({
			transition:'.4s',
			transform:'translateY(-5px)'
		})
		row.addClass('box-shadow');
	}

	function downRow(row){
		row.css({
			transition:'.4s',
			transform:'translateY(0px)'
		})
		row.removeClass('box-shadow');
	}

	function toFix(){
		search.keyup(()=>{
			idSelected = [];
			if(idSelected.length == 0){
				btnDellSelect.hide();
			}
		})

		if($('.row').length == 0){
			btnDellAll.hide();
			btnDellSelect.hide()
		}
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
					textNotification.text('Audiência deletada!');
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

