<?php include "../confirmaSessao.php" ?>
<!DOCTYPE html>
<html lang="pt_br">
<?php include "../headAdmin.php" ?>
<body id="page-top">

<!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "../NavItemTables.php" ?>

  
       <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->

            <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Alterar</h1>
   
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Alterar</h6>
                        </div>
                        <div class="card-body">

                            <?php include("caixatableresponsive.php") ?>

                        </div>
                    </div>

            </div>
            <!-- End of Main Content -->
            
            <?php include "../admfooter.php" ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <?php include "../bootstrapjavascrit.php" ?>


</body>

</html>