<?php 
	include('../config.php');
	
	$value = $_POST['value'];
	$userName = USER_NAME;

	$clientList = MySql::conectar()->prepare("SELECT * FROM `tb_customer` WHERE user_name = ? AND (name LIKE '%' '".$value."' '%' OR doc LIKE '%' '".$value."' '%' OR phone LIKE '%' '".$value."' '%' OR email LIKE '%' '".$value."' '%' OR lawyer LIKE '%' '".$value."' '%') ORDER BY id DESC");
	$clientList->execute(array($userName));
	$clientList = $clientList->fetchAll();

	foreach ($clientList as $key => $value) {
		$count = count($clientList);
		echo '<span class="resultCount" count="'.$count.'"></span>';
?>
	<div class="row dspFlexNoWrap" id="<?php echo $value['id']; ?>">
		<div class="cell"><?php echo $key+1; ?></div>	
		<div class="cell"><?php echo $value['name']; ?></div>	
		<div class="cell"><?php echo $value['doc']; ?></div>	
		<div class="cell"><?php echo $value['phone']; ?></div>	
		<div class="cell"><?php echo $value['email']; ?></div>	
		<div class="cell"><?php echo mb_substr($value['address'], 0, 35).'...';  ?></div>	
		<div class="cell"><?php echo $value['lawyer']; ?></div>	
		<div class="cell"><?php echo $value['observation']; ?></div>	
		<div class="cell"><i id="<?php echo $value['id']; ?>" class="btnOpenEdit textLightGray fa-regular fa-pen-to-square"></i></div>
	</div><!-- row -->
<?php } ?>