
<div class="table-responsive">
    <body>
        <div class="table-responsive">
            <Form name="extrato" id="extrato" method="get" action=""> 
                    <table class="table" id="table_id" width="100%" cellspacing="0">
                        <thead> 
                            <tr>
                                <th><label for='id_data_inicio'><a>Data Início:</a>
                                <p><b></b><input type='date' name='data_inicio' id='id_data_inicio' class="form-control" onChange='return validar()'></input></p>
                                </label></th> 

                                <th><label for='id_data_fim'><a>Data Fim:</a> 
                                <p><b></b><input type='date' name='data_fim' id='id_data_fim' class="form-control" onChange='return validar()'></input></p> 
                                </label></th>

                                <th><label for='cod_ponto_id'><a>Código Ponto:  </a>
                                <p><select name='cod_ponto' class="form-control" id='cod_ponto_id'>
                                        <?php
                                        $ID_USER = $_SESSION['ID_USER']; 
                                        include("../conexao.php");
                                        $sql = "Select * from ponto where ID_USER='$ID_USER' order by cod_ponto asc";
                                        $execbanco1=mysqli_query($conn,$sql);
                                        $linhas = mysqli_num_rows($execbanco1); 

                                        $dados1=mysqli_fetch_array($execbanco1);
                                            echo "<option value='0'>0-Todos</option>";

                                        for($i = 1;$i <= $linhas; $i++) {
                                            echo "<option value=" . $dados1['COD_PONTO'] . ">" . $dados1['COD_PONTO'] . "-" . $dados1['DES_PONTO'] . "</option>";
                                            $dados1=mysqli_fetch_array($execbanco1); }  ?>  
                                    </select> 
                                </p> </label> </th>
                            </tr> 

                            <tr>

                            <th><label for='cod_tipo_id'><a>Tipo Ponto:  </a>
                                    <p><select name="cod_tipo" id="cod_tipo_id" class="form-control"> 
                                        <?php
                                            $ID_USER = $_SESSION['ID_USER']; 
                                            include("../conexao.php");
                                            $sql = "Select * from tipo_ponto where ID_USER='$ID_USER' order by cod_tipo asc";
                                            $execbanco2=mysqli_query($conn,$sql);
                                            $linhas = mysqli_num_rows($execbanco2);

                                            $dados2=mysqli_fetch_array($execbanco2);
                                                echo "<option value='0'>0-Todos</option>";

                                            for($i = 1;$i <= $linhas; $i++) {
                                            echo "<option value=" . $dados2['COD_TIPO'] . ">" . $dados2['COD_TIPO'] . "-" . $dados2['DES_TIPO'] . "</option>";
                                            $dados2=mysqli_fetch_array($execbanco2); }   ?>
                                    </select>
                                    </p> </label> 
                            </th>  
                            <th><label for='language'><a>Código Grupo:  </a>
                                    <p><select name="cod_grupo" id="language" class="form-control" onChange="update('nada')">   
                                        <?php
                                         $ID_USER = $_SESSION['ID_USER']; 
                                         include("../conexao.php");
                                         $sql = "Select * from grupo where ID_USER='$ID_USER' order by cod_grupo asc";
                                         $execbanco3=mysqli_query($conn,$sql);
                                         $linhas = mysqli_num_rows($execbanco3);

                                        $dados3=mysqli_fetch_array($execbanco3);
                                            echo "<option value='0'>0-Todos</option>";

                                        for($i = 1;$i <= $linhas; $i++) {
                                        echo "<option value=" . $dados3['COD_GRUPO'] . ">" . $dados3['COD_GRUPO'] . "-" . $dados3['DES_GRUPO'] . "</option>";
                                        $dados3=mysqli_fetch_array($execbanco3); }   ?>
                                    </select>
                                    </p> </label> 
                            </th>
                            <th></th>
                            </tr>

                            <td>
                            <input class="btn btn-primary btn-block" type='submit' onClick='return validar()' value='Filtrar' id='bt-filtrar'/>  
                            </td>
                            
                        </thead>
                    </table>            
            </Form>
        </div>
       
        <?php
                $ID_USER = $_SESSION['ID_USER']; 

                if (isset($_GET['data_inicio']) && ! empty($_GET['data_inicio']) ){
                        $dat_inicio = $_GET['data_inicio']; }                                                              
                else  { $dat_inicio = '' ;
                }
                    
                if (isset($_GET['data_fim']) && ! empty($_GET['data_fim']) ){
                        $dat_fim = $_GET['data_fim']; }
                else { $dat_fim = '' ;
                }

                if (isset($_GET['cod_ponto']) && ! empty($_GET['cod_ponto']) ){
                    $cod_ponto = $_GET['cod_ponto']; }                                                              
                else  { $cod_ponto = '' ;
                }

                if (isset($_GET['cod_tipo']) && ! empty($_GET['cod_tipo']) ){
                    $cod_tipo = $_GET['cod_tipo']; }                                                              
                else  { $cod_tipo = '' ;
                }

                if (isset($_GET['cod_grupo']) && ! empty($_GET['cod_grupo']) ){
                    $cod_grupo = $_GET['cod_grupo']; }                                                              
                else  { $cod_grupo = '' ;
                }

                include("../conexao.php");
                // entradas saldo  
                $sql2 = "SELECT SUM(VLR_MOVTO) VLR_ENTRADA
                FROM caixa 
                WHERE caixa.ID_USER='$ID_USER' and ( dat_movto < '$dat_inicio'  or '$dat_inicio' = '') AND TIP_MOVTO = 'E' ";
                $execbanco=mysqli_query($conn,$sql2);
                $dados2=mysqli_fetch_array($execbanco);
                $ENTRADA = $dados2['VLR_ENTRADA'];
                
                // saida saldo  
                $sql3 = "SELECT SUM(VLR_MOVTO) VLR_SAIDA 
                FROM caixa 
                WHERE caixa.ID_USER='$ID_USER' and ( dat_movto < '$dat_inicio'  or '$dat_inicio' = '') AND TIP_MOVTO = 'S' ";
                $execbanco=mysqli_query($conn,$sql3);
                $dados3=mysqli_fetch_array($execbanco);
                $SAIDA = $dados3['VLR_SAIDA'];

                // Atribuindo o calculo de saldo inicial
                $VLR_SALDO_INICIAL = $ENTRADA - $SAIDA; 

                 // entradas saldo  
                $sql3 = "SELECT SUM(VLR_MOVTO) VLR_ENTRADA
                FROM caixa 
                WHERE caixa.ID_USER='$ID_USER' and ( dat_movto >= '$dat_inicio'  or '$dat_inicio' = '')  and ( dat_movto <= '$dat_fim'  or '$dat_fim' = '')  AND TIP_MOVTO = 'E' ";
                $execbanco=mysqli_query($conn,$sql3);
                $dados4=mysqli_fetch_array($execbanco);
                $ENTRADA = $dados4['VLR_ENTRADA'];
                
                // saidas saldo  
                $sql4 = "SELECT SUM(VLR_MOVTO) VLR_SAIDA 
                FROM caixa 
                WHERE caixa.ID_USER='$ID_USER' and ( dat_movto >= '$dat_inicio'  or '$dat_inicio' = '')  and ( dat_movto <= '$dat_fim'  or '$dat_fim' = '') AND TIP_MOVTO = 'S' ";
                $execbanco=mysqli_query($conn,$sql4);
                $dados5=mysqli_fetch_array($execbanco);
                $SAIDA = $dados5['VLR_SAIDA'];

                // Atribuindo calculo de saldo do filtro
                $VLR_SALDO_FILTRO = $ENTRADA - $SAIDA; 
                
                // Atribuindo calculo de saldo final
                $VLR_SALDO = $VLR_SALDO_FILTRO + $VLR_SALDO_INICIAL; 
                
                //Select para filtragem dos dados.
                $sql = "SELECT c.* , d.DES_DESCRITIVO, p.COD_TIPO 
                FROM caixa c , descritivo d, ponto p
                WHERE  c.ID_USER='$ID_USER' 
                AND p.ID_USER = c.ID_USER
                AND c.COD_PONTO = p.COD_PONTO
                AND d.COD_DESCRITIVO = c.COD_DESCRITIVO
                AND d.ID_USER = c.ID_USER
                AND d.COD_GRUPO = c.COD_GRUPO
                AND ( dat_movto >= '$dat_inicio'  or '$dat_inicio' = '')  
                AND ( dat_movto <= '$dat_fim'  or '$dat_fim' = '')
                AND (c.COD_PONTO = '$cod_ponto' or '$cod_ponto' = '')
                AND (p.COD_TIPO = '$cod_tipo' or '$cod_tipo' = '')
                AND (c.COD_GRUPO = '$cod_grupo' or '$cod_grupo' = '')
                ORDER BY COD_MOVTO DESC";

                // Atribuindo os valores das variaveis de filtro
                $filtro_inicio = date("d/m/Y", strtotime($dat_inicio));
                $filtro_fim = date("d/m/Y", strtotime($dat_fim));

                // Verificar se o filtro inicial esta vazio na seleção 
                if($filtro_inicio == "01/01/1970"){
                    $filtro_inicio = "";
                }
                // Verificar se o filtro final esta vazio na seleção 
                if($filtro_fim == "01/01/1970"){
                    $filtro_fim = "";
                }
                // Verificar se o filtro do ponto esta vazio na seleção 
                if($cod_ponto == ""){
                    $cod_ponto = "0-Todos";
                }
                // Verificar se o filtro do tipo ponto esta vazio na seleção 
                if($cod_tipo == ""){
                    $cod_tipo = "0-Todos";
                }
                //Verificar se o filtro do grupo esta vazio na seleção 
                if($cod_grupo == ""){
                    $cod_grupo = "0-Todos";
                }

                $execbanco=mysqli_query($conn,$sql);

                echo '<table class="table table-bordered table-primary" id="filterTable" width="100%" cellspacing="0">';
                        echo "<thead class='table-light'> 
                        <tr>
                            <th>Data Inicial: " . "<a class='font-monospace'>" . $filtro_inicio . "</a>" . "</th> 
                            <th>Data Final: " . "<a class='font-monospace'>" . $filtro_fim . "</a>" . "</th>
                            <th>Filtro do Ponto: " . "<a class='font-monospace'>" . $cod_ponto . "</a>" . "</th> 
                        </tr>
                            <th>Filtro do Tipo: " . "<a class='font-monospace'>" . $cod_tipo . "</a>" . "</th> 
                            <th>Filtro do Grupo: " . "<a class='font-monospace'>" . $cod_grupo . "</a>" . "</th> 
                            <th></th> 
                        </thead>";

                if (mysqli_num_rows($execbanco)==0){
                        echo"<p align='center'>Nenhum registro foi encontrado </p>";
                    }  
                        else  
                    {
                        echo '<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">';
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
                    </tfoot>';

                    // condição de saldo inicial negativo ou positivo.
                    if($VLR_SALDO_INICIAL < 0){
                        $cor="vermelha"; }
                    else{
                        $cor="azul";  }

                    // Mostra o saldo incial na tela
                    echo '<tr><td colspan=4 align="right">&nbsp;</td>';
                    echo '<td>'  . '<b>' .  'Saldo Inicial: ' . '</b>' . '</td>';
                    echo '<td class = ' . $cor . '>'  .  $VLR_SALDO_INICIAL . '</td>';
                    echo  '<td></td></tr>';     
            
                    while($dados=mysqli_fetch_array($execbanco)){
                        if ($dados['TIP_MOVTO']=='E'){
                            $TIP_MOVTO = '-Entrada';
                            $cor="azul"; }
                        else
                        {
                            $TIP_MOVTO = '-Saida';
                            $cor="vermelha";
                        }

                        echo '  <tbody>
                        <tr>
                            <td>';
                        echo  '<b>' . $dados['COD_MOVTO'] . '</b>' . '</td>';
                        echo  '<td color="red">' . date("d/m/Y", strtotime($dados['DAT_MOVTO'] )) . '</td>';
                        echo  '<td>' . $dados['COD_PONTO'] . '</td>' ;
                        echo  '<td>' . $dados['COD_GRUPO'] . '</td>';
                        echo  '<td>' . $dados['COD_DESCRITIVO'] . '-' . $dados['DES_DESCRITIVO'] . '-'. $TIP_MOVTO .  '</td>';
                        echo  '<td class = ' . $cor . ' >' . $dados['VLR_MOVTO'] . '</td>';
                        echo  '<td>' . $dados['OBS_TEXTO'] . '</td></tr>'; }

                        //condição de saldo total negativo ou positivo
                        if($VLR_SALDO < 0){
                            $cor="vermelha"; } 
                        else{
                            $cor="azul"; } 
                        
                        // Mostra o saldo total na tela.
                        echo '<tr><td colspan=4 align="right">&nbsp;</td>';
                        echo '<td>'  . '<b>' .  'Saldo: ' . '</b>' . '</td>';
                        echo '<td class = ' . $cor . '>'  .  $VLR_SALDO . '</td>';
                        echo '<td></td></tr>';
                        echo '</tbody></table>';          
                }
                    mysqli_close($conn);
            ?>
                    <script src="../js/script.js"></script>
    </body>
</div>