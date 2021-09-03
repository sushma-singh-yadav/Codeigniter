<!DOCTYPE html>
<html>
<head>
	<title>Datatable Tutorial</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h4 class="mt-2">Datatable Tutorial</h4>
			</div>
			<div class="col-md-6">
				<form id="filter-form">
					<div class="d-flex bd-highlight justify-content-end">
						<div class="p-2 bd-highlight">	
							<div class="form-group">
								<select type="form-control" name="f_status" class="form-control">
									<option value="">Select Status</option>
									<option value="Active">Active</option>
									<option value="Inactive">Inactive</option>
								</select>
							</div>
						</div>
						<div class="p-2 bd-highlight">
							<input type="submit" name="submit" class="btn btn-primary d-inline"></div>
						</div>


					</form>
				</div>
				<hr>
				<div class="table-responsive">
					<table class="table table-bordered" id="example">
						<thead>
							<tr>
								<th>ID</th>
								<th>Clothing</th>
								<th>Stock</th>
								<th>Status</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>


			<script src="https://code.jquery.com/jquery-3.6.0.js"
			integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript">
				var dataTable;
				$(document).ready(function() {
					dataTable = $('#example').DataTable( {
						"ajax": {
							url: "<?php echo base_url('home/getCategory');?>",
							type : "POST",
							data : {filter_data : function(){ return $('#filter-form').serialize();}
						}
						},
						"columns" : [
						{ data : "id"},
						{ data : "category_name"},
						{ data : "category_stock"},
						{ data : "status"},
						]
					} );
				} );

				$('#filter-form').submit(function(e){
					e.preventDefault();
					dataTable.ajax.reload();
				});
			</script>
		</body>
		</html>