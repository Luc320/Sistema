<?php
session_start();
?>
<?php include("../conexao.php");
  
//recebe os dados do formulario 
$cod_descritivo   =  $_POST['cod_descritivo'];
$cod_grupo   = $_POST['cod_grupo'];
$des_descritivo   = $_POST['des_descritivo'];
$tip_movto   = $_POST['tip_movto'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i'); 

if (empty($cod_descritivo)||($cod_descritivo == " ")){
    $_SESSION['msg'] = "<p style='color:red;'>Precisa digitar o código do descritivo</p>";
    header("Location: descritivo.php");
    mysqli_close($conn);
    return;
}

if (isset($_POST['descritivo'])){
    $cod_descritivo = $_POST['descritivo'];
}


$ID_USER = $_SESSION['ID_USER'];
$sql = "select * from descritivo where COD_DESCRITIVO ='$cod_descritivo' and ID_USER='$ID_USER'";
$execbanco=mysqli_query($conn,$sql);
if (mysqli_num_rows($execbanco)>=1){
    $_SESSION['msg'] = "<p style='color:red;'>Registro já existe</p>";
    header("Location: descritivo.php");
}

$sql_query = "insert into descritivo (COD_DESCRITIVO,COD_GRUPO,DES_DESCRITIVO,TIP_MOVTO,ID_USER) values ('" . $cod_descritivo  ."','" . $cod_grupo  . "','" . $des_descritivo  . "','" . $tip_movto  . "','" . $ID_USER  . "')";


if  (mysqli_query($conn,$sql_query)){
    //echo "New record created successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: descritivo.php");

?>
