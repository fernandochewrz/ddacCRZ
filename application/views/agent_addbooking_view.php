 <?php  
 $connect = mysqli_connect("ddacdatabase.mysql.database.azure.com", "ddacadmin@ddacdatabase", "admin@11", "ddaccrz");
 //$sql = "SELECT * FROM booking";
 $sql = "SELECT * FROM booking INNER JOIN agent ON booking.register_Agent = agent.Agent_Name";
 $result = mysqli_query($connect, $sql);
 ?>
 
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agent | Add Booking</title>
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
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	<!-- Title -->
	<header class="main-header">   
    <a href="<?php echo base_url(); ?>index.php/agent/agent_addbooking_view" class="logo">
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
            <i class=""></i><span><h3>Welcome, <?php echo $_SESSION['agent_Name'];?></h3></span>
          </a>
		</li>
		<li>
          <a href="<?php echo base_url(); ?>index.php/agent/agent_addbooking_view">
            <i class="fa fa-calendar-plus-o"></i><span>Add / View Booking</span>
          </a>
		</li>
		<li>		
		<a href="<?php echo base_url(); ?>index.php/agent/agent_bookingstatus_view">
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
              <h3 class="box-title">Add Booking</h3>					  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<?php if($this->uri->segment(2) == "fail_insert"){
					echo '<p class="text-danger">Add Booking Error.</p>';
				}?>	
				<?php if($this->uri->segment(2) == "inserted"){
					echo '<p class="text-success">Booking Successfully Added.</p>';
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
				<td><button type="button" disabled="disabled" title="Only Admin is allowed to delete!" class="btn btn-danger btn-xs delete_booking" id="<?php echo $row["booking_ID"]; ?>"><i class="fa fa-trash-o"></i> Delete</button></td>
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
                <i class="fa fa-plus-circle"></i> Add
				</button>
			  </div>			  
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Booking</h4>
      </div>
      <div class="modal-body">
	  <form method="post" action="<?php echo base_url()?>index.php/agent/form_validation">	  
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="item_Name" placeholder="Item Name">
        </div>
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="item_Weight" placeholder="Item Weight(kg or g)">
        </div>
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="item_Quantity" placeholder="Item Quantity">
        </div>
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="item_Desc" placeholder="Item Description">
        </div>
		<br>
		<div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="customer_Name" placeholder="Customer Name">			
        </div>
		<br>		
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="customer_Contact" placeholder="Customer Contact">			
        </div>
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="customer_Email" placeholder="Customer Email">			
        </div>
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" name="customer_Address" placeholder="Customer Address">			
        </div>
		<br>
		<div class="form-group">
			<label>Vessel</label>
				<select name="vessel" id="vessel" value="vessel" class="form-control" placeholder="vessel" >
					<option>Select Vessel</option>
					<option value="EverShine">EverShine</option>
					<option value="NorthStar">NorthStar</option>
					<option value="GreenBay">GreenBay</option>
					<option value="CSL">CSL</option>
				</select>				
				<!--<input type="text" name="vessel" class="form-control" />-->
				<span class="text-danger"><?php echo form_error("vessel"); ?></span>  
		</div>  
		<div class="form-group">  
			<label>Harbor</label>
				<select name="harbor" id="harbor" value="harbor" class="form-control">
					<option>Select Harbor</option>
					<option value="TAC">TAC</option>
					<option value="SEA">SEA</option>
				</select> 				
                <!--<input type="text" name="harbor" class="form-control" />-->
                <span class="text-danger"><?php echo form_error("harbor"); ?></span>  
		</div>
		<div class="form-group">  
			<label>Terminal</label>
				<select name="terminal" id="terminal" value="terminal" class="form-control">
					<option>Select Terminal</option>
					<option value="Terminal 4">Terminal 4</option>
					<option value="Terminal 7">Terminal 7</option>
					<option value="Terminal 9">Terminal 9</option>
				</select>  
                <!--<input type="text" name="terminal" class="form-control" />-->
                <span class="text-danger"><?php echo form_error("terminal"); ?></span>  
		</div>
		<div class="form-group">  
			<label>Schedule</label>  
				<select name="schedule" id="schedule" value="schedule" class="form-control">
					<option>Select Schedule</option>
					<option value="01/03/2018 12:00pm - 07/03/2018 12:00pm">01/03/2018 06:00pm - 07/03/2018 12:00pm</option>
					<option value="08/03/2018 02:00pm - 14/03/2018 12:00pm">08/03/2018 04:00pm - 14/03/2018 02:00pm</option>
					<option value="15/03/2018 04:00pm - 21/03/2018 12:00pm">15/03/2018 08:00pm - 21/03/2018 12:00pm</option>
					<option value="22/03/2018 06:00pm - 28/03/2018 12:00pm">22/03/2018 12:00pm - 28/03/2018 12:00pm</option>
				</select>
                <!--<input type="text" name="schedule" class="form-control" />  -->
                <span class="text-danger"><?php echo form_error("schedule"); ?></span>  
        </div>
		<div class="form-group">  
			<label>Status</label>  
				<select name="status" id="status" value="status" class="form-control">
					<option>Select Status</option>
					<option value="Paid">Paid</option>
					<option value="Shipped">Shipped</option>
				</select>
                <!--<input type="text" name="status" class="form-control" />  -->
                <span class="text-danger"><?php echo form_error("status"); ?></span>  
        </div>  		
		<br>
        <div class="form-group">
            <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
            <input type="text" class="form-control" placeholder="<?php echo $_SESSION['agent_Name']?>" disabled>
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
		<input type="hidden" class="form-control" name="register_Agent" value="<?php echo $_SESSION['agent_Name']?>">
        <input type="submit" class="btn btn-primary" name="insert" value="Insert"/>
		</form>		
      </div>
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
<!-- page script -->
<script>
  $(function () {
    $('#status').DataTable()
  })
</script>
</body>
</html>