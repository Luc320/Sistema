<?php
session_start();

include("../conexao.php");
  
//recebe os dados do formulario 
$cod_movto   =  $_POST['cod_movto']; 
$cod_ponto   = $_POST['cod_ponto'];
$cod_grupo   = $_POST['cod_grupo'];
$dat_movto   = $_POST['data'];
$cod_descritivo   = $_POST['cod_descritivo']; 
$tip_movto = strpos($cod_descritivo, '-- Entrada');
$tamanho = strpos($cod_descritivo, '-');
$cod_descritivo = substr($cod_descritivo,0,$tamanho);
// Validação para identificar se o tipo do movimento vai ser "E" ou "S".
if( $tip_movto > 0 ){
    $tip_movto = "E";
} else {
    $tip_movto = "S";
}
$valor   = $_POST['valor'];
$antes = array('.', ',');
$depois = array('', '.');
$valor = str_replace($antes, $depois, $valor);
$observacao   = $_POST['observacao'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i'); 

// Validação de preenchimento do campo do código de movimento.
if (empty($cod_movto)||($cod_movto == " ")){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <b> Precisa digitar o código do movimento </b>
    </div>'; 
    header("Location: caixa.php");
    mysqli_close($conn);
    return;
}

// Validação de preenchimento do campo da data de movimento.
if (empty($dat_movto)||($dat_movto == " ")){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <b> É obrigatório inserir uma data de movimento! </b>
    </div>'; 
    header("Location: caixa.php");
    mysqli_close($conn);
    return;
}

// Validação de preenchimento do campo do valor.
if (empty($valor)||($valor == " ")){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <b> É obrigatório inserir um valor! </b>
    </div>'; 
    header("Location: caixa.php");
    mysqli_close($conn);
    return;
}


$ID_USER = $_SESSION['ID_USER'];
$sql = "select * from caixa where COD_MOVTO ='$cod_movto' and ID_USER='$ID_USER'";
$execbanco=mysqli_query($conn,$sql);
if (mysqli_num_rows($execbanco)>=1){
    $ID_USER = $_SESSION['ID_USER']; 
    $sql_query = "update caixa set COD_PONTO ='$cod_ponto', COD_GRUPO='$cod_grupo', COD_DESCRITIVO ='$cod_descritivo', TIP_MOVTO='$tip_movto', VLR_MOVTO ='$valor', OBS_TEXTO ='$observacao', DAT_MOVTO = '$dat_movto' , DAT_ATUALIZA ='$data' WHERE COD_MOVTO ='$cod_movto' AND ID_USER='$ID_USER'";
    if  (mysqli_query($conn,$sql_query)){
        //echo "update record successfully";
       $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
       <b> Registro alterado com sucesso! </b>
       </div>';
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn); 
    }
    mysqli_close($conn);
    
    header("Location: caixa.php");
}

$sql_query = "insert into caixa (COD_MOVTO,COD_PONTO,COD_GRUPO,DAT_MOVTO,COD_DESCRITIVO,TIP_MOVTO,VLR_MOVTO,OBS_TEXTO,DAT_CADASTRO,ID_USER) values ('" . $cod_movto  ."','" . $cod_ponto  . "','" . $cod_grupo  . "','" . $dat_movto  . "','" . $cod_descritivo  . "','" . $tip_movto  . "','" . $valor  . "','" . $observacao  . "','" . $data  . "','" . $ID_USER  . "')";

if  (mysqli_query($conn,$sql_query)){
    //echo "New record created successfully";
//    $_SESSION['msgcad'] = "<div class='alert alert-success'>Prestador cadastrado com sucesso!</div>";
} else {
    echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);


header("Location: caixa.php");

?>
