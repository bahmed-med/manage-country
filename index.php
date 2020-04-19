<?php

	

?>


<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
   <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
   <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
   </script>


</head>
<body>

	<div  class="container"   style="margin-top:30px"> 
	
		<div class="modal fade" id="addCountry" >
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add country</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				 <input type="text" class="form-control" placeholder="name" id="name"> </br>
				 <textarea type="text" class="form-control" placeholder="short description" id="shortDescription"></textarea>  </br>
				 <textarea type="text" class="form-control" placeholder="long description" id="longDescription"> </textarea> </br>
			     <input type="hidden" id="id">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="manageBtn" class="btn btn-primary"   onclick= "namageData('addNew')" >Save changes</button>
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		    <div class="col-md-8 offset-md-2">
			    <h1>  Ma gestion : </h1>
				<input class="btn btn-primary" type="button" value="add new" id="addNew"  style="float:right">
				
				</br></br></br>
				
				<table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">Id</th>
						  <th scope="col">Country name</th>
						  <th scope="col">Action</th>
					  </thead>
					  <tbody>
					  </tbody>
				</table>	  
			</div>
		
		</div>
	
	
	</div>

 
	<script type="text/javascript">
		 
		$(document).ready(function(){

		  	$("#addNew").click(function(){

				$("#addCountry").modal('show');
	    	});
	
	  		getAllData();

		});

		function edit(id){
			$.ajax({
					url: 'ajax.php',
					method: 'POST',
					dataType: 'json',
					data: {
						key: 'getRowdata',
						id: id,
					
					}, success: function(response) {
						    $("#id").val(response.id);
							$("#name").val(response.name);
							$("#shortDescription").val(response.shortDescription);
							$("#longDescription").val(response.longDescription);
							$("#addCountry").modal('show');
							$("#manageBtn").attr('value', 'Save change').attr('onclick', "namageData('update')")

						}
					
				})
		}




		function getAllData() {

			$('.table').dataTable({
	  		    "ajax":{
	               url: "ajax.php", // json datasource
	               type: "POST",   // connection method (default: GET)
	               data:{
	               	key: "getAllData"
	               } 
       			},
       			"columns": [
		            { "data": "id" },
		            { "data": "name" },
		            { "data": "action" }
		            
		        ]
	  		});
		 }
		
		function namageData(key){
			
			var name = $("#name");
			var shortDescription= $("#shortDescription");
			var longDescription= $("#longDescription");
			var id = $("#id");
			
			if (isNotEmpty(name) &&  isNotEmpty(shortDescription) &&  isNotEmpty(longDescription)){
				$.ajax({
					url: 'ajax.php',
					method: 'POST',
					dataType: 'text',
					data: {
						key: key,
						name: name.val(),
						shortDescription: shortDescription.val(),
						longDescription:  longDescription.val(),
						id: id.val()
					
					}, success: function(response) {

						if(response != 'success'){
							alert(response);
							//$('#addCountry').modal('hide');
							//$("#manageBtn").attr('value', 'Add').attr('onclick', "namageData('addNew')")
						}else{

							name.val('');
                            shortDescription.val('');
                            longDescription.val('');
							$("#manageBtn").attr('value', 'Add').attr('onclick', "namageData('addNew')")
						}

						$('#addCountry').modal('hide');
						$('.table').DataTable().ajax.reload();

						}
					
				})
			}
			
			
		}
		
		function isNotEmpty(caller) {
			
			if (caller.val() == ''){
				caller.css('border','1px solid red');
				return false;
			}else{
				caller.css('border',''	);
				return true;
			}
		}
		
	</script>	
</body>
</html>
