<?php 
include("dbconn.php");
session_start();

if(!empty($_POST))
{
	
//$filterdata = !empty($_POST['filter_data'])?$_POST['filter_data']:'';
$sortby = !empty($_POST['sort_string'])?$_POST['sort_string']:'';
$fieldqry=!empty($_POST['fieldname'])?$_POST['fieldname']:'';
//$expquery = !empty($_POST['excel'])?$_POST['excel']:''; // post value for export
//$stockquery='';


$flag=0;

$stockquery=mysql_query("select * from request_details ORDER BY ".$fieldqry." ".$sortby."");

//$stockquery=mysql_query("select * from delivery_request ORDER BY ".$fieldqry." ".$sortby."");
//echo "select * from delivery_request ORDER BY ".$fieldqry." ".$sortby."";

while($view=mysql_fetch_assoc($stockquery)){
$rqstid=$view['rqst_id'];
//echo "<pre>";
//print_R($view);


echo "<div class='req row well'>

<div class='col-lg-12 col-md-10 col-sm-10 col-xs-10 request_div'>  
  <div class='col-md-1 col-sm-1 col-xs-1 glyphicon glyphicon-expand down'></div>
  <div class='col-md-2 col-sm-2 col-xs-2'>".$view['rqst_date']."</div>
  <div class='col-md-2 col-sm-2 col-xs-2'>".$view['rqst_by']."</div>
  <div class='col-md-2 col-sm-2 col-xs-2'>";
  
  if($view['rqst_file'] == '') {
           
           echo "Not Uploaded";

          } 

          else {

               echo "<img src='upload/".$view['rqst_file']."' class='show_image' alt='' name='blah' width='30px' height='50px' id='upload/".$view['rqst_file']."'  
               />";
       
          }

  echo "</div>
  <div class='col-md-3 col-sm-3 col-xs-3'>";
  
    $case_stat= $view['rqst_stat'];

    switch($case_stat) {

     case 0:
     echo "Approval Waiting";
     $flag=1;
     break;

     case 1:
     echo "Approved/Processing";
     $flag=0;
     break;

     case 2:
     echo "Items Partially Received";
     $flag=0;
     break;

     case 3:
     echo "Items Received/Request Closed";
     $flag=0;
     break;

     case 4:
     echo "Cancelled";
     $flag=0;
     break;

   }

   echo "</div>
   <div class='col-md-2 col-sm-2 col-xs-2'>

    <a href='' id='".$view['rqst_id']."' class='js_req_del'><span class='glyphicon glyphicon-remove'></span></a>";
    if($flag==1) { 
   echo "<a href='req_edit.php?rid=".$view['rqst_id']."'><span class='glyphicon glyphicon-edit'></span></a>
   <a href='excel.php?rid=".$view['rqst_id']."' id='".$view['rqst_id']."' class=''><span class='glyphicon glyphicon-print'></span></a>";
    }
   echo "</div>
 </div> 
</div>

<div class='row detail'>
 <div class='col-lg-12'>
  <table class='table table-bordered table-hover table-striped'>
    <thead>
     <tr>
      <th>Name</th>
      <th>Item Code</th>
      <th>Request Qty</th>
      <th>Received Qty</th>
    </tr>
  </thead>
  <tbody>";

    $detailquery=mysql_query("select * from item_details where rqst_id='".$rqstid."'");
    while($detail_view=mysql_fetch_assoc($detailquery)){ 

      echo "<tr>
      <td>".$detail_view['item_name']."</td>
      <td>".$detail_view['item_code']."</td>
      <td>".$detail_view['rqst_qty']."</td>
      <td>".$detail_view['rec_qty']."</td>
      <td><span class='glyphicon glyphicon-edit'></span></td>
    </tr>";

  }

  echo"</tbody></table></div></div>"; 








}


               //WHILE LOOP ENDS HERE
    //echo "</div>";

} // POST END HERE
	
	?>














