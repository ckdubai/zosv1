<?php 
include("dbconn.php");

$qry = $_POST['search_string'];

//$req_query=mysql_query("select * from request_details inner join item_details on request_details.rqst_id=item_details.rqst_id where request_details.rqst_id='".$request_id."'");
$req_query=mysql_query("select * from request_details where rqst_id='".$request_id."'");
while($req_view=mysql_fetch_assoc($req_query))

{ 


}

?>