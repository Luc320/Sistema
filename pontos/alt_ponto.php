<?php
session_start();
?>
<?php include("../conexao.php"); 
  
//recebe os dados do formulario 
$cod_ponto = $_POST['cod_ponto'];
$des_ponto = $_POST['des_ponto'];
//
if (isset($_POST['tipo_ponto'])){
    $cod_tipo = $_POST['tipo_ponto'];
}
$ind_adm = isset($_POST["ind_adm"])?$_POST["ind_adm"]:'N';
//
$ID_USER = $_SESSION['ID_USER']; 
$sql_query = "update ponto set DES_PONTO ='$des_ponto', COD_TIPO='$cod_tipo', IND_ADM='$ind_adm' WHERE COD_PONTO ='$cod_ponto' AND ID_USER='$ID_USER'";

if  (mysqli_query($conn,$sql_query)){
    //echo "update record successfully";
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <b> Registro alterado com sucesso! </b>
    </div>';
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: ponto.php");

?>
