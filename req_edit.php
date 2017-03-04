<?php 
include("dbconn.php");
?>
<?php
$rqstid=0;
$rdate="";
$rqstby="";
$item ="";
$itemcode="";
$qty="";
$sview="";
$idquery="";
$selected= "selected='selected'";
$request_id= mysql_real_escape_string($_GET['rid']);
//$req_query=mysql_query("select * from request_details inner join item_details on request_details.rqst_id=item_details.rqst_id where request_details.rqst_id='".$request_id."'");
$req_query=mysql_query("select * from request_details where rqst_id='".$request_id."'");
while($req_view=mysql_fetch_assoc($req_query))

{ //print_r($req_view);

  
  //date format change for display
  $rdate=$req_view['rqst_date'];
   $pieces = explode("-", $rdate);
   $pdate=$pieces[2].'/'.$pieces[1].'/'.$pieces[0];
 

  if(!empty($_POST))
  {



/*$idquery=mysql_query("select max(rqst_id) as id from request_details");
$sview=mysql_fetch_assoc($idquery);
$sview = $sview['id']; 
$sview+=1;
echo $sview;
//exit;*/

   //print_r($_POST);
   //exit;
   


  //$rqstby=$_POST['rqstby'];
  //$item=$_POST['item'];
  //$itemcode=$_POST['itemcode'];
  //$qty=$_POST['qty'];


$dirname = "upload";
if (!is_dir($dirname)) {
  mkdir($dirname);   
}

$st = move_uploaded_file($_FILES["rqst_file"]["tmp_name"],"upload/".$_FILES["rqst_file"]["name"]);
echo $st;
header("location:index.php");
exit;



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/table_script_edit.js"></script>
  <link rel="stylesheet" href="css/datepicker.css"/>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>


  <title>Bootstrap</title>

</head>
<body>
  <nav Class=" navheight navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class ="navbar-brand">
         <h2 class="headeradj">Stationery Request Form Edit Mode</h2>
       </a>
     </div>
   </div>
 </nav>

 <div class="container">
  <div class="row">
    <section class="col col-md-12 col-sm-12">

     <form class="form" id="edit_form" name="edit_form" method="POST" enctype="multipart/form-data" action="" role="form">

      <div class="form-group">
       <label class="" for="request_ID">ID</label>

       <input type="text" id="rqst_id" placeholder="" name="rqst_id" class="form-control" value="<?php echo $req_view['rqst_id'];?>" disabled>

     </div>

     
     <div class="form-group">
       <label class="" for="date">Request Date</label>

       <input type="text" id="rqst_date" placeholder="dd/mm/yyyy" name="rdate" class="form-control" value="<?php echo $pdate;?>">

     </div>

     <!-- Text input-->
     <div class="form-group">
      <label class="" for="textinput">Requested By</label>

      <input type="text" id="rqst_by" placeholder="" name="rqstby" class="form-control" value="<?php echo $req_view['rqst_by'];?>">

    </div>

    <div class="form-group">
      <label class="" for="rqst_file">Request File:

      <input type="file" style="display: none;" id="rqst_file" name="rqst_file" class="form-control" value="" onchange="readURL(this)">
      <input type="hidden" id="filename" name="filename" value="<?php echo $req_view['rqst_file'];?>">
      <img src="upload/<?php echo $req_view['rqst_file'];?>" class="" alt="" name="blah" width="40px" height="60px" id="blah"  onclick="PopupCenter('upload/<?php echo $req_view['rqst_file'];?>','file','900','1100');" id="file_img"/> <a>Change</a></label>
    </div>

    <div class="form-group">
      <label class="" for="rqst_status">Status</label>
      <div class="">

        <?php $stat = $req_view['rqst_stat'];
        

        ?>
        
        <select class="" id="rqst_status" name="rqst_status">
          
         <option value="0" <?php echo ($stat=='0') ? 'selected="selected"' : '';?>>Approval Waiting</option>
         <option value="1" <?php echo ($stat=='1') ? 'selected="selected"' : '';?>>Approved/Processing</option>
         
         <option value="2" <?php echo ($stat=='2') ? 'selected="selected"' : '';?>>Items Partially Received</option>
         
         <option value="3" <?php echo ($stat=='3') ? 'selected="selected"' : '';?>>Items Received/Request Closed</option>
         
         <option value="4" <?php echo ($stat=='4') ? 'selected="selected"' : '';?>>Cancelled</option>
         
         
         
         
       </select>
     </div>
   </div>
   

 </div>


</section> 
</div>      

<div class="container panel_padding">


  <div class="panel panel-default panel-table">
    <div class="panel-heading">
      <div class="row">
        <div class="col col-md-12 col-sm-12 col-xs-6">
          <h3 class="panel-title">Items Details</h3>


        </div>
      </div>
      <?php } ?>
      

      <div class="panel-body">

        <table class="table table-striped table-bordered table-list" align='center' cellspacing=2 cellpadding=5 id="data_table" border=1>
          <thead>
            <tr>
              <th>Item</th>
              <th>Item Code</th>
              <th>Quantity</th>
              <th>Rec:Qty</th>
              <!--<th><input type="button" class="form-control add"  name="add" onclick="add_row();" value="Add Row"></th>-->
            </tr>

          </thead>
          <tbody>
            <?php
            $req_query=mysql_query("select * from item_details where rqst_id='".$request_id."'");
            while($req_view=mysql_fetch_assoc($req_query))
            {

              ?>

              <tr id="item_row" class="item_row">
                <td><input type="text" id="new_item" name="item" class="" value="<?php echo $req_view['item_name'];?>"></td>
                <td><input type="text" id="new_code" name="itemcode" class="" value="<?php echo $req_view['item_code'];?>"></td>
                <td><input type="text" id="new_qty" name="qty" class="" value="<?php echo $req_view['rqst_qty'];?>"></td>
                <td><input type="text" id="new_recqty"  name="recqty" class="" value="<?php echo $req_view['rec_qty'];?>"></td>
                <td><input type="hidden" id="item_id"  name="item_id" class="" value="<?php echo $req_view['item_id'];?>"></td>
                
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>


</div>
<div class="form-group">
  <div class="col-sm-10 col-sm-push-1" >
    <div class="pull-right">
      <button type="submit" class="btn btn-default" name="cancel" id="cancel" value="cancel" onClick="window.location='index.php';" >Cancel</button>
      <button type="submit" class="btn btn-primary save" name="save" id="save">Save</button>
      <input type="hidden" name="js-rqstdate" id="js-rqstdate" value="">
    </div>
  </div>
</div>

</fieldset>
</form>
</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
     $( function() {

      $( "#rqst_date" ).datepicker(
      {
        dateFormat: "dd/mm/yy",
        maxDate: 0,
        minDate: -10 

      });
    } );




   $('#save').click(function(e){



    e.preventDefault();

    var rqst_id = $("#rqst_id").val();
    var edit_date = $("#rqst_date").val();
    var res = edit_date.split("/");
        edit_date = res[2]+res[1]+res[0]; 
    var rqst_by = $("#rqst_by").val();
    var rqst_status = $("#rqst_status").val();

    
       //check filename is changed or not.if not changed the length will be zero and assign value from a hidden input. 
       if ($('#rqst_file').get(0).files.length === 0) {
         var rqst_file = $("#filename").val();
         //alert(rqst_file);
       } else {
         var rqst_file = $('#rqst_file')[0].files[0].name;
         //alert(rqst_file);

       }

       
       


        //if(edit_date){
         // DATE SPLIT IN JQUERY
        //var dateAr = edit_date.split('-');
        //var rqst_date = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
       //alert(rqst_date);

                     //} 
          //else
               //{
                 //alert("Date cannot be empty");
                // exit;

               //}
               
               var table_array = [];

         //Looping thru html tables
         $('tr.item_row').each(function() {
          
          var arrayOfThisRow = [];
          //var tableData = $(this).find('td');
          var tableData = $(this).closest('tr').find("input");
          if (tableData.length > 0) {
           tableData.each(function() { arrayOfThisRow.push($(this).val()); });
           table_array.push(arrayOfThisRow);
         }
         
       });
         
        //alert(table_array[0]);

        $.ajax({
          type: 'POST',
          url: 'ajax_editRequest.php',
          dataType: 'html',
          data: {'table_array':table_array,'rqst_id':rqst_id,'rqst_date':edit_date,'rqst_by':rqst_by,'rqst_status':rqst_status,
          'rqst_file':rqst_file},
          beforeSend: function() {

          //document.getElementById("usernamechk").innerHTML= 'checking'  ;
        },
        complete: function() {
          //$('#save_form').submit();

        },
        success: function(html) {
          //$("#js-showimage").attr('src',"upload/"+html);
          //var url = "index.php";
          //$(location).attr('href',url);
          //$("#js-hideimage").val("upload/"+html)
          $('#edit_form').submit();
          //window.location.replace("index.php");


        }

      });





       }); //save onclick ends here  

   $('#file_img').click(function() {
     var loc = $(this).attr("href");
     window.open(loc, '_blank');
});




      }); //jquery function ends here


  //image loading
  function readURL(input) {
   if (input.files && input.files[0]) {
     var reader = new FileReader();
     reader.onload = function(e) {
       $('#blah').attr('src', e.target.result);
     }

     reader.readAsDataURL(input.files[0]);
   }
 }

//image pop up
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}


</script>


