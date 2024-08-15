<?php 

class Central{

	public static $permissao = [
		'0' => 'Tester',
		'1' => 'Basic',
		'2' => 'Full',
		'3' => 'Ceo',
		'4' => 'Mini'
	];

	public static function logado(){
		return isset($_SESSION['login']) ? true : false;
	}

	public static function loggout(){
		setcookie('recordPass',true,time()-1,'/');
		session_destroy();
		header('Location:'.INCLUDE_PATH);
	}

	public static function alerta($tipo,$mensagem){
		if($tipo == 'sucesso'){
			echo '<div class="sucesso-box"><i class="fas fa-exclamation-triangle"></i> '.$mensagem.'</div>';
		}else if($tipo == 'erro'){
			echo '<div class="erro-box"><i class="fas fa-exclamation-triangle"></i> '.$mensagem.'</div>';
		}
	}

	public static function alertaClienteTipo($tipo,$mensagem){
		if($tipo == 'basic'){
			echo '<div class="user-msg-permiss"><i class="fa-solid fa-mug-saucer"></i> '.$mensagem.'</div>';
		}else if($tipo == 'tester'){
			echo '<div class="user-msg-permiss"><i class="fa-solid fa-hand-sparkles"></i> '.$mensagem.'</div>';
		}elseif($tipo == 'full'){
			echo '<div class="user-msg-permiss"><i class="fa-solid fa-dragon"></i> '.$mensagem.'</div>';
		}elseif($tipo == 'mini'){
			echo '<div class="user-msg-permiss"><i class="fa-solid fa-person-rays"></i> '.$mensagem.'</div>';
		}
	}

	public static function alertaJs($mensagem){
		echo '<script>alert("'.$mensagem.'");</script>';
	}

	public static function insereDtb($arr){
		$certo = true;
		$nome_form = $arr['nome_form'];

		$query = "INSERT INTO `$nome_form` VALUES (null ";
		foreach($arr as $key -> $value){
			$nome = $key;
			if($nome == 'cadastrar' || $nome_form == 'nome_form'){
				continue;
			}
			if($value == ''){
				$certo = false;
				break;
			}
			$query.=",?";
			$parametros[] = $value;
		}
		$query.=")";
	}
//insert month data tem ano -------------
	public static function insertMonthCount($name,$mes,$ano,$entrada,$saida){
		//search the month
		$bsc = MySql::conectar()->prepare("SELECT * FROM `tb_meses_count` WHERE user_name = ? AND mes = ? AND ano = ?");
		$bsc->execute(array($name,$mes,$ano));
		//if month exists
		if($bsc->rowCount() == 1){
			$bsc = $bsc->fetch();
			$sql = MySql::conectar()->prepare("UPDATE `tb_meses_count` SET entrada = ?, saida = ?, total = ? WHERE user_name = ? AND mes = ? AND ano = ?");
			if($sql->execute(array($entrada+=$bsc['entrada'],$saida+=$bsc['saida'],$entrada-=$saida,$name,$mes,$ano))){
				return true;
			}else{
				return false;
			}
		}else{
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_meses_count` VALUES (null,?,?,?,?,?,?)");
			if($sql->execute(array($name,$mes,$ano,$entrada,$saida,$entrada-=$saida))){
				return true;
			}else{
				return false;
			}
		}
	}
//insert day data nao precisa do ano pois busca por data
	public static function insertDayCount($name,$dia,$pag,$name_produto,$quantidade,$entrada,$saida){
		$diaC = MySql::conectar()->prepare("SELECT * FROM `tb_dia_count` WHERE user_name = ? AND dia_mes = ? AND tipo_pagamento = ? AND produto_nome = ?");
		$diaC->execute(array($name,$dia,$pag,$name_produto));

		if($diaC->rowCount() == 1){
			$diaC = $diaC->fetch();
			$sqlDay = MySql::conectar()->prepare("UPDATE `tb_dia_count` SET quantidade = ?, entrada = ?, saida = ?, total = ? WHERE user_name = ? AND dia_mes = ? AND tipo_pagamento = ? AND produto_nome = ? ");
			if($sqlDay->execute(array($quantidade+=$diaC['quantidade'],$entrada+=$diaC['entrada'],$saida+=$diaC['saida'],$entrada-=$saida,$name,$dia,$pag,$name_produto))){
				return true;
			}else{
				return false;
			}
		}else{
			$sqlDay = MySql::conectar()->prepare("INSERT INTO `tb_dia_count` VALUES (null,?,?,?,?,?,?,?,?)");
			if($sqlDay->execute(array($name,$dia,$pag,$name_produto,$quantidade,$entrada,$saida,$entrada-=$saida))){
				return true;
			}else{
				return false;
			}
		}
	}
//cards consulta
	public static function updateCardsConsulta($user,$dia,$tipo){
		$cards = MySql::conectar()->prepare("SELECT *, SUM(entrada) AS entrada, SUM(saida) AS saida, SUM(total) AS total FROM `tb_dia_count` WHERE user_name = ? AND dia_mes = ? AND tipo_pagamento = ?");
		$cards->execute(array($user,$dia,$tipo));
		
		return $cards->fetchAll();
	}
//consulta
	public static function updateConsulta($user,$dia,$tipo){
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_dia_count` WHERE user_name = ? AND dia_mes = ? AND tipo_pagamento = ?");
		$sql->execute(array($user,$dia,$tipo));

		return $sql->fetchAll();
	}
//consulta produtoHanking home compara ano com dia do mes
	public static function produtoHanking($username){
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_dia_count` WHERE user_name = ? AND SUBSTR(dia_mes,7,10) = ? AND (produto_nome != 'Entrada de capital' AND produto_nome != 'Retirada sem venda') ");
		$sql->execute(array($username,date('Y')));

		return $sql->fetchAll();
	}
//update grafico home tem o ano
	public static function updateGrafHome($username){
		$ano = date('Y',time());
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_meses_count` WHERE user_name = ? AND ano = ?");
		$sql->execute(array($username,$ano));

		return $sql->fetchAll();
	}	
//update cards home tem ano
	public static function updateCardsHome($username){
		$ano = date('Y',time());
		$cards = MySql::conectar()->prepare("SELECT SUM(entrada) AS entrada, SUM(saida) AS saida, SUM(total) AS total FROM `tb_meses_count` WHERE user_name = ? AND ano = ?");
		$cards->execute(array($username,$ano));
		return $cards->fetchAll();
	}
//graficos comparativo
	public static function comparativoGraf($username){
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_meses_count` WHERE user_name = ? group by mes,ano");
		$sql->execute(array($username));

		return $sql->fetchAll();
	}	

	public static function uploadFile($file){
		$formatoArquivo = explode('.',$file['name']);
		$nomeImagem = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
		if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$nomeImagem)){
			return $nomeImagem;
		}else{
			return false;
		}
	}

	public static function uploadUpdateFile($file){
		$formatoArquivo = explode('.',$file['name']);
		$nomeImagem = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
		if(move_uploaded_file($file['tmp_name'],'../uploads/'.$nomeImagem)){
			return $nomeImagem;
		}else{
			return false;
		}
	}

	public static function deleteFile($file){
		@unlink('uploads/'.$file);
	}

	public static function imagemValida($imagem){
		if($imagem['type'] == 'image/jpeg' ||
		   $imagem['type'] == 'image/jpg' ||
		   $imagem['type'] == 'image/png'){

			$tamanho = intval($imagem['size']/1024);
			if($tamanho < 1900){
				return true;
			}else{
				return false;
			}

			return true;
		}else{
			return false;
		}
	}

	public static function cadastrar($nome,$email,$telefone,$senha,$imagem,$permissao,$tema){
		$sql = MySql::conectar()->prepare("INSERT INTO `tb_usuarios` VALUES (null,?,?,?,?,?,?,?)");
		$sql->execute(array($nome,$email,$telefone,$senha,$imagem,$permissao,$tema));
	}

	public static function atualizarUsuario($nome,$email,$telefone,$senha,$imagem,$permissao,$tema){
	//os parametros sao os posts da pagina editar-usuario
	//estou dando update nas colunas correpondentes onde o usuario for igual o da sessao
		$sql = MySql::conectar()->prepare("UPDATE `tb_usuarios` SET nome =?,email = ?,telefone = ?,senha = ?,imagem = ?,permissao = ?,tema = ? WHERE email = ?");
	//se conseguir executar isso retorna true e se não, retorna false
		if($sql->execute(array($nome,$email,$telefone,$senha,$imagem,$permissao,$tema,$_SESSION['email']))){
			return true;
		}else{
			return false;
		}
	}

	public static function atualizarCliente($user,$nome,$email,$telefone,$tipo,$status,$divida,$vencimento,$id){
		$sql = MySql::conectar()->prepare("UPDATE `tb_clientes` SET user_name =?, nome =?,email = ?,telefone = ?,tipo = ?,status = ?,divida = ?,vencimento = ? WHERE id = ?");
		if($sql->execute(array($user,$nome,$email,$telefone,$tipo,$status,$divida,$vencimento,$id))){
			return true;
		}else{
			return false;
		}
	}

	public static function atualizarFornecedor($username,$nome,$servico,$val_produto,$frete,$telefone,$email,$tipo,$doc,$observacoes,$id){
		$sql = MySql::conectar()->prepare("UPDATE `tb_fornecedores` SET user_name =?, nome =?,servico = ?,val_produto = ?,frete = ?,telefone = ?,email = ?,tipo = ?,documento = ?,observacao = ? WHERE id = ?");
		if($sql->execute(array($username,$nome,$servico,$val_produto,$frete,$telefone,$email,$tipo,$doc,$observacoes,$id))){
			return true;
		}else{
			return false;
		}
	}

	public static function atualizarConta($user,$conta,$status,$valor,$data,$id){
		$sql = MySql::conectar()->prepare("UPDATE `tb_contas` SET user_name =?, conta =?,status = ?,valor = ?,data = ? WHERE id = ?");
		if($sql->execute(array($user,$conta,$status,$valor,$data,$id))){
			return true;
		}else{
			return false;
		}
	}

	//update the user_name into meses_count db
	public static function updateUserMes($username){
		$sql = MySql::conectar()->prepare("UPDATE `tb_meses_count` SET user_name = ? WHERE user_name = ?");
		if($sql->execute(array($username,$_SESSION['email']))){
			return true;
		}else{
			return false;
		}
	}

	//update the user_name quando trocar editar o usuario
	public static function updateWhenEdit($username,$dtb){
		$sql = MySql::conectar()->prepare("UPDATE `$dtb` SET user_name = ? WHERE user_name = ?");
		if($sql->execute(array($username,$_SESSION['email']))){
			return true;
		}else{
			return false;
		}
	}
	//update produto depois do resgistro de dados
//------sugerir registrar produto com nome diferente se de marcas diferentes
	public static function updateQuantProd($username,$name_produto,$quantidade){

		$estoque = MySql::conectar()->prepare("SELECT * FROM `tb_estoque` WHERE user_name = ? AND nome = ?");
		$estoque->execute(array($username,$name_produto));

		if($estoque->rowCount() == 1){
			$estoque = $estoque->fetch();
			if($estoque['quantidade'] >= $quantidade){
				$sql = MySql::conectar()->prepare("UPDATE `tb_estoque` SET quantidade = ?, user_name = ? WHERE user_name = ? AND nome = ?");
				if($sql->execute(array($estoque['quantidade']-=$quantidade,$username,$username,$name_produto))){
					return true;
				}else{
					return false;
				}
			}elseif($estoque['quantidade'] < $quantidade){
				$sql = MySql::conectar()->prepare("UPDATE `tb_estoque` SET quantidade = ?, user_name = ? WHERE user_name = ? AND nome = ?");
				if($sql->execute(array(0,$username,$username,$name_produto))){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}

	}

	/*editar coisas na database*/
	public static function editar($arr){
		$first = false;
		$certo = true;
		$nome_tabela = $arr['nome_tabela'];
		$query = "UPDATE `$nome_tabela` SET ";
		foreach ($arr as $key => $value) {
			$nome = $key;
			$valor = $value;
			if($nome == 'editar' || $nome == 'nome_tabela' || $nome == 'id')
				continue;
			if($value == ''){
				$certo = false;
				break;
			}
			if($first == false){
				$first = true;
				$query.="$nome=?";
			}else{
				$query.=",$nome=?";
			}
			$parametros[]=$valor;
		}
		if($certo == true){
			$parametros[]=$arr['id'];
			$sql = MySql::conectar()->prepare($query.' WHERE id=? ');
			$sql->execute($parametros);
		}
		return $certo;
	}

	public static function usuarioExiste($email){
		$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_usuarios` WHERE email = ?");
		$sql->execute(array($email));
		if($sql->rowCount() == 1){
			return true;
		}else{
			return false;
		}
		
	}

	/*validar arquivo se tiver na pagina*/
	public static function incluirArquivoJs($pagina,$caminho){
		$url = explode('/',$_GET['url'])[0];
		if($url == $pagina){
			echo '<script src="'.INCLUDE_PATH.$caminho.'"></script>';
		}
	}

	/*validar arquivo se tiver na pagina*/
	public static function incluirArquivoCss($pagina,$caminho){
		$url = explode('/',$_GET['url'])[0];

		if($url == $pagina){
			echo '<link href="'.INCLUDE_PATH.$caminho.'" rel="stylesheet">';
		}
	}

	public static function incluirPagina(){
		$url = explode('/',$_GET['url'])[0];

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}elseif($url == 'home'){
			include('pages/main.php');
		}else{
			Central::alerta('erro','Não existe uma página com esse nome!');
		}
	}

	public static function comparaData($sqlData,$compare){
		$data_atual = new DateTime();
		$dataCompare = new DateTime($compare);

		$dataSql = DateTime::createFromFormat('d/m/Y', $sqlData);

		if ($dataSql >= $dataCompare && $dataSql <= $data_atual) {
		    echo " - Novo";
		}

	}

	public static function apagarNoticeMes(){
		//$data_atual = date('Y-m-d',strtotime('-1 day'));
		$data_um_mes_atras = date('Y-m-d', strtotime('-1 month'));

        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_notificacao` WHERE DATE_FORMAT(STR_TO_DATE(data, '%d/%m/%Y'), '%Y-%m-%d') = '$data_um_mes_atras'");
        $sql->execute();
        $resultados = $sql->fetchAll();

        foreach ($resultados as $row) {
            $id = $row['id'];
            $sql = MySql::conectar()->prepare("DELETE FROM `tb_notificacao` WHERE id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
        }
	}

	public static function deleteWithGet($value,$dtb,$url){
		$id = (int)$value;
		$delete = MySql::conectar()->prepare("DELETE FROM `$dtb` WHERE id = ?");
		if($delete->execute(array($id))){
			echo '<script>window.location.href="'.INCLUDE_PATH.$url.'";</script>';
		}
	}

	public static function deleteUpWithGet($value,$dtb,$url){
		$id = (int)$value;

		$tabela = MySql::conectar()->prepare("SELECT * FROM `$dtb` WHERE id = ? ");
		$tabela->execute(array($id));
		$tabela = $tabela->fetchAll();
		
		foreach ($tabela as $key => $value) {
			if($value['quantidade'] <= 1){
				$delete = MySql::conectar()->prepare("DELETE FROM `$dtb` WHERE id = ?");
				if($delete->execute(array($id))){
					echo '<script>window.location.href="'.INCLUDE_PATH.$url.'";</script>';
				}
			}else{
				$upTabela = MySql::conectar()->prepare("UPDATE `$dtb` SET quantidade = ?, preco = ? WHERE id = ?");
				if($upTabela->execute(array($value['quantidade']-=1 ,$value['preco']-=($value['preco']/$value['quantidade']+=1),$id))){
					echo '<script>window.location.href="'.INCLUDE_PATH.$url.'";</script>';
				}
			}
		}
	}

	public static function insertContas($user_name,$conta,$status,$valor,$dia){
		$sql = MySql::conectar()->prepare("INSERT INTO `tb_contas` VALUES (null,?,?,?,?,?)");
		if($sql->execute(array($user_name,$conta,$status,$valor,$dia))){
			return true;
		}else{
			return false;
		}
	}

	public static function validaTema($user){
		$sql = MySql::conectar()->prepare("SELECT tema FROM `tb_usuarios` WHERE email = ?");
		$sql->execute(array($user));
		$sql = $sql->fetch();
		return $sql['tema'];
	}

}	

?>