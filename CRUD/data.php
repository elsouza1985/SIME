<?php
    session_start();
    include('connection.php');

    if(isset($_POST['post'])){
    	$fullname = strip_tags($_POST['txtfullname']);
    	$email = strip_tags($_POST['txtemail']);
    	$gender = strip_tags($_POST['cboGender']);
    	$bdate = strip_tags($_POST['txtbdate']);
    	$address = strip_tags($_POST['txtaddress']);

    	$fullname = mysqli_real_escape_string($db, $fullname);
    	$email = mysqli_real_escape_string($db, $email);
      	$gender = mysqli_real_escape_string($db, $gender);
      	$bdate = mysqli_real_escape_string($db, $bdate);
      	$address = mysqli_real_escape_string($db, $address);
    if(isset($_FILES['image'])){
		$name = $_FILES["image"] ["name"];
		$type = $_FILES["image"] ["type"];
		$size = $_FILES["image"] ["size"];
		$temp = $_FILES["image"] ["tmp_name"];
		$error = $_FILES["image"] ["error"];
    }
    	$sql = "INSERT INTO tblpersonalinfo VALUES(NULL,'$fullname' ,'$email', '$gender', '$bdate', '$address' ,'$name')";

		if ($error > 0) {
    		die("Upload an image please!");
    	} else {
			if($size > 100000000000){
				die("Format is not allowed or file size is too big!");
			}
			else{
	     		if (mysqli_query($db, $sql)){
					move_uploaded_file($temp,"uploads/".$name);
					header('location:data.php');
				}
				else{
				 	die('Unable to insert data:' .mysqli_error());
				}
			}
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
        Imoveis Ativos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="data.php"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> &nbsp; </h3>
            </div>

            <div class="box-body">
              	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Novo Imovél
                </button>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
            	<table id="example1" class="table table-bordered table-striped">
                
                <thead>
                <tr>
                  <th>Cod</th>
                  <th>Imovel</th>
                  <th>Bairro</th>
                  <th>Área</th>
                  <th>Quartos</th>
                  <th>Banheiros</th>
                  <th>Ações</th>
                </tr>
                </thead>

                <tbody>

	            <?php
	                include("connection.php");

	                $sql = "SELECT * FROM tblpersonalinfo ORDER BY Fullname ASC";
	                $result=mysqli_query($db, $sql); //rs.open sql,con

	              while ($row=mysqli_fetch_array($result))
	              { ?><!--open of while -->


	              <tr>
	                <td><?php echo $row['id']; ?></td>
	                <td><?php echo $row['Fullname']; ?></td>
	                <td><?php echo $row['Email']; ?></td>
	                <td><?php echo $row['Gender']; ?></td>
	                <td><?php echo $row['Birthday']; ?></td>
	                <td><?php echo $row['PresentAddress']; ?></td>
	                <td>
	                  <a href="view_data.php?vID=<?php echo $row['id']; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="View Data"><i class="fa fa-search"></i></a>
	                  <a href="edit_data.php?uID=<?php echo $row['id']; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
	                  <a href="delete_data.php?delID=<?php echo $row['id'];?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></a>
	                </td>
	              </tr>

	              <?php
	                 } //close of while
	             ?>

                </tbody>
                
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Fullname</th>
                  <th>Email address</th>
                  <th>Gender</th>
                  <th>Birthday</th>
                  <th>Present Address</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
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
	            <form enctype="multipart/form-data" action="data.php" method="post"  >
              <div class="form-group">
    <label for="exampleFormControlInput1">Preço</label>
    <input type="number" class="form-control" id="txtPreco" placeholder="R$123.000,000">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Condominio</label>
    <input type="number" class="form-control" id="txtCondominio" placeholder="R$123.000,000">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Área</label>
    <input type="number" class="form-control" id="txtArea" placeholder="100">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Quartos</label>
    <select class="form-control" id="ddrQuartos">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Banheiros</label>
    <select  class="form-control" id="ddrBanheiros">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Vagas</label>
    <select  class="form-control" id="ddrVagas">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descrição</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Fotos</label><br>
    <input type='file' onchange="readURL(this);" id="img1" style="display:none;"/>
<img id="blah" class="imgUp" src="../img/newpic.png" alt="your image" onclick="setFile()" />
<img id="blah" class="imgUp" src="../img/newpic.png" alt="your image" onclick="setFile()" />
  </div>
	                <div class="form-group">
    	          		 <input type="submit" name="post" value="Save" class="btn btn-primary">
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
  function setFile(){
        $('#img1').click();
    }
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>
