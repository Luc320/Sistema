<?php
session_start();
?>
<?php include("../conexao.php"); 
  
//recebe os dados do formulario 
$cod_descritivo = $_POST['cod_descritivo'];
$cod_grupo = $_POST['cod_grupo'];
$des_descritivo = $_POST['des_descritivo'];
$tip_movto = $_POST['tip_movto'];
//
// if (isset($_POST['tipo_ponto'])){
//     $cod_tipo = $_POST['tipo_ponto'];
// }
//
$ID_USER = $_SESSION['ID_USER']; 
$sql_query = "update descritivo set COD_GRUPO ='$cod_grupo', DES_DESCRITIVO='$des_descritivo', TIP_MOVTO='$tip_movto' WHERE COD_DESCRITIVO ='$cod_descritivo' AND ID_USER='$ID_USER'";

if  (mysqli_query($conn,$sql_query)){
    //echo "update record successfully";
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <b> Registro alterado com sucesso! </b>
    </div>';
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: descritivo.php");

?>
