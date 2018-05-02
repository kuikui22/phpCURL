<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="./js/data_curd.js"></script>
</head>
<body>
<?php
	require('./function.php');
	TakeAPIWeb();
?>
	<table class="table table-hover" id="all_data">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th></th>
			</tr>
		</thead>
		<tr></tr>
<?php
	
	//顯示資料
	$data_result = TakeDBData();
	foreach($data_result as $data) {
?>
		<tr>
<?php
		echo '<td>' . $data['id'] . '</td>';
		echo '<td>' . $data['name'] . '</td>';
		echo '<td>' . $data['username'] . '</td>';
		echo '<td>' . $data['email'] . '</td>';
		echo '<td>';
		echo '<button type="button" class="btn btn-primary btn-sm edit-btn"  data-toggle="modal" data-target="#EditModal"> Edit </button>';
		echo '</td>';
?>
		</tr>
<?php
	}
?>
	</table>
	
	<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Edit Data</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <form data-toggle="validator" method="put">
			<div class="modal-body">
			  <input type="hidden" name="id" value="0">
			  <div class="form-group">
				  <label class="control-label" for="Name">Name :</label>
				  <input type="text" name="name" class="form-control form-control-sm">
			  </div>
			  <div class="form-group">
				  <label class="control-label" for="Name">UserName :</label>
				  <input type="text" name="username" class="form-control form-control-sm">
			  </div>
			  <div class="form-group">
				  <label class="control-label" for="Name">Email :</label>
				  <input type="text" name="email" class="form-control form-control-sm">
			  </div>
		    </div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-primary" id="save_edit">Save</button>
		    </div>
		  </form>
		</div>
	  </div>
	</div>	
	
</body>
</html>