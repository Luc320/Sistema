    <?php 
        include("../conexao.php");
        $ID_USER = $_SESSION['ID_USER']; 
        $sql2 = "Select * from grupo where ID_USER='$ID_USER' order by cod_grupo asc";
        $execbanco2=mysqli_query($conn,$sql2);
        $linhas = mysqli_num_rows($execbanco2);

        if (mysqli_num_rows($execbanco2)==0){
            //nenhum registro encontrado.
        }  
        $dados2=mysqli_fetch_array($execbanco2);

        $ID_USER = $_SESSION['ID_USER'];
        $sql3 = "select max(COD_DESCRITIVO)+1 COD_DESCRITIVO from descritivo where ID_USER='$ID_USER' ";
        $execbanco3=mysqli_query($conn,$sql3);
        $linhas3 = mysqli_num_rows($execbanco3);

        if (mysqli_num_rows($execbanco3)==0){
            //nenhum registro encontrado.
        }  
        $dados3=mysqli_fetch_array($execbanco3);
    ?>

    <div class="table-responsive">
        <Form method="post" action="inc_descritivo.php"> 
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="cod_descritivo_id" class="form-label">
                                <p>Código: <input type='text' readonly name='cod_descritivo' class="form-control" maxlength="2" size="1" value="<?php echo $dados3['COD_DESCRITIVO']?>"> </p> 
                            </label>
                        </th>

                        <th>
                            <label for="tipo_descritivoid" class="form-label">
                                <p>Código Grupo:  
                                    <select name="cod_grupo" class="form-control" id="tipo_descritivoid"> 
                                        <?php for($i = 1;$i <= $linhas; $i++) {
                                            echo "<option value=" . $dados2['COD_GRUPO'] . ">" . $dados2['COD_GRUPO'] . "-" . $dados2['DES_GRUPO'] . "</option>";
                                            $dados2=mysqli_fetch_array($execbanco2);}
                                        ?>
                                    </select>
                                </p>
                            </label> 
                        </th>
                    </tr> 
                    
                    <tr>
                        <th>
                            <label for="id_des_descritivo" class="form-label">
                                <p>Descritivo: <input type='text' name='des_descritivo' class="form-control" size = "40"> </p>
                            </label>    
                        </th>

                        <th>
                            <label for="id_movto" class="form-label">
                                <p class="movimento">Tipo do Movimento: 
                                    <select name='tip_movto' class="form-control" id='id_movto'>  
                                        <?php
                                            echo "<option value='S'>Saída</option>";
                                            echo "<option value='E'>Entrada</option>";
                                        ?>
                                    </select> 
                                </p>
                            </label>  
                        </th>
                    </tr>    

                    <td>
                        <input class="btn btn-primary" type="submit" value="Incluir" id="bt-ok"/>
                    </td>    

                </thead>
            </table>
        </Form>
    </div>