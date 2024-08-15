<?php 
	include('../config.php');
	
	$value = $_POST['value'];
	$userName = USER_NAME;

	$processList = MySql::conectar()->prepare("SELECT * FROM `tb_process` WHERE user_name = ? AND (number LIKE '%' '".$value."' '%' OR tipstaff LIKE '%' '".$value."' '%' OR type_action LIKE '%' '".$value."' '%' OR lawyer LIKE '%' '".$value."' '%' OR customer LIKE '%' '".$value."' '%' OR prosecuted LIKE '%' '".$value."' '%' OR audience_date LIKE '%' '".$value."' '%' OR petition_date LIKE '%' '".$value."' '%' OR opening_date LIKE '%' '".$value."' '%' OR status LIKE '%' '".$value."' '%') ORDER BY id DESC");
	$processList->execute(array($userName));
	$processList = $processList->fetchAll();

	foreach ($processList as $key => $value) {
		$count = count($processList);
		echo '<span class="resultCount" count="'.$count.'"></span>';
?>
	<div class="row dspFlexNoWrap" id="<?php echo $value['id']; ?>">
		<div class="cell"><?php echo $key+1; ?></div>	
		<div class="cell"><?php echo $value['number']; ?></div>	
		<div class="cell"><?php echo $value['tipstaff']; ?></div>	
		<div class="cell"><?php echo $value['type_action']; ?></div>	
		<div class="cell"><?php echo $value['lawyer']; ?></div>	
		<div class="cell"><?php echo $value['customer']; ?></div>	
		<div class="cell"><?php echo $value['prosecuted']; ?></div>	
		<div class="cell"><?php echo $value['audience_date'].' - ('.$value['audience_hour'].')'; ?></div>	
		<div class="cell"><?php echo $value['term']; ?></div>	
		<div class="cell"><?php echo $value['petition_date']; ?></div>	
		<div class="cell"><?php echo $value['opening_date']; ?></div>	
		<div class="cell"><?php echo $value['status']; ?></div>	
		<div class="cell"><i id="<?php echo $value['id']; ?>" class="btnOpenEdit textLightGray fa-regular fa-pen-to-square"></i></div>	
	</div><!-- row -->
<?php } ?>