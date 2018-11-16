<?php
$viewID = $_GET['vID'];

  include('connection.php');

  $sql ="SELECT * FROM tblpersonalinfo where id = '$viewID'";
  $result = mysqli_query($db, $sql);

  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
      $id = $row['id'];
      $Fullname = $row['Fullname'];
      $Email = $row['Email'];
      $Gender  = $row['Gender'];
      $Birthday = $row['Birthday'];
      $PresentAddress = $row['PresentAddress'];
      $Image = $row['Image'];
    }
  }



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C.R.U.D</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>C</b></span>
      <span class="logo-lg"><b>C</b>RUD</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
     
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        C.R.U.D - Create Retrieve Update Delete
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="data.php"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="uploads/<?php echo $Image; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $Fullname; ?></h3>

            </div>
          </div>

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-envelope-o"></i> Email Address</strong>
              <p class="text-muted">
                <?php echo $Email; ?>
              </p>
              <hr>

              <strong><i class="fa fa-venus-mars"></i> Gender</strong>
              <p class="text-muted">
                <?php echo $Gender; ?>
              </p>
              <hr>

              <strong><i class="fa fa-birthday-cake"></i> Birthday</strong>
              <p class="text-muted">
                <?php echo $Birthday; ?>
              </p>
              <hr>

              <strong><i class="fa fa-home"></i> Present Address</strong>
              <p class="text-muted">
                <?php echo $PresentAddress; ?>
              </p>
              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
        </div>

        <div class="modal-body">
            <div class="box-body pad">
              <form action="save_data.php" method="post">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Fullname</label>
                      <input type="text" class="form-control" id="txtfullname" name="txtfullname" placeholder="Fullname (Lastname, Firstname M.I.)">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" id="cboGender" name="cboGender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                  </div>
                    <div class="form-group">
                    <label>Birthd Date:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="txtbdate" name="txtbdate">
                    </div>
                  </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Present Address</label>
                      <input type="text" class="form-control" id="txtaddress" name="txtaddress" placeholder="Present Address">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="image" id="image">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="save" value="Save">
                  </div>
              </form>
            </div>
        </div>

      </div>
    </div>
  </div>
  <!-- end Modal -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2016 - Dave Marcellana. &nbsp; </strong> All rights
    reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>


<!-- page script -->
<script>
  $(function () 
  {
  
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    });
  });

</script>
</body>
</html>