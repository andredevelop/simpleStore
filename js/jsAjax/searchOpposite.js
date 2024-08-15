$(function(){

	const btnDellAll = $('.btnDellAll');
	const btnDellSelect = $('.btnDellSelect');
	const tabBody = $('.tab-body');
	const row = $('.tab-body .row');
	const loading = $('.loading');
	const searchForm = $('#search-form');
	var searchInput = $('[name=search]');
	var searchResult = $('#result');
	var count = 0;

	searchForm.submit(()=>{
		return false;
	})

	searchInput.keyup(()=>{
		loading.show();

		$.ajax({
			url:include_path+'ajax/searchOpposite.php',
			type:'post',
			data:{value: searchInput.val()}
		}).done((data)=>{
			loading.hide();

			btnDellAll.show();
			if(data.length == 0){
				btnDellAll.hide();
			}

			tabBody.html(data);
			
			if($('.resultCount').length != 0){
				count = $('.resultCount').attr('count');
			}else{
				count = 0;
			}

			if(searchInput.val() !== ''){
				searchResult.html('Encontrados: <b>'+count+'</b> registros');
			}else{
				searchResult.html('');
			}
			
		});

	});

})