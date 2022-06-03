<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exemplo de AJAX sem JQuery</title>
</head>

<body onLoad="update()">

<?php
include("../conexao.php");

// $ID_USER = $_SESSION['ID_USER']; 
$ID_USER = 88;
$sql2 = "Select * from grupo where ID_USER='$ID_USER' order by cod_grupo asc";
$execbanco2=mysqli_query($conn,$sql2);
$linhas = mysqli_num_rows($execbanco2);
if (mysqli_num_rows($execbanco2)==0){
    //nenhum registro encontrado.
}  
$dados2=mysqli_fetch_array($execbanco2);

// $sql3 = "Select * from descritivo where ID_USER='$ID_USER' AND COD_GRUPO=" . $dados2['COD_GRUPO'] . " order by cod_descritivo asc";
// echo $sql3;
// $execbanco3=mysqli_query($conn,$sql3);
// $linhas3 = mysqli_num_rows($execbanco3);
// if (mysqli_num_rows($execbanco3)==0){
//     //nenhum registro encontrado.
// }  
// $dados3=mysqli_fetch_array($execbanco3);

?>
<form name="caixa" action="inc_caixa.php" method="post">
    
   <h1>Grupos</h1>
   <select name="cod_grupo" id="language" onChange="update()"> 
    <?php for($i = 1;$i <= $linhas; $i++) {
        echo "<option value=" . $dados2['COD_GRUPO'] . ">" . $dados2['COD_GRUPO'] . "-" . $dados2['DES_GRUPO'] . "</option>";
        $dados2=mysqli_fetch_array($execbanco2); 
    }
    ?>
    </select>
    <h1>Descritivos</h1>

    <!-- <select name="cod_descritivo" id="language-select"> 
    <?php  
    // for($i = 1;$i <= $linhas3; $i++) { -->
        // echo "<option value=" . $dados3['COD_DESCRITIVO'] . ">" . $dados3['COD_DESCRITIVO'] . "-" . $dados3['DES_DESCRITIVO'] . "</option>";
        // $dados3=mysqli_fetch_array($execbanco3); 
    // }
    // ?>
    -->

    <select id="languages-select" name="cod_descritivo">
        <option value="" disabled selected></option>
    </select> 

</br>
</br>
<button type="submit">INCLUIR</button>

</form>

    <!-- <button id="btn" type="submit">Pesquisar</button> -->
    <script src="script.js"></script>
 
</body>

</html>
