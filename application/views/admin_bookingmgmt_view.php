 <?php  
 $connect = mysqli_connect("ddacdatabase.mysql.database.azure.com", "ddacadmin@ddacdatabase", "admin@11", "ddaccrz"); 
 $sql = "SELECT * FROM booking";  
 $result = mysqli_query($connect, $sql);

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Manage Booking</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">
	<!-- Title -->
	<header class="main-header">   
    <a href="<?php echo base_url(); ?>index.php/admin/admin_bookingmgmt_view" class="logo">
	<div class="col-md-3 col-sm-4"><i class="fa fa-fw fa-ship"></i> fa-ship</div>
      <span class="logo-mini"><b>M</b>L</span>
      <span class="logo-lg"><b>Maersk</b>Line</span>	  
    </a>
    <!-- /.Title -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
	  <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<li class="messages-menu">
				<a href= "<?php echo base_url(); ?>index.php/main/logout">Logout</a>
			</li>
		</ul>
	   </div>
    </nav>
  </header>
</div>
  <!-- sidebar --> 
  <aside class="main-sidebar">
    <section class="sidebar">       
	  <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="" onclick="return false;">
            <i class=""></i><span><h3>Welcome, <?php echo $_SESSION['username'];?></h3></span>
          </a>
		</li>
		<li>
          <a href="<?php echo base_url(); ?>index.php/admin/admin_agentmgmt_view">
            <i class="fa fa-fw fa-user"></i><span>Agent Management</span>
          </a>
        </li>		
		<li>
          <a href="<?php echo base_url(); ?>index.php/admin/admin_bookingmgmt_view">
            <i class="fa fa-fw fa-bookmark"></i><span>Booking Management</span>
          </a>
        </li>
		<li>
          <a href="<?php echo base_url(); ?>index.php/admin/admin_bookingstatus_view">
            <i class="fa fa-book"></i><span>Booking Status</span>
          </a>
        </li>		
	  </ul>
    </section> 
  </aside>
  <!-- /sidebar -->
  <!-- Content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Booking List</h3>					  
            </div>
            <!-- /.box-header -->
            <div class="box-body">															
				<?php if($this->uri->segment(2) == "fail_insert2"){
					echo '<p class="text-danger">Add Booking Error.</p>';
				}?>	
				<?php if($this->uri->segment(2) == "inserted2"){
					echo '<p class="text-success">Booking Successfully Added.</p>';
				}?>	
				<?php if($this->uri->segment(2) == "deleted2"){
					echo '<p class="text-success">Delete Successful.</p>';
				}?>					
              <table id="status" class="table table-bordered table-striped">
                <thead>
                </thead>				
                <tbody>
				<?php if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){
				?>	
				<tr>
				  <th>Booking ID</th>
				  <th>Item Name</th>
                  <th>Item Weight</th>
				  <th>Item Quantity</th>            
				  <th>Item Description</th>
				</tr>
                <tr>
				  <td><?php echo $row["booking_ID"]; ?></td>				  
				  <td><?php echo $row["item_Name"]; ?></td>
                  <td><?php echo $row["item_Weight"]; ?></td>
                  <td><?php echo $row["item_Quantity"]; ?></td>
                  <td><?php echo $row["item_Desc"]; ?></td>
                </tr>
				</tr>
				<tr>
                  <th>Customer Name</th>
				  <th>Customer Contact</th>
                  <th>Customer Email</th>
				  <th>Customer Address</th>
				  <th>Register Agent</th>	
				</tr>
				<tr>
				  <td><?php echo $row["customer_Name"]; ?></td>
				  <td><?php echo $row["customer_Contact"]; ?></td>
				  <td><?php echo $row["customer_Email"]; ?></td>
				  <td><?php echo $row["customer_Address"]; ?></td>
				  <td><?php echo $row["register_Agent"]; ?></td>
				</tr>
				<tr>
				  <th>Vessel</th>
				  <th>Harbor</th>
				  <th>Terminal</th>
				  <th>Schedule</th>
				  <th>Status</th>
                </tr>
				<tr>
				  <td><?php echo $row["vessel"]; ?></td>
				  <td><?php echo $row["harbor"]; ?></td>
				  <td><?php echo $row["terminal"]; ?></td>
				  <td><?php echo $row["schedule"]; ?></td>
				  <td><?php echo $row["status"]; ?></td>
                </tr>				   
				<td><button type="button" class="btn btn-danger btn-xs delete_booking" id="<?php echo $row["booking_ID"]; ?>"><i class="fa fa-trash-o"></i> Delete</button></td>
				<?php }
					}else{?>
                <tr>
                  <td>No data found</td>
                </tr>
				<?php }?>				
                </tbody>		  
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
<!-- jQuery 3 -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/"; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/adminlte.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#status').DataTable()
  });
  $(document).ready(function(){
	  $('.delete_booking').click(function(){
		  var id = $(this).attr("id");
		  if(confirm("Are you sure you want to delete this record?")){
			window.location="<?php echo base_url(); ?>index.php/admin/delete_booking/"+id;
		  }else{
			return false; 
		  }
	  });
  });
</script>
</body>
</html>