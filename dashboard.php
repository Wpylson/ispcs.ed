<?php
include_once("common/restriction.php");
include("common/header.php");
?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sr(a), <?php echo $userData['last_name']; ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Candidaturas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_candidature.php">Fazer Candidatura</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
          <span>Sair</span>
        </a>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>




        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Minhas Candidaturas</h1>

          <?php
          if (isset($_GET['msgs']) == "success") {
          ?>
            <div class="alert shadow border-bottom-success ">
              <span class="icon text-white-50" style="color: #e74a3b;">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
              <span class="btnFechar" onclick="this.parentElement.style.display='none';">&times;</span>
              Candidatura feita com sucesso!
            </div>
          <?php
          }
          if (isset($_GET['msgc']) == "noexi") {
            ?>
              <div class="alert shadow border-bottom-primary ">
                <span class="icon text-white-50" style="color: #e74a3b;">
                  <i class="fas fa-exclamation-triangle"></i>
                </span>
                <span class="btnFechar" onclick="this.parentElement.style.display='none';">&times;</span>
                Candidatura não existe!
              </div>
            <?php
            }

          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Dados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Curso</th>
                      <th>Data</th>
                      <th>Estado</th>
                      <th>Acções</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Curso</th>
                      <th>Data</th>
                      <th>Estado</th>
                      <th>Acções</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $candidature = new Candidatures();
                    $id = $userData['idUser'];
                    $candidature_datas = $candidature->getCandidaturesByUser("$id");
                    $id = 1;
                    if($candidature_datas ==null){
                      ?>
                        <td colspan="6"> Sem candidaturas... Por favor, <a href="add_candidature.php">Clique Aqui</a> para fazeres uma candidatura.</td>
                      <?php
                    }else{
                    foreach ($candidature_datas as $data) {
                    ?>
                      <tr>
                        <td><?php echo $id++ ?></td>
                        <td><?php echo $data['curse_title'] ?></td>
                        <td><?php echo $data['data_candidature'] ?></td>
                        <td>
                          <?php
                          if ($data['candidature_status'] == "1") {
                          ?>
                            <a href="#" class="btn btn-warning btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-exclamation-triangle"></i>
                              </span>
                              <span class="text">Analisando</span>
                            </a>
                          <?php
                          }
                          if ($data['candidature_status'] == "2") {
                          ?>
                            <a href="#" class="btn btn-success btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                              </span>
                              <span class="text">Aceite</span>
                            </a>
                          <?php
                          }
                          ?>
                        </td>
                        <td>
                          <a href="candidature_detail.php?cand=<?php echo $data['idCandidature'] ?>" class="btn btn-info btn-circle btn-sm">
                            <i class="fas fa-info-circle"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } }?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
       <?php 
        include("common/footer.php");
       ?>
     
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Terminar Sessão</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em "Sair" se pretendes terminar a sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Sair</a>
        </div>
      </div>
    </div>
  </div>

   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>