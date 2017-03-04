<?php 
include("dbconn.php");
$rqstid="";
$hasedPassword="";
$user_logged = "";
$sql_query="";
$nameErr="";
$pswErr="";
$username="";
$password="";
session_start();
?>
<?php 
 
 if(!empty($_SESSION['Username'])) {

 	header("location:index.php");
 	exit;
 }

 if(!empty($_POST))
  {

if (empty($_POST["username"])) {
    $nameErr = "username is required";
    
  } else {
    $username =mysql_real_escape_string($_POST['username']);
    $username = test_input($username);

  }

  if (empty($_POST["password"])) {
    $pswErr = "password is required";
    
  } else {
    $password =mysql_real_escape_string($_POST['password']);
    $password = test_input($password);
    
  }





$sql_query =mysql_query("SELECT * FROM users WHERE username = '".$username."' ");

//echo "SELECT * FROM users WHERE username = '".$username."' ";
if($sql_query > 0) {

  	while($row=mysql_fetch_assoc($sql_query)){ 
	$hasedPassword = $row['password'];
  $user_logged = $row['username'];
    
     }
     if (password_verify($password, $hasedPassword)) { 

     	
      $_SESSION['Username'] = $user_logged;
     
       //print_r($_SESSION['Username']);
    header("location:index.php");
    

} else {
   phpAlert("Wrong Username/Password");

   
   

}

} 
 

}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';



}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" main="IE=edge">
  <meta name="viewport" main="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/table_script.js"></script>
  <link rel="stylesheet" href="css/datepicker.css"/>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>


  <title>Bootstrap</title>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
</head>
<body>
	        <div class="container">
  
  

  <!-- Modal -->
  <div class="" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login to Stationery Request</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" name="save" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" name="username" placeholder="Enter Username"><span class="text-danger">* <?php echo $nameErr;?></span>
  <br><br>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="text" class="form-control" id="psw" name="password" placeholder="Enter password"><span class="text-danger">* <?php echo $pswErr;?></span>
  <br><br>
            </div>
           
              <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          
         
        </div>
      </div>
      
    </div>
  </div> 
</div>
 






	




</body>
</html>
