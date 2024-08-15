<?php 
	include('../config.php');
	
	$value = $_POST['value'];
	$userName = USER_NAME;

	$heardingList = MySql::conectar()->prepare("SELECT * FROM `tb_hearding` WHERE user_name = ? AND (hearding LIKE '%' '".$value."' '%' OR type LIKE '%' '".$value."' '%' OR date LIKE '%' '".$value."' '%' OR tipstaff LIKE '%' '".$value."' '%' OR lawyer LIKE '%' '".$value."' '%' OR customer LIKE '%' '".$value."' '%' OR prosecuted LIKE '%' '".$value."' '%' OR process_number LIKE '%' '".$value."' '%') ORDER BY id DESC");
	$heardingList->execute(array($userName));
	$heardingList = $heardingList->fetchAll();

	foreach ($heardingList as $key => $value) {
		$count = count($heardingList);
		echo '<span class="resultCount" count="'.$count.'"></span>';
?>
	<div class="row dspFlexNoWrap" id="<?php echo $value['id']; ?>">
		<div class="cell"><?php echo $key+1; ?></div>	
		<div class="cell"><?php echo $value['hearding']; ?></div>	
		<div class="cell"><?php echo $value['type']; ?></div>	
		<div class="cell"><?php echo $value['location']; ?></div>	
		<div class="cell"><?php echo $value['date']; ?></div>	
		<div class="cell"><?php echo $value['hour']; ?></div>	
		<div class="cell"><?php echo $value['tipstaff']; ?></div>	
		<div class="cell"><?php echo $value['lawyer']; ?></div>	
		<div class="cell"><?php echo $value['customer']; ?></div>	
		<div class="cell"><?php echo $value['prosecuted']; ?></div>	
		<div class="cell"><?php echo $value['process_number']; ?></div>	
		<div class="cell"><?php echo $value['observation']; ?></div>	
		<div class="cell"><i id="<?php echo $value['id']; ?>" class="btnOpenEdit textLightGray fa-regular fa-pen-to-square"></i></div>	
	</div><!-- row -->
<?php } ?>