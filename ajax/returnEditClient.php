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
			$clientVal = Crud::simpleSelectAll('*','tb_customer','WHERE id = ?',$id);
			foreach ($clientVal as $key => $value){
		?>
		<div class="form-single w50 textLightGray">
			<p>Nome:</p>
			<input type="text" name="name" value="<?php echo $value['name']; ?>">
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

		<div class="form-single w50 textLightGray">
			<p id="title-type-person">CPF:</p>
			<?php 
				if($value['person_type'] == 'PF'){
			?>
				<input type="text" format="cpf" name="cpf" value="<?php echo $value['doc']; ?>">
				<input type="text" format="cnpj" name="cnpj">
			<?php }else{ ?>
				<input type="text" format="cnpj" name="cnpj" value="<?php echo $value['doc']; ?>">
				<input type="text" format="cpf" name="cpf">
			<?php } ?>
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Telefone:</p>
			<input type="text" format="phone" name="phone" value="<?php echo $value['phone']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>E-mail:</p>
			<input type="email" name="email" value="<?php echo $value['email']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Endereço:</p>
			<input type="text" name="adress" value="<?php echo $value['address']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Advogado:</p>
			<input type="text" name="lawyer" value="<?php echo $value['lawyer']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Data:</p>
			<input type="text" format="date" name="date" value="<?php echo $value['date']; ?>">
		</div><!-- form-single -->

		<div class="form-single w50 textLightGray">
			<p>Obs:</p>
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