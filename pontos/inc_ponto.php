<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_ponto   =  $_POST['cod_ponto'];
$des_ponto   = $_POST['des_ponto'];
$cod_tipo   = $_POST['cod_tipo'];
$ind_adm   = $_POST['ind_adm'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i'); 

if (empty($cod_ponto)||($cod_ponto == " ")){
    $_SESSION['msg'] = "<p style='color:red;'>Precisa digitar o código do ponto</p>";
    header("Location: ponto.php");
    mysqli_close($conn);
    return;
}

if (isset($_POST['tipo_ponto'])){
    $cod_tipo = $_POST['tipo_ponto'];
}
$ind_adm = isset($_POST["ind_adm"])?$_POST["ind_adm"]:'N';

$ID_USER = $_SESSION['ID_USER'];
$sql = "select * from ponto where COD_PONTO ='$cod_ponto' and ID_USER='$ID_USER'";
$execbanco=mysqli_query($conn,$sql);
if (mysqli_num_rows($execbanco)>=1){
    $_SESSION['msg'] = "<p style='color:red;'>Registro já existe</p>";
    header("Location: ponto.php");
}

$sql_query = "insert into ponto (COD_PONTO,DES_PONTO,COD_TIPO,IND_ADM,ID_USER) values ('" . $cod_ponto  ."','" . $des_ponto  . "','" . $cod_tipo  . "','" . $ind_adm  . "','" . $ID_USER  . "')";


if  (mysqli_query($conn,$sql_query)){
    //echo "New record created successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: ponto.php");

?>
