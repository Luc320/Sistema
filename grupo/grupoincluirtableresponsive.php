
    <div class="table-responsive">   
            <?php
                include("../conexao.php");
                $ID_USER = $_SESSION['ID_USER'];
                $sql2 = "select max(COD_GRUPO)+1 COD_GRUPO from grupo where ID_USER='$ID_USER' ";
                $execbanco2=mysqli_query($conn,$sql2);
                $linhas2 = mysqli_num_rows($execbanco2);

                if (mysqli_num_rows($execbanco2)==0){
                    //nenhum registro encontrado.
                }  
                $dados2=mysqli_fetch_array($execbanco2);
            ?>

        <Form method="post" action="inc_grupo.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="id_cod_grupo" class="form-label">
                            <p>Código do Grupo: <input type='text' readonly name='cod_grupo' class="form-control" maxlength="2" size="1" value="<?php echo $dados2['COD_GRUPO']?>"> </p> 
                            </label>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label for="id_des_grupo" class="form-label">
                            <p>Decrição do Grupo: <input type='text' name='des_grupo' class="form-control" size="50"> </p>
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