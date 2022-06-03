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
        $id=$_POST['id'];
        include("../conexao.php");
        $ID_USER = $_SESSION['ID_USER'];
        $sql = "Select * from ponto WHERE COD_PONTO ='$id' AND ID_USER='$ID_USER' order by cod_ponto desc";
            $execbanco=mysqli_query($conn,$sql);
            if (mysqli_num_rows($execbanco)==0){
                //nenhum registro encontrado.
            }  
            $dados=mysqli_fetch_array($execbanco);

            $sql2 = "Select * from tipo_ponto order by cod_tipo asc";
            $execbanco2=mysqli_query($conn,$sql2);
            $linhas = mysqli_num_rows($execbanco2);
            if (mysqli_num_rows($execbanco2)==0){
                //nenhum registro encontrado.
            }  
            $dados2=mysqli_fetch_array($execbanco2);
    ?>

  
    <div class="table-responsive">
       <Form method="post" action="alt_ponto.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="id_cod_ponto" class="form-label">
                                <p>Código do Ponto:  <input type='text' name='cod_ponto' class="form-control" readonly maxlength="2" size="1" value="<?php echo $dados['COD_PONTO']?>">
                            </label>
                        </th>

                        <th>
                            <label for="id_des_ponto" class="form-label">
                                <p>Descrição do Ponto:  <input type='text' name='des_ponto' class="form-control" value="<?php echo $dados['DES_PONTO']?>"></p>
                            </label>
                        </th>

                    </tr>
                    
                    <tr>
                        <th>
                            <label for="tipo_pontoid" class="form-label">
                                <p>Código do Tipo:  
                                    <select name="tipo_ponto" class="form-control" id="tipo_pontoid"> 
                                        <?php for($i = 1;$i <= $linhas; $i++) {
                                            $selecionado = "";
                                                if ($dados['COD_TIPO'] == $dados2['COD_TIPO']){
                                                $selecionado = 'SELECTED';   
                                            }
                                            echo "<option value=" . $dados2['COD_TIPO'] . " " . $selecionado .">" . $dados2['COD_TIPO'] . "-" . $dados2['DES_TIPO'] . "</option>";
                                            $dados2=mysqli_fetch_array($execbanco2); }
                                        ?>  
                                    </select>   
                                </p> 
                            </label>
                        </th>
                            
                        <th>
                            <div class="form-check form-switch">
                                <label for="ind_adm" id="label_ind" class="form-check-label"> Indicador Administrador:  </label>
                                    <?php
                                        $checado = '';
                                        if ($dados['IND_ADM'] == 'S'){
                                            $checado = ' checked';
                                        } 
                                        echo "<p class='botao'>";
                                        echo "<input type='checkbox' name='ind_adm' class='form-check-input'  value=" . $dados['IND_ADM'] . $checado . " id='ind_adm' onclick='valida_ind_adm(id)'>";
                                    ?>
                            </div>  
                        </th>   
                    </tr>        

                    <td>
                        <input class="btn btn-primary" type="submit" value="Alterar" id="bt-ok"/>
                    </td>    

                </thead> 
            </table>      
        </Form>
    </div>