<div class="table-responsive">

    <?php 
   
        include("../conexao.php");

            $ID_USER = $_SESSION['ID_USER'];

            $sql1 = "Select * from ponto where ID_USER='$ID_USER' order by cod_ponto asc";
            $execbanco1=mysqli_query($conn,$sql1);
            $linhas1 = mysqli_num_rows($execbanco1);
            if (mysqli_num_rows($execbanco1)==0){
                //nenhum registro encontrado.
            }  
            $dados1=mysqli_fetch_array($execbanco1);

            
            
            $sql2 = "Select * from grupo where ID_USER='$ID_USER' order by cod_grupo asc";
            $execbanco2=mysqli_query($conn,$sql2);
            $linhas2 = mysqli_num_rows($execbanco2);
            if (mysqli_num_rows($execbanco2)==0){
                //nenhum registro encontrado.
            }  
            $dados2=mysqli_fetch_array($execbanco2);

            
            $sql3 = "Select * from descritivo where ID_USER='$ID_USER' and COD_GRUPO =" . $dados2["COD_GRUPO"] . " order by cod_descritivo asc";
            $execbanco3=mysqli_query($conn,$sql3);
            $linhas3 = mysqli_num_rows($execbanco3);
            if (mysqli_num_rows($execbanco3)==0){
                //nenhum registro encontrado.
            }  
            $dados3=mysqli_fetch_array($execbanco3);

            
            $sql4 = "select max(COD_MOVTO)+1 COD_MOVTO from caixa where ID_USER='$ID_USER' ";
            $execbanco4=mysqli_query($conn,$sql4);
            $linhas4 = mysqli_num_rows($execbanco4);
            if (mysqli_num_rows($execbanco4)==0){
                //nenhum registro encontrado.
            }  
            $dados4=mysqli_fetch_array($execbanco4);

    ?>
    
    <body onLoad="update('nada')">
        <div class="table-responsive">
            <Form name="caixa" id="caixa" method="post" action="inc_alt_caixa.php"> 
                <table class="table" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr> 
                            <th> 
                                <label for="id_cod_movto" class="form-label">
                                <p class="fst-normal"> Código do Movimento: <input type='text' size='1' class="form-control"  name='cod_movto' id='id_cod_movto' readonly value="<?php echo $dados4['COD_MOVTO']?>"></p>
                                </label>  
                            </th>

                            <th>
                                <label for="cod_ponto_id" class="form-label">
                                <p class="fst-normal"> Código Ponto: <select name="cod_ponto" class="form-control" id="cod_ponto_id"> 
                                    <?php for($i = 1;$i <= $linhas1; $i++) {
                                            echo "<option value=" . $dados1['COD_PONTO'] . ">" . $dados1['COD_PONTO'] . "-" . $dados1['DES_PONTO'] . "</option>";
                                            $dados1=mysqli_fetch_array($execbanco1);}  ?> 
                                </select> </p> </label>    
                            </th>

                        <tr>

                        <tr>
                            <th>
                                <label for="language" class="form-label">
                                <p class="fst-normal"> Código Grupo: <select name="cod_grupo" class="form-control" id="language" onChange="update('nada')"> 
                                        <?php for($i = 1;$i <= $linhas2; $i++) {
                                            echo "<option value=" . $dados2['COD_GRUPO'] . ">" . $dados2['COD_GRUPO'] . "-" . $dados2['DES_GRUPO'] . "</option>";
                                            $dados2=mysqli_fetch_array($execbanco2); }  ?>
                                </select>  </p> </label> 
                            </th>   
                                 
                            <th>
                                <label for="id_data" class="form-label">
                                <p class="fst-normal"> Data Movimento: <input type="date" class="form-control" name='data' id='id_data' onChange="return validar()"></input></p>
                                </label>
                            </th>
                        </tr>

                        <tr>
                            <th>
                                <label for="languages-select" class="form-label">
                                <p class="fst-normal"> Descrição Descritivo:
                                    <select id="languages-select" class="form-control" name="cod_descritivo" leight = "40">
                                        <option value="" disabled, selected> </option>;
                                </select> </p> </label> 
                            </th> 

                            <th>
                                <label for="id_valor" class="form-label">
                                <p class="fst-normal"> Valor: <input type="text" class="form-control" name='valor' id='id_valor'  onkeyup="formatarMoeda()" maxlength="18"></input></p>
                                </label>
                            </th>
                        </tr>

                        <tr>
                            <th>
                                <label for="id_obs" class="form-label"> <p class="fst-normal"> Observação: 
                                <br>  <textarea name="observacao"  class="form-control" id="id_obs" row="6" cols="50"></textarea></p>
                                </label> 
                            </th>
                            <th></th>
                        </tr>    
                
                            <td>
                                 <input class="btn btn-primary" type="submit" onClick="return validar()" value="Salvar" id="bt-salvar"/>
                            </td>
                        
                    </thead>
            </Form>
        </div>

            <?php 
                $sql = "SELECT c.* , d.DES_DESCRITIVO
                FROM caixa c , descritivo d
                WHERE  c.ID_USER='$ID_USER' 
                AND d.COD_DESCRITIVO = c.COD_DESCRITIVO
                AND d.COD_GRUPO = c.COD_GRUPO
                AND d.ID_USER = c.ID_USER
                ORDER BY COD_MOVTO DESC";
                $execbanco=mysqli_query($conn,$sql);
                if (mysqli_num_rows($execbanco)==0){
                        echo"<p align='center'>Nenhum registro foi encontrado </p>";
                    }  
                        else  
                    {
        
                        echo '<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">';
                        echo '<thead class="table-dark">
                        <tr>
                            <th class="fw-light">Movimento</th>
                            <th class="fw-light">Lançamento</th>
                            <th class="fw-light">Ponto</th>
                            <th class="fw-light">Grupo</th>            
                            <th class="fw-light">Descritivo</th>
                            <th class="fw-light">Valor</th>
                            <th class="fw-light">Observação</th>
                        </tr> 
                    </thead>
                    <tfoot class="table-dark">
                            <tr>
                            <th class="fw-light">Movimento</th>
                            <th class="fw-light">Lançamento</th>
                            <th class="fw-light">Ponto</th>
                            <th class="fw-light">Grupo</th>
                            <th class="fw-light">Descritivo</th>
                            <th class="fw-light">Valor</th>
                            <th class="fw-light">Observação</th>
                        </tr> 
                    </tfoot>' ;
                
                    while($dados=mysqli_fetch_array($execbanco)){
                        if ($dados['TIP_MOVTO']=='E'){
                            $TIP_MOVTO = '-Entrada';
                        }else
                        {
                            $TIP_MOVTO = '-Saida';
                        }

                        echo '  <tbody>
                        <tr>
                            <td>';
                        echo  '<b>' . $dados['COD_MOVTO'] . '</b>' . '</td>';
                        echo  '<td>' . date("d/m/Y", strtotime($dados['DAT_MOVTO'] )) . '</td>';
                        echo  '<td>' . $dados['COD_PONTO'] . '</td>' ;
                        echo  '<td>' . $dados['COD_GRUPO'] . '</td>';
                        echo  '<td>' . $dados['COD_DESCRITIVO'] . '-' . $dados['DES_DESCRITIVO'] . '-'. $TIP_MOVTO .  '</td>';
                        echo  '<td>' . $dados['VLR_MOVTO'] . '</td>';
                        echo  '<td>' . $dados['OBS_TEXTO'] . '</td>';

                        echo  '<td> <form method="POST">
                                
                        <input class="btn btn-primary"  value="Alterar" id="bt-alterar" onClick="altera(' . $dados['COD_MOVTO']
                        . ',' . $dados['COD_PONTO']
                        . ',' . $dados['COD_GRUPO']
                        . ',' . "'" . $dados['COD_DESCRITIVO'] . "'"
                        . ',' . "'" . $dados['DAT_MOVTO'] . "'"
                        . ',' . $dados['VLR_MOVTO']
                        . ',' . "'" . $dados['OBS_TEXTO'] . "'"
                        .')"/>
                        <input type="hidden" name="id" value="' . $dados['COD_MOVTO'] . '">

                            </form></td>';

                        echo  "<td>
                                <a href='proc_apagar_caixa.php?id=" . $dados['COD_MOVTO'] .  "' data-confirm='Tem certeza de que deseja excluir o item selecionado?' class='nav-link'>
                                <input class='btn btn-danger' value='Apagar' id='bt-excluir'>
                            </a> 
                        </td>";
                    }
                        echo '</tbody></table>';
                }
                
                    mysqli_close($conn);
            ?>
                    <script src="../js/script.js"></script>
    </body>
</div>