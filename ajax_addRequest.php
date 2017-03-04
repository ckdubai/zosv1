<?php
include "dbconn.php";


$i=0;

$value_array= $_POST['table_array'];
//$rqstid= $_POST['rqstid'];
$rqstdate=$_POST['rqstdate'];
$rqstby=$_POST['rqstby'];
$rqst_stat =0;
//echo "<pre>";
//print_r($value_array);
//echo $rqstid;



$num_of_rows = count($value_array);
//echo $num_of_rows;

$insquery=mysql_query("insert into request_details(rqst_date,rqst_by,rqst_stat)values('".$rqstdate."','".$rqstby."','".$rqst_stat."')");

if($insquery){

$rqstid=mysql_insert_id();

}


try {

while($i<$num_of_rows) {
   
   
    
    $insqry = mysql_query("insert into item_details(rqst_id,item_name,item_code,rqst_qty)values('".$rqstid."','".$value_array[$i][0]."','".$value_array[$i][1]."','".$value_array[$i][2]."')");
    
    $i++;


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