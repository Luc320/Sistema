
<div class="table-responsive">

<form action="descritivoIncluir.php" method="POST">
    <input class="btn btn-primary btn-user btn-block" type="submit" value="Incluir Descritivo" id="bt-incluir"/>
</form> <br>


<?php
    include("../conexao.php");
    $ID_USER = $_SESSION['ID_USER']; 
    $sql = "SELECT 
    grupo.COD_GRUPO,	
    grupo.ID_USER,	
    DES_DESCRITIVO,	
    COD_DESCRITIVO,		
    TIP_MOVTO,		
    DES_GRUPO
    FROM `descritivo`, grupo 
    WHERE descritivo.COD_GRUPO=grupo.COD_GRUPO
    AND descritivo.ID_USER=grupo.ID_USER
    AND  descritivo.ID_USER='$ID_USER'
    ORDER BY COD_DESCRITIVO DESC";
    $execbanco=mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($execbanco)==0){
        echo"<p align='center'>Nenhum registro foi encontrado </p>";
    }  
        else  
    {
 
        echo '<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">';
        echo '<thead class="table-dark"> 
        <tr>
            <th class="fw-light">Grupo</th>
            <th class="fw-light">Descritivo</th>
            <th class="fw-light">Tipo do Movimento</th>
        </tr>
    </thead>
    <tfoot class="table-dark">
            <tr>
            <th class="fw-light">Grupo</th>
            <th class="fw-light">Descritivo</th>
            <th class="fw-light">Tipo do Movimento</th>
        </tr>
    </tfoot>';
            while($dados=mysqli_fetch_array($execbanco)){
                echo '<tbody><tr>';
                echo  '<td>' . $dados['COD_GRUPO'] . "-" . $dados['DES_GRUPO'] .'</td>';
                echo  '<td>' . $dados['COD_DESCRITIVO'] . "-" . $dados['DES_DESCRITIVO'] . '</td>';
                if ($dados['TIP_MOVTO'] == 'S'){
                    $tip_movto = 'S-Saída';
                }else{
                    $tip_movto = 'E-Entrada';
                }
                echo  '<td>'. $tip_movto . '</td>';

                echo  '<td> <form action="descritivoAlterar.php" method="POST">
                         
                        <input class="btn btn-primary btn-block" type="submit" value="Alterar" id="bt-alterar"/>
                        <input type="hidden" name="id" value="' . $dados['COD_DESCRITIVO'] . '">

                    </form></td>';

                echo  "<td>
                        <a href='proc_apagar_descritivo.php?id=" . $dados['COD_DESCRITIVO'] .  "' data-confirm='Tem certeza de que deseja excluir o item selecionado?' class='nav-link'>
                        <input class='btn btn-danger' value='Apagar' id='bt-excluir'>
                       </a>
                </td>";

                


            }
            echo '</tbody></table>';
        }
        
        mysqli_close($conn);
        ?>

</div>