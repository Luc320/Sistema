    <?php 
        $id=$_POST['id'];
        include("../conexao.php");
        $ID_USER = $_SESSION['ID_USER']; 
        $sql = "Select * from grupo WHERE COD_GRUPO ='$id' AND ID_USER='$ID_USER'  order by cod_grupo desc";
        $execbanco=mysqli_query($conn,$sql);

        if (mysqli_num_rows($execbanco)==0){
            //nenhum registro encontrado.
        }  
        $dados=mysqli_fetch_array($execbanco);
    ?>

    <div class="table-responsive">
        <Form method="post" action="alt_grupo.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <label for="id_cod_grupo" class="form-label">
                                <p>Código do Grupo: <input type='text' name='cod_grupo' class="form-control" readonly value="<?php echo $dados['COD_GRUPO']?>">
                            </label>
                        </th>                   
                    </tr>  
                    
                    <tr>
                        <th>
                            <label for="id_des_grupo" class="form-label">
                                <p>Descrição do Grupo: <input type='text' name='des_grupo' class="form-control" value="<?php echo $dados['DES_GRUPO']?>"></p>
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