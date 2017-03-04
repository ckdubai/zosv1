<?php 

include("dbconn.php");

$del_id = $_POST['rqst_id'];

echo($del_id);

$delquery1=mysql_query("delete from item_details where rqst_id='".$del_id."'");
//echo("delete from item_details where rqst_id='".$del_id."'");
if($delquery1){

           $delquery2=mysql_query("delete from request_details where rqst_id='".$del_id."'");
             //echo("delete from request_details where rqst_id='".$del_id."'");
             if($delquery2) {

             	echo("Request Deleted Successfully");
                            }

                        }

                        else {

                        	echo("Error Deleting Request");
                        }

?>