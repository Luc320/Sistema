<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_grupo  =  $_POST['cod_grupo'];
$des_grupo   = $_POST['des_grupo'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i');

if (empty($cod_grupo)||($cod_grupo == " ")){
    $_SESSION['msg'] = "<p style='color:red;'>Precisa digitar o código do grupo</p>";
    header("Location: grupo.php");
    mysqli_close($conn);
    return;
}

$ID_USER = $_SESSION['ID_USER']; 
$sql = "select * from grupo where COD_GRUPO ='$cod_grupo' and ID_USER='$ID_USER'";
$execbanco=mysqli_query($conn,$sql);
if (mysqli_num_rows($execbanco)>=1){
    $_SESSION['msg'] = "<p style='color:red;'>Registro já existe</p>";
    header("Location: grupo.php");
}

$sql_query = "insert into grupo (COD_GRUPO,DES_GRUPO,ID_USER) values ('" . $cod_grupo  ."','" . $des_grupo  . "','" . $ID_USER  . "')";

if  (mysqli_query($conn,$sql_query)){
    //echo "New record created successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: grupo.php");

?>
