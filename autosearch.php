<?php 
  include("dbconn.php");
  ?>
  <?php 
     //if(isset($_GET['term'])){
     	//$data = array();

     	//get search term
        //$searchTerm = $_GET['term'];
        //$field_name = $_GET['extra_param'];

         //get matched data from skills table
    //$query = mysql_query("SELECT * FROM item_details WHERE item_name LIKE '%".$searchTerm."%' ORDER BY item_name ASC");
    //$query = mysql_query("SELECT * FROM '".$field_name."' WHERE item_name LIKE '%".$searchTerm."%' ORDER BY item_name ASC");
    //while ($row = mysql_fetch_assoc($query)) {
        //$data[] = $row['item_name'];
    //}
    
    //return json data
    //echo json_encode($data);




     //}

    // else {

     	//echo "not ready";
     //}

    //if($_POST['type'] == 'country_table'){
    //$row_num = $_POST['row_num'];
   $qr = $_GET['name_startsWith'];
    $result = mysql_query("SELECT item_name, item_code FROM item_details where item_name LIKE '%".$qr."%'");    
    $data = array();
    while ($row = mysql_fetch_assoc($result)) {
        $name = $row['item_name'].'|'.$row['item_code'];
        array_push($data, $name);   
    }   
    echo json_encode($data);
//}






  ?>