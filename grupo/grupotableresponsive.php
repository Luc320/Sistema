
<div class="table-responsive">

<form action="grupoIncluir.php" method="POST">
    <input class="btn btn-primary btn-user btn-block" type="submit" value="Incluir Grupo" id="bt-incluir"/>
</form> <br> 


<?php
    include("../conexao.php");

    $ID_USER = $_SESSION['ID_USER']; 
    $sql = "select * from grupo where ID_USER='$ID_USER' order by COD_GRUPO DESC";
    $execbanco=mysqli_query($conn,$sql);


    if (mysqli_num_rows($execbanco)==0){
        echo"<p align='center'>Nenhum registro foi encontrado </p>";
    }  
        else  
    {
         echo '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">';
        echo  '<thead class="table-dark"> 
        <tr>
            <th class="fw-light">Código</th>
            <th class="fw-light">Descrição</th>
        </tr>
    </thead>
    <tfoot class="table-dark">
        <tr>
            <th class="fw-light">Código</th>
            <th class="fw-light">Descrição</th>
        </tr>
    </tfoot>';
            while($dados=mysqli_fetch_array($execbanco)){
                echo '<tbody><tr>';
                    
                echo  '<td>' . '<b>' . $dados['COD_GRUPO'] . '</b>' . '</td>' ;
                echo  '<td>' . $dados['DES_GRUPO'] . '</td>';
                echo  '<td> <form action="grupoAlterar.php" method="POST">
                         
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="Alterar" id="bt-alterar"/>
                        <input type="hidden" name="id" value="' . $dados['COD_GRUPO'] . '">

                    </form></td>';

                echo  "<td>
                        <a href='proc_apagar_grupo.php?id=" . $dados['COD_GRUPO'] .  "' data-confirm='Tem certeza de que deseja excluir o item selecionado?' class='nav-link'>
                        <input class='btn btn-danger btn-user' value='Apagar' id='bt-excluir'>
                       </a>
                </td>";

            }
            echo '</tbody></table>';
        }
        
        mysqli_close($conn);
        ?>

</div>