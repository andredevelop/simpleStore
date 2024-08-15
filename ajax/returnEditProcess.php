<?php 
	include('../config.php');

	if(isset($_POST['id'])){
		$id = $_POST['id'];

?>

<div class="container bgWhite box-shadow">

	<i class="fa-solid fa-xmark bgRed textF8"></i>

	<h3 class="textLightGray">Editar clientes</h3>

	<form id="form-edit" method="post" class="dspFlexWrap">
		<?php 
			$ProcessVal = Crud::simpleSelectAll('*','tb_process','WHERE id = ?',$id);
			foreach ($ProcessVal as $key => $value){
		?>
		<div class="form-single w50 textLightGray">
			<p>Numero do procesos:</p>
			<input type="text" name="number" value="<?php echo $value['number']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Vara:</p>
			<input type="text" name="tipstaff" value="<?php echo $value['tipstaff']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Tipo de ação:</p>
			<input type="text" name="type_action" value="<?php echo $value['type_action']; ?>">
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
			<p>Audiência - Data:</p>
			<input type="text" format="date" name="audience_date" value="<?php echo $value['audience_date']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Audiência - Hora:</p>
			<input type="text" format="hour" name="audience_hour" value="<?php echo $value['audience_hour']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Prazo:</p>
			<input type="text" format="date" name="term" value="<?php echo $value['term']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Data da petição:</p>
			<input type="text" format="date" name="petition_date" value="<?php echo $value['petition_date']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Data de abertura:</p>
			<input type="text" format="date" name="opening_date" value="<?php echo $value['opening_date']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Status:</p>
			<input type="text" name="status" value="<?php echo $value['status']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Tipo de pessoa:</p>
			<select name="person_type">
				<?php 
					if($value['person_type'] == 'PF'){
				?>
					<option value="PF">PF</option>
					<option value="PJ">PJ</option>
				<?php }else{ ?>
					<option value="PJ">PJ</option>
					<option value="PF">PF</option>
				<?php } ?>
			</select>
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