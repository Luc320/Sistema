    <script type="text/javascript">
        function valida_ind_adm(id){
            var status = document.getElementById(id);
            if (status.checked){
                status.value='S'
            }
            else{
                status.value='N'
            }
        }
    </script>

    <?php 
        include("../conexao.php");

            $ID_USER = $_SESSION['ID_USER']; 
            $sql2 = "Select * from tipo_ponto where ID_USER='$ID_USER' order by cod_tipo asc";
            $execbanco2=mysqli_query($conn,$sql2);
            $linhas = mysqli_num_rows($execbanco2);
            if (mysqli_num_rows($execbanco2)==0){
                //nenhum registro encontrado.
            }  
            $dados2=mysqli_fetch_array($execbanco2);

            $ID_USER = $_SESSION['ID_USER'];
            $sql3 = "select max(COD_PONTO)+1 COD_PONTO from ponto where ID_USER='$ID_USER' ";
            $execbanco3=mysqli_query($conn,$sql3);
            $linhas3 = mysqli_num_rows($execbanco3);
            if (mysqli_num_rows($execbanco3)==0){
                //nenhum registro encontrado.
            }  
            $dados3=mysqli_fetch_array($execbanco3);
    ?>
    
    <div class="table-responsive">
        <Form method="post" action="inc_ponto.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="id_cod_ponto" class="form-label">
                                <p>Código do Ponto: <input type='text' readonly name='cod_ponto' class="form-control" maxlength="2" size="1" value="<?php echo $dados3['COD_PONTO']?>"> </p> 
                            </label>
                        </th>  
                        
                        <th>
                            <label for="id_desc_ponto" class="form-label">
                                <p>Descrição Ponto: <input type='text' name='des_ponto' class="form-control" size = "40"> </p>
                            </label>
                        </th>   
                    </tr> 

                    <tr>
                        <th>
                            <label for="tipo_pontoid" class="form-label">
                                <p>Código do Tipo:  
                                    <select name="cod_tipo" class="form-control" id="tipo_pontoid"> 
                                        <?php for($i = 1;$i <= $linhas; $i++) {
                                            echo "<option value=" . $dados2['COD_TIPO'] . ">" . $dados2['COD_TIPO'] . "-" . $dados2['DES_TIPO'] . "</option>";
                                            $dados2=mysqli_fetch_array($execbanco2); }
                                        ?> 
                                    </select>  
                                </p>
                            </label>     
                        </th> 
                        
                        <th>
                            <div class="form-check form-switch">
                                <label class="form-check-label" id="label_ind" for="ind_adm">Indicador Administrativo: </label>
                                <p class="botao">
                                    <input class="form-check-input" type="checkbox" name='ind_adm' id="ind_adm" onclick='valida_ind_adm(id)'>
                                </p> 
                            </div>
                        </th>
                    </tr>

                        <td>
                            <input class="btn btn-primary" type="submit" value="Incluir" id="bt-ok"/>
                        </td>

                </thead> 
            </table>      
        </Form>
    </div>
