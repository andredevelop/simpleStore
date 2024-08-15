<?php 
	include('../config.php');

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
?>

<div class="container bgWhite box-shadow">

	<i class="fa-solid fa-xmark bgRed textF8"></i>

	<h3 class="textLightGray">Editar audiência</h3>

	<form id="form-edit" method="post" class="dspFlexWrap">
		<?php 
			$clientVal = Crud::simpleSelectAll('*','tb_hearding','WHERE id = ?',$id);
			foreach ($clientVal as $key => $value){
		?>
		<div class="form-single w50 textLightGray">
			<p>Audiência:</p>
			<input type="text" name="hearding" value="<?php echo $value['hearding']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Tipo:</p>
			<input type="text" name="type" value="<?php echo $value['type']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Localização:</p>
			<input type="text" name="location" value="<?php echo $value['location']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Data:</p>
			<input type="text" format="date" name="date" value="<?php echo $value['date']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Hora:</p>
			<input type="text" format="hour" name="hour" value="<?php echo $value['hour']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Vara:</p>
			<input type="text" name="tipstaff" value="<?php echo $value['tipstaff']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Advogado:</p>
			<input type="text" name="lawyer" value="<?php echo $value['lawyer']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Cliente:</p>
			<input type="text" name="customer" value="<?php echo $value['customer']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Processado:</p>
			<input type="text" name="prosecuted" value="<?php echo $value['prosecuted']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Númeor do processo:</p>
			<input type="text" name="process_number" value="<?php echo $value['process_number']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Observação:</p>
			<textarea name="observation"> <?php echo $value['observation']; ?></textarea>
		</div><!-- form-single -->

		<?php } ?>

		<div class="form-single w50">
			<p class="textTransparent">.</p>
			<input type="submit" name="edit" value="Editar" class="bgKelyGreen">
		</div><!-- form-single -->

		<input type="hidden" name="user_name" value="<?php echo USER_NAME; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">

	</form><!-- form-edit -->
</div><!-- container -->

<?php } ?>