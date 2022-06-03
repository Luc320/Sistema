 <?php
session_start();

include("../conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 

if(!empty($id)){
	$ID_USER = $_SESSION['ID_USER']; 
	$result = "DELETE FROM tipo_ponto WHERE id=$id AND ID_USER='$ID_USER'";
	$resultado = mysqli_query($conn, $result);
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "<p style='color:green;'>Registro apagado com sucesso</p>";
		header("Location: tipo_ponto.php");
	}else{
		
		$_SESSION['msg'] = "<p style='color:red;'>Erro o registro não foi apagado com sucesso</p>";
		header("Location: tipo_ponto.php");
	}
}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um registro</p>";
	header("Location: tipo_ponto.php");
}
?>
