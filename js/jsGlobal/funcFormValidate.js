$(function(){
	
	// add
	var person_type_add = $('#form-add [name=person_type]');
	var pf_add = $('#form-add [format=cpf]');
	var pj_add = $('#form-add [format=cnpj]');
	var doc_title_add = $('#form-add #title-type-person');
	pj_add.add('.user-wrap [format=cnpj]').css('display','none');
	pj_add.add('.user-wrap [format=cnpj]').removeAttr('name');

	changeFormInput(person_type_add, pf_add, pj_add, doc_title_add);
	changeFormInputEdit();

	function changeFormInput(personType, pfElement, pjElement, docTitle) {
		personType.change(() => {
			if (personType.val() == 'PF') {
				docTitle.html('CPF:');
				pfElement.css('display','block');
				pjElement.css('display','none');
				pfElement.attr('name','doc');
				pjElement.removeAttr('name');
			}else if(personType.val() == 'PJ') {
				docTitle.html('CNPJ:');
				pjElement.css('display','block');
				pfElement.css('display','none');
				pjElement.attr('name','doc');
				pfElement.removeAttr('name');
			}
		});
	}

	function changeFormInputEdit() {
		$('.box-edit-container').add('.user-wrap').on('change','select[name=person_type]',function(){
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
		});

	}



});