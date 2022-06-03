<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_grupo = $_POST['cod_grupo'];
$des_grupo = $_POST['des_grupo'];

$ID_USER = $_SESSION['ID_USER']; 
$sql_query = "update grupo set DES_GRUPO ='$des_grupo' WHERE COD_GRUPO ='$cod_grupo' AND ID_USER='$ID_USER' ";


if  (mysqli_query($conn,$sql_query)){
    //echo "update record successfully";
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <b> Registro alterado com sucesso! </b>
    </div>';
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: grupo.php");

?>
