
<div class="table-responsive">

<form action="pontoIncluir.php" method="POST">
    <input class="btn btn-primary btn-user btn-block" type="submit" value="Incluir Ponto" id="bt-incluir"/>
</form> <br>


<?php
    include("../conexao.php");
    $ID_USER = $_SESSION['ID_USER']; 
    $sql = "SELECT 
    COD_PONTO,
    DES_PONTO,	
    ponto.COD_TIPO COD_TIPO,
    DES_TIPO,
    IND_ADM 
    FROM ponto,
    tipo_ponto 
    WHERE ponto.COD_TIPO = tipo_ponto.COD_TIPO 
    AND ponto.ID_USER='$ID_USER' 
    AND ponto.ID_USER = tipo_ponto.ID_USER 
    order by COD_PONTO DESC";
    $execbanco=mysqli_query($conn,$sql);
    if (mysqli_num_rows($execbanco)==0){
        echo"<p align='center'>Nenhum registro foi encontrado </p>";
    }  
        else  
    {
        echo '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">';
        echo '<thead class="table-dark"> 
        <tr>
            <th class="fw-light">Codigo</th>
            <th class="fw-light">Descrição</th>
            <th class="fw-light">Tipo Ponto</th>
            <th class="fw-light">Administrador</th>
        </tr>
    </thead>
    <tfoot class="table-dark">
            <tr>
            <th class="fw-light">Codigo</th>
            <th class="fw-light">Descrição</th>
            <th class="fw-light">Tipo Ponto</th>
            <th class="fw-light">Administrador</th>
        </tr>
    </tfoot>';
            while($dados=mysqli_fetch_array($execbanco)){
                echo '  <tbody>
                <tr>
                    <td>';

                echo  '<b>' . $dados['COD_PONTO'] . '</b>' . '</td>';
                echo  '<td>' . $dados['DES_PONTO'] . '</td>' ;
                echo  '<td>' . $dados['COD_TIPO'] . "-" . $dados['DES_TIPO'] .'</td>';
                echo  '<td>' . $dados['IND_ADM'] . '</td>';

                echo  '<td> <form action="pontoAlterar.php" method="POST">
                         
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="Alterar" id="bt-alterar"/>
                        <input type="hidden" name="id" value="' . $dados['COD_PONTO'] . '">

                    </form></td>';

                echo  "<td>
                        <a href='proc_apagar_ponto.php?id=" . $dados['COD_PONTO'] .  "' data-confirm='Tem certeza de que deseja excluir o item selecionado?' class='nav-link'>
                        <input class='btn btn-danger btn-user' value='Apagar' id='bt-excluir'>
                       </a>
                </td>";

            }
            echo '</tbody></table>';
        }
        
        mysqli_close($conn);
        ?>

</div>