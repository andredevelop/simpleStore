$(function(){
	
	// global
	var selectOpt = $('[name=person_type]');
	var btnClearForm = $('.btnClearForm');
	var tabBody = $('.tab-body');

	// add
	const section_form_add = $('.box-add-container');
	const formAdd = $('.box-add-container form');
	const close_form = $('.box-add-container .fa-xmark');
	const btn_open_form = $('.btnOpenForm');

	// edit
	const section_form_edit = $('.box-edit-container');
	const close_form_edit = '.fa-xmark';
	// var btn_open__edit = $('.btnOpenEdit');

	openFormAdd(close_form,btn_open_form,section_form_add,formAdd);
	formEditEvent(close_form_edit,section_form_edit);

	function openFormAdd(btnClose,btnOpenAdd,formBox,form){
		btnClose.click(()=>{
			formBox.fadeOut();
			form[0].reset();
			selectOpt.trigger('change');
		})

		btnOpenAdd.click(()=>{
			formBox.fadeIn();
		})

		clearForm(form);
	}

	function formEditEvent(btnClose,formBox){
		formBox.on('click',btnClose,function(){
			formBox.fadeOut();
			selectOpt.trigger('change');
			$('.row[selected]').trigger('click');
		})

		tabBody.on('click','.btnOpenEdit',function(){
			section_form_edit.fadeIn();
			$('.row[selected]').trigger('click');
		})
	}

	function clearForm(form){
		btnClearForm.click(()=>{
			form[0].reset();
			selectOpt.trigger('change');
		})
	}

})