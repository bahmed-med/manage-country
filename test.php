<?php  
$conn = mysqli_connect("db", "root", "root", "gestion"); 
$sql = "SELECT id, name FROM  country";

//Execute connection
$result = mysqli_query($conn,$sql); 



?>  
<!DOCTYPE html>  
<html>  
<head>  
   <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
   <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
   <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
   </script>
</head>  
<body>  
  <br /><br />  
  <div class="container">  
      <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>  
      <br />  
      <div class="table-responsive">  
           <table id="stock" class="table table-striped table-bordered" > 
              <thead>  
                 <tr>  
                    <td>id</td>  
                    <td>name</td> 
                     
                    <td>Action</td>  
                 </tr>  
              </thead> 
              <tbody>  
              <?php  
              while($row = mysqli_fetch_array($result))  
              {  
                 echo '  

                 <tr>  
                    <td>'.$row["id"].'</td>  
                    <td>'.$row["name"].'</td>  
                 
                    <td><a href = "add.php?id='.$row["id"].'">Stock In</a></td> 
                 
                 </tr> 

                 ';  
              }  
              ?>  
              </tbody> 
           </table>  

      </div>  
  </div> 

  //Javascript part for datatable  
  <script>  
  $(document).ready(function() {
      $('#stock').DataTable();
  } );
  </script>
</body>  
</html>  

while($row = mysqli_fetch_array($resultset)){
    $data[] = [
      'id' => $row["id"],
      'name' => $row["name"]
    ];

    $data = $row;
    
  } 