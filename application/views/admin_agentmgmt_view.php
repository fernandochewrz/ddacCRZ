 <?php  
 $connect = mysqli_connect("ddacdatabase.mysql.database.azure.com", "ddacadmin@ddacdatabase", "admin@11", "ddacdb");  
 $sql = "SELECT * FROM agent";  
 $result = mysqli_query($connect, $sql);
 $sql2 = "SELECT * FROM booking";
 $result2 = mysqli_query($connect, $sql2);
 ?> 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Manage Agent</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/AdminLTE.min.css">
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
    <a href="<?php echo base_url(); ?>index.php/admin/admin_agentmgmt_view" class="logo">
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
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Agent List</h3>					  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<?php if($this->uri->segment(2) == "fail_insert3"){
					echo '<p class="text-danger">Fail to add Agent</p>';
				}?>	
				<?php if($this->uri->segment(2) == "inserted3"){
					echo '<p class="text-success">Successfully added Agent</p>';
				}?>	
				<?php if($this->uri->segment(2) == "deleted3"){
					echo '<p class="text-success">Successfully delete record</p>';
				}?>				
              <table id="status" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Agent ID</th>
                  <th>Agent Username</th>
				  <th>Agent Password</th>
                  <th>Agent Name</th>
				  <th>Agent Contact</th>            
				  <th>Agent Address</th>			  
                </tr>
                </thead>
                <tbody>
				<?php if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){
				?>
                <tr>
				  <td><?php echo $row["agent_ID"]; ?></td>
                  <td><?php echo $row["username"]; ?></td>
                  <td><?php echo $row["password"]; ?></td>
                  <td><?php echo $row["agent_Name"]; ?></td>
                  <td><?php echo $row["agent_Contact"]; ?></td>
                  <td><?php echo $row["agent_Address"]; ?></td>
				  <td><button type="button" class="btn btn-danger btn-xs delete_agent" id="<?php echo $row["agent_ID"]; ?>"><i class="fa fa-trash-o"></i> Delete</button></td>
                </tr>
				<?php }
					}else{?>
                <tr>
                  <td>No data found</td>
                </tr>
				<?php }?>				
                </tbody>
              </table>
			  <div class="box-body">
			  	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-user-plus"></i> Add
				</button>
			  </div>
            </div>
			</div>
          
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Agent</h4>
      </div>
      <div class="modal-body">
	  <form method="post" action="<?php echo base_url()?>index.php/admin/form_validation3">
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="username" placeholder="Agent Username">			
        </div>	
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="password" placeholder="Agent Password">			
        </div>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="agent_Name" placeholder="Agent Name">			
        </div>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="agent_Contact" placeholder="Agent Contact">			
        </div>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="agent_Address" placeholder="Agent Address">			
        </div>		
      </div>	  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="insert" value="Insert"/>
      </div>
	  </form>
    </div>
  </div>
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
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#status').DataTable()
	$('#status1').DataTable()
  })
  $(document).ready(function(){
	  $('.delete_agent').click(function(){
		  var id = $(this).attr("id");
		  if(confirm("Are you sure you want to delete this record?")){
			window.location="<?php echo base_url(); ?>index.php/admin/delete_agent/"+id;
		  }else{
			return false; 
		  }
	  });
  }); 
</script>
</body>
</html>
