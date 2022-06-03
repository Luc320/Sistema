    <?php 
        $id=$_POST['id'];
        include("../conexao.php");
        $ID_USER = $_SESSION['ID_USER'];
        $sql = "Select * from descritivo WHERE COD_DESCRITIVO ='$id' AND ID_USER='$ID_USER' order by cod_descritivo desc";
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
        <Form method="post" action="alt_descritivo.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="id_cod_descritivo" class="form-label">
                                <p>Código do Descritivo: <input type='text' readonly name='cod_descritivo' class="form-control" maxlength="2" size="1" value="<?php echo $dados['COD_DESCRITIVO']?>">
                            </label>
                        </th>

                        <th>
                            <label for="id_cod_grupo" class="form-label">
                                <p>Código do Grupo:  
                                    <select name="cod_grupo" class="form-control" id="id_cod_grupo"> 
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
                            </label>
                        </th>
                    </tr>  
                    
                    <tr>
                        <th>
                            <label for="id_des_descritivo" class="form-label">
                                <p>Descrição do Descritivo:  <input type='text' name='des_descritivo' class="form-control" value="<?php echo $dados['DES_DESCRITIVO']?>"></p>
                            </label>
                        </th>

                        <th>
                            <label for="id_movto" class="form-label">
                                <p>Tipo de Movimento: 
                                    <select name='tip_movto' class="form-control" id='id_movto'>  
                                        <?php
                                            $selecionado = "SELECTED";
                                            if ($dados['TIP_MOVTO'] == "E" ){
                                                echo "<option value='E' $selecionado>Entrada</option>";
                                                echo "<option value='S' >Saída</option>";
                                            } else {
                                                echo "<option value='S' $selecionado>Saída</option>";
                                                echo "<option value='E' >Entrada</option>";
                                            }
                                        ?>
                                    </select> 
                                </p>
                            </label>
                        </th>   
                    </tr> 
                    
                    <td>
                        <input class="btn btn-primary" type="submit" value="Alterar" id="bt-ok"/>
                    </td>
                </thead>
            </table>
        </Form>
    </div>