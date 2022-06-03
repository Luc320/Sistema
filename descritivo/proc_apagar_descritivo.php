<?php
session_start(); 
 
include_once("../conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)){
	$ID_USER = $_SESSION['ID_USER']; 
	$result = "DELETE FROM descritivo WHERE COD_DESCRITIVO='$id' AND ID_USER='$ID_USER'";
	$resultado = mysqli_query($conn, $result);
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<b> Registro apagado com sucesso! </b>
		</div>';
		header("Location: descritivo.php");
	}else{	
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<b> Erro o registro não foi apagado com sucesso! </b>
		</div>';
		header("Location: descritivo.php");
	}
}else{	
	$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<b> Necessário selecionar um registro </b>
	</div>';
	header("Location: descritivo.php");
}
