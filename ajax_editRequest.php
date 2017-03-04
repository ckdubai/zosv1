<?php
include "dbconn.php";


$i=0;
$value_array= [];
$value_array= $_POST['table_array'];
$rqst_id= $_POST['rqst_id'];
$rqst_date=$_POST['rqst_date'];
$rqst_by=$_POST['rqst_by'];
$rqst_stat =$_POST['rqst_status'];
$rqst_file =$_POST['rqst_file'];
//$item_id = $_POST['item_id'];
echo "<pre>";
print_r($value_array);
//echo $rqstid;



$num_of_rows = count($value_array);
echo $num_of_rows;

$updquery=mysql_query("update request_details set rqst_date='".$rqst_date."', rqst_by='".$rqst_by."',rqst_stat='".$rqst_stat." ',rqst_file='".$rqst_file."' where rqst_id='".$rqst_id."'");

//if($updquery){

//$rqstid=mysql_insert_id();

//}


try {

while($i<$num_of_rows) {
   
   
    
    $insqry = mysql_query("update item_details set item_name='".$value_array[$i][0]."',item_code='".$value_array[$i][1]."',rqst_qty='".$value_array[$i][2]."',rec_qty='".$value_array[$i][3]."' where item_id= '".$value_array[$i][4]."'");

    echo "update item_details set item_name='".$value_array[$i][0]."',item_code='".$value_array[$i][1]."',rqst_qty='".$value_array[$i][2]."',rec_qty='".$value_array[$i][3]."' where rqst_id= '".$value_array[$i][4]."'";
    
    ++$i;


}

 if($insqry){

 	 echo("data Saved Succesfully");
 }

}

catch(Exception $e){


echo $e->getMessage();


}


//		QEURY FOR qty
/*$qtyquery=mysql_query("select m_qty from stock_master where p_id='".$pid."'and m_size='".$size."' and m_framed='".$frame."'");

$sview=mysql_fetch_assoc($qtyquery);
$sview = $sview['m_qty'];

$qtydelivered=mysql_query("select dm_qty from deliver_master where p_id='".$pid."'and dm_size='".$size."' and dm_framed='".$frame."'");
$dview=mysql_fetch_assoc($qtydelivered);
$dview = $dview['dm_qty'];
$result=$sview-$dview;
$result2=$sview-$dview;
if($result=='')
{ $result=0;}

echo $result;*/

?>