<?php 
	include('../config.php');

	$user = $_SESSION['email'];
	$data = $_POST['data'];

	$binds = array($user,$data);

	$tasks = Crud::simpleSelectAll('*','tb_task', 'WHERE user_name = ? AND date = ? ORDER BY id DESC',$binds);
	foreach ($tasks as $key => $value) {
?>
<div id="<?php echo $value['id']; ?>" class="texto222 task-single bgLightGray">
	<?php echo $value['task']; ?>
</div><!-- task single -->
<?php } ?>
