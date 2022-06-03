<body>
    <div class="table-responsive">
                <?php
                include("../conexao.php");
                $ID_USER = $_SESSION['ID_USER'];
                $sql2 = "select max(COD_TIPO)+1 COD_TIPO from tipo_ponto where ID_USER='$ID_USER' ";
                $execbanco2=mysqli_query($conn,$sql2);
                $linhas2 = mysqli_num_rows($execbanco2);
                if (mysqli_num_rows($execbanco2)==0){
                    //nenhum registro encontrado.
                }  
                $dados2=mysqli_fetch_array($execbanco2);
                ?>
            
        <Form method="post" action="inc_tipo_ponto.php">
            <table class="table" id="table_id" width="100%" cellspacing="0">
                <thead>
                    <tr> 
                        <th> 
                            <label for="id_tipo_ponto" class="form-label">
                            <p>Código do Tipo: <input type='text' readonly name='cod_tipo' class="form-control" maxlength="2" size="1" value="<?php echo $dados2['COD_TIPO']?>"> </p> 
                            </label>                    
                        </th> 
                    </tr>
                    <tr>
                        <th>
                            <label for="id_descricao_ponto" class="form-label">
                            <p>Decrição do Tipo: <input type='text' name='des_tipo' class="form-control" size="50"> </p>
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
</body>     