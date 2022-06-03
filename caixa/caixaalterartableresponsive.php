
<?php 
$id=$_POST['id'];

include("../conexao.php");

$ID_USER = $_SESSION['ID_USER'];
$sql = "Select * from caixa WHERE COD_MOVTO ='$id' AND ID_USER='$ID_USER' order by cod_movto desc";
    $execbanco=mysqli_query($conn,$sql);
    if (mysqli_num_rows($execbanco)==0){
        //nenhum registro encontrado.
    }  
    $dados=mysqli_fetch_array($execbanco);

    // lista dos grupos para exibir     
    $sql2 = "Select * from grupo WHERE ID_USER = '$ID_USER' order by cod_grupo  asc";
    $execbanco2=mysqli_query($conn,$sql2);
    $linhas = mysqli_num_rows($execbanco2);
    if ($linhas==0){
        //nenhum registro encontrado.
    }  
    $dados2=mysqli_fetch_array($execbanco2);
?>

  
    <div class="table-responsive">
       <Form method="post" action="alt_caixa.php">
                   <input type='hidden' name='cod_movto' value="<?php echo $dados['COD_MOVTO']?>">
                   <p><b>Código do movimento:</b>&nbsp;<?php echo $dados['COD_MOVTO']?></p>
                   <p><b>Código do Ponto:  </b>
                   <select name="cod_ponto" id="id_cod_ponto"> 
                       <?php for($i = 1;$i <= $linhas1; $i++) {
                           echo "<option value=" . $dados1['COD_PONTO'] . ">" . $dados1['COD_PONTO'] . "-" . $dados1['DES_PONTO'] . "</option>";
                           $dados1=mysqli_fetch_array($execbanco1);}  ?>
                    </select>
                    </p>
                   <p><b>Código do Grupo:  </b>
                   <select name="cod_grupo" id="id_cod_grupo"> 
                       <?php for($i = 1;$i <= $linhas; $i++) {
                           $selecionado = "";
                            if ($dados['COD_GRUPO'] == $dados2['COD_GRUPO']){
                               $selecionado = 'SELECTED';   
                           }
                         echo "<option value=" . $dados2['COD_GRUPO'] . " " . $selecionado .">" . $dados2['COD_GRUPO'] . "-" . $dados2['DES_GRUPO'] . "</option>";
                         $dados2=mysqli_fetch_array($execbanco2); }
                        ?>
                    </select>
                    </p>
                   <p><b>Descrição do Descritivo:  </b><input type='text' name='cod_descritivo' value="<?php echo $dados['COD_DESCRITIVO']?>"></p>

                   <p><b>Valor do Movimento:  </b><input type='text' name='valor' value="<?php echo $dados['VLR_MOVTO']?>"></p>
                   
                   <p><b>Observação:  </b><input type='text' name='observacao' value="<?php echo $dados['OBS_TEXTO']?>"></p>
                   <input class="btn btn-primary btn-user btn-block" type="submit" value="OK" id="bt-ok"/>
        </Form>
    </div>