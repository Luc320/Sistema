<div class="table-responsive">    
    <?php 
    $id=$_POST['id'];


    include("../conexao.php"); 

    $ID_USER = $_SESSION['ID_USER']; 
    $sql = "Select * from tipo_ponto WHERE COD_TIPO ='$id' AND ID_USER='$ID_USER' order by cod_tipo desc";
        $execbanco=mysqli_query($conn,$sql);
        if (mysqli_num_rows($execbanco)==0){
            //nenhum registro encontrado.
        }  
        $dados=mysqli_fetch_array($execbanco);
        

    ?>


    <div class="table-responsive">
        <Form method="post" action="alt_tipo_ponto.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr> 
                        <th> 
                            <label for="id_tipo_ponto" class="form-label">
                            <p>Código do Tipo: <input type='text' readonly name='cod_tipo' class="form-control" maxlength="2" size="1" value="<?php echo $dados['COD_TIPO']?>">
                            </label>
                        </th> 
                    </tr>
                    
                    <tr>
                        <th>
                            <label for="id_descricao_ponto" class="form-label">
                            <p>Descrição do Tipo:  <input type='text' name='des_tipo' class="form-control" value="<?php echo $dados['DES_TIPO']?>"></p>
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
</div>    