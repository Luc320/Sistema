<?php
session_start();
?>
<?php include("../conexao.php"); 
  
//recebe os dados do formulario 
$cod_movto   =  $_POST['cod_movto']; 
$cod_ponto   = $_POST['cod_ponto'];
$cod_grupo   = $_POST['cod_grupo'];
$cod_descritivo   = $_POST['cod_descritivo'];
$valor   = $_POST['valor'];
$observacao   = $_POST['observacao'];
//
// if (isset($_POST['tipo_ponto'])){
//     $cod_tipo = $_POST['tipo_ponto'];
// }
//
$ID_USER = $_SESSION['ID_USER']; 
$sql_query = "update caixa set COD_PONTO ='$cod_ponto', COD_GRUPO='$cod_grupo', COD_DESCRITIVO ='$cod_descritivo', VLR_MOVTO ='$valor', OBS_TEXTO ='$observacao' WHERE COD_MOVTO ='$cod_movto' AND ID_USER='$ID_USER'";

if  (mysqli_query($conn,$sql_query)){
    //echo "update record successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: caixa.php");

?>
