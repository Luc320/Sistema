<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_tipo = $_POST['cod_tipo'];
$des_tipo = $_POST['des_tipo'];

$ID_USER = $_SESSION['ID_USER']; 
$sql_query = "update tipo_ponto set DES_TIPO ='$des_tipo' WHERE COD_TIPO ='$cod_tipo' AND ID_USER='$ID_USER'";


if  (mysqli_query($conn,$sql_query)){
    //echo "update record successfully";
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <b> Registro alterado com sucesso! </b>
    </div>';
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: tipo_ponto.php");

?>
