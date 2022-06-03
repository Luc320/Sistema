<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_tipo   =  $_POST['cod_tipo'];
$des_tipo   = $_POST['des_tipo'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i');
// echo $cod_tipo . "x";
// die();
if (empty($cod_tipo)||($cod_tipo == " ")){
    $_SESSION['msg'] = "<p style='color:red;'>Precisa digitar o código do tipo</p>";
    header("Location: tipo_ponto.php");
    mysqli_close($conn);
    return;
}
$ID_USER = $_SESSION['ID_USER'];
$sql = "select * from tipo_ponto where COD_TIPO ='$cod_tipo' AND ID_USER='$ID_USER'";
$execbanco=mysqli_query($conn,$sql);
if (mysqli_num_rows($execbanco)>=1){
    $_SESSION['msg'] = "<p style='color:red;'>Registro já existe</p>";
    header("Location: tipo_ponto.php");
}

$sql_query = "insert into tipo_ponto (COD_TIPO,DES_TIPO,ID_USER) values ('" . $cod_tipo  ."','" . $des_tipo  . "','" . $ID_USER  . "')";
// echo $sql_query;
// die();

if  (mysqli_query($conn,$sql_query)){
    //echo "New record created successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: tipo_ponto.php");

?>
