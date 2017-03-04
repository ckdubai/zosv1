<?php 
include("dbconn.php");
$rqstid="";
$flag=0;
session_start();

if (!isset($_SESSION['Username']) || $_SESSION['Username'] == '') {

  header("location:login.php");
  exit;
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

</head>
<body onload=display_dt();>
  <nav Class=" navheight navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class ="navbar-brand">
         <h3 class="headeradj">Stationery Request Form</h3>
       </a>
     </div>
       <p class="ff pull-right " id="dt" style="font-size: 10px;"></p>

      <div class="jj pull-right"><a href="logout.php">logout</a>
      </div>

   </div>
 
 </nav>
 <div class="container">
   <h4>Request Details</h4>
   
   <div class="row well well-sm ">
   <div class="pull-right"><input type="text" id="search" name="search" placeholder="keyword search"></div>
     <div class="req_head col-md-8 col-lg-8 col-sm-8 col-xs-8">
      <div class="col-md-1 col-sm-1 col-xs-1"></div>
      <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left:40px;" onclick="myFunction(a,'rqst_date')"><h5>Date</h5><i class="drop glyphicon glyphicon-chevron-down" ></i></div>
      <div class="col-md-3 col-sm-3 col-xs-3" onclick="myFunction(a,'rqst_by')"><h5>Requested By</h5><i class="drop glyphicon glyphicon-chevron-down" ></i></div>
      <div class="col-md-2 col-sm-2 col-xs-2"><h5>File</h5></div>
      <div class="col-md-1 col-sm-1 col-xs-1" onclick="myFunction(a,'rqst_date')"><h5>Status</h5><i class="drop glyphicon glyphicon-chevron-down" ></i></div> 
    </div> 
  </div>
  <div class="main" id="main">
    <?PHP      

    $rqstquery=mysql_query("select * from request_details");

    while($view=mysql_fetch_assoc($rqstquery)){

      $rqstid=$view['rqst_id'];

      $rqstid=mysql_real_escape_string($rqstid);
            //to prevent sql injection attack

       $rdate=$view['rqst_date'];
   $pieces = explode("-", $rdate);
   $pdate=$pieces[2].'/'.$pieces[1].'/'.$pieces[0];


      ?>

      <div class="req row well">
       <div class="col-md-10 col-sm-10 col-xs-10 request_div">
        <div class="col-md-1 col-sm-1 col-xs-1 glyphicon glyphicon-expand down"></div>
        <div class="col-md-2 col-sm-2 col-xs-2"><?php echo $pdate;?></div>
        <div class="col-md-2 col-sm-2 col-xs-2"><?php echo $view['rqst_by'];?></div>
       <!--  <div class="col-md-2 col-sm-2 col-xs-2"><?php //echo(!empty($view['rqst_file'])?$view['rqst_file']:"Not Uploaded");?></div> -->
        <div class="col-md-2 col-sm-2 col-xs-2">
        <?php if($view['rqst_file'] == '') {
           
           echo "Not Uploaded";

          } 

          else {


            ?>
          <img src="upload/<?php echo($view['rqst_file']);?>" class="show_image" alt="" name="blah" width="30px" height="50px" id="upload/<?php echo($view['rqst_file']);?>"/>
       

       <?php } ?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3"><?php $case_stat= $view['rqst_stat'];

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

         ?>

       </div>
       <div class="col-md-2 col-sm-2 col-xs-2">
         <a href="" id="<?php echo $view['rqst_id'];?>" class="js_req_del"><span class="glyphicon glyphicon-remove"></span></a>
         <?php if($flag == 1) {?>
         <a href="req_edit.php?rid=<?php echo $view['rqst_id'];?>"><span class="glyphicon glyphicon-edit"></span></a>
         <a href="excel.php?rid=<?php echo $view['rqst_id'];?>" id="<?php echo $view['rqst_id'];?>" class="" ><span class="glyphicon glyphicon-print"></span></a>
          <?php } ?>
       </div>  
     </div> 
     </div><!-- req div close -->

   <div class="row detail">
     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <table class="table table-bordered table-hover table-striped table_det">
        <thead>
          <tr>
            <th>Name</th>
            <th>Item Code</th>
            <th>Request Qty</th>
            <th>Received Qty</th>
          </tr>
        </thead>
        <tbody>
         <?php $detailquery=mysql_query("select * from item_details where rqst_id='".$rqstid."'");
         while($detail_view=mysql_fetch_assoc($detailquery)){ ?> 

         <tr>
          <td><?php echo $detail_view['item_name'];?></td>
          <td><?php echo $detail_view['item_code'];?></td>
          <td><?php echo $detail_view['rqst_qty'];?></td>
          <td><?php echo $detail_view['rec_qty'];?></td>
          <td><span class="glyphicon glyphicon-edit"></span></td>
        </tr>

        <?php }?>
      </tbody>

    </table>

  </div>  


</div> 

<?php } ?>

</div> <!-- main div ends -->
<!-- the input fields that will hold the variables we will use -->  
<input type='hidden' id='current_page' />  
<input type='hidden' id='show_per_page' />  

<!-- An empty div which will be populated using jQuery -->  
<div id='page_navigation' class="pull-right"></div>  

<div><a href="add.php">Add Request</a></div>

<script type="text/javascript" charset="utf-8">

 $(document).ready(function() {

  var panel = $('.detail');
  panel.hide();


       //pagination 

                
    //how much items per page to show  
    var show_per_page = 5;  
    //getting the amount of elements inside main div  
    var number_of_items = $('.req').length; 
    
    //alert(number_of_items);
    //calculate the number of pages we are going to have  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);
    //alert(number_of_pages);

  
    //set the value of our hidden input fields  
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
  
    //now when we got all we need for the navigation let's make it '  
  
    /* 
    what are we going to have in the navigation? 
        - link to previous page 
        - links to specific pages 
        - link to next page 
    */  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev </a>';  
    var current_link = 0;
    var pg = 0;  
    while(number_of_pages > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + (pg) +')" longdesc="' + pg +'">'+ (current_link+1)  +'</a>'; 
        pg+=2; 
        current_link++;  
    }  
    navigation_html += '<a class="next_link" href="javascript:next();">  Next</a>';  
  
    $('#page_navigation').html(navigation_html);  
  
    //add active_page class to the first page link  
    $('#page_navigation .page_link:first').addClass('active_page');  
  
    //hide all the elements inside main div  
    $('.req').css('display', 'none');
    
  
    //and show the first n (show_per_page) elements  
    //$('#main').children().slice(0, show_per_page).css('display', 'block'); 
    $('.req').slice(0, show_per_page).css('display', 'block'); 







  $('.down').click(function() {
    //current button
    var currentButton = $(this);
    //var div = $(this).next().closest('div');
    var div = $(this).parent().parent().next();
    //var elementType = $(this).next().prop('tagName');
    //alert(elementType);
    div.slideToggle(400, function() {
    //Completed slidetoggle

  })
  });    
//ajax for delete

$(".js_req_del").click(function() { 

  if (confirm("Are you sure want to delete ?")) {
    var urlpage="req_delete.php";
    var sid = $(this).attr("id");
    var dataString = 'rqst_id='+ sid;

    var parent = $(this).parent().parent().parent();
    $.ajax({
      type: "POST",
      url: urlpage,
      data: dataString,
      cache: false,
      success: function(){
        alert("ajax deleted one record");
        parent.fadeOut('fast', function() {
          $(this).hide();
        });
      }
    });
  }
  return false;
});


$('.drop').click(function() {

  //alert("drop");

        //current button
        var currentButton = $(this);
       //var elementType = $(this).prop('nodeName');
       //alert(elementType);
       var div = $(this);


       if(div.is(':visible'))

       {
        $(this).toggleClass("drop glyphicon glyphicon-chevron-down").toggleClass("drop glyphicon glyphicon-chevron-up"); 
                //div.html('<i class="drop glyphicon glyphicon-chevron-up"></i>');
              }
              else
              {
                div.html('<i class="drop glyphicon glyphicon-chevron-down"></i>');
              }

            });

$('#search').keyup(function()
{      






 var xy = $('.req').length;
 



 var searchTerm = $(this).val().toLowerCase();
 $('.table_det tbody tr').each(function(){
  var lineStr = $(this).text().toLowerCase();
  if(lineStr.indexOf(searchTerm) === -1){
    $(this).parent().parent().parent().parent().prev().hide();//css( "background-color", "red" );

    
    

  }else{
    $(this).parent().parent().parent().parent().prev().show();
  }
});

});


    $('.show_image').click(function() {

                var url = $(this).attr('id');
                
                var title = "title";
                var w=700;
                var h=850; 
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
});           




}); //end of jquery

//search function


          function previous(){  
  
    new_page = parseInt($('#current_page').val()) - 2;  
    //if there is an item before the current active link run the function  
    if($('.active_page').prev('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
  
function next(){  
    new_page = parseInt($('#current_page').val()) + 2;  
    //if there is an item after the current active link run the function  
    if($('.active_page').next('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
function go_to_page(page_num){  
    //get the number of items shown per page  
    var show_per_page = parseInt($('#show_per_page').val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page; 
    //alert(start_from); 
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page; 
    //alert(end_on);  
  
    //hide all children elements of content div, get specific items and show them  
    //$('#main').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
    $('#main').children().css('display', 'none').slice(start_from, end_on+1).filter(":even").css('display', 'block');
       
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    $('#current_page').val(page_num);  
}  



var a='ASC';
function myFunction(sort_qty,fieldname)
{           

  if(sort_qty=='DESC'){
    a='ASC';
    $('.drop').toggleClass('sorting_desc');   
    $('.drop').addClass('sorting_desc');

    $('.drop').removeClass('sorting_asc');
    
  }

  if(sort_qty=='ASC'){
    a='DESC';
    $('.drop').toggleClass('sorting_asc');
    $('.drop').addClass('sorting_asc');

    $('.drop').removeClass('sorting_desc');
    
  }

  var datastring = 'sort_string='+a+'&fieldname='+fieldname;

  $.ajax({

    type: "POST",
    url: "ajax_request_sort.php",
    data: datastring,
    cache: false,
    success: function(html){

      $('.main').html(html);
      
      var panel = $('.detail');
      panel.hide();



      $('.down').click(function() {
    //current button
    var currentButton = $(this);
    //var div = $(this).next().closest('div');
    var div = $(this).parent().parent().next();
    //var elementType = $(this).next().prop('tagName');
    //alert(elementType);
    div.slideToggle(400, function() {
    //Completed slidetoggle

  })
  });    


         //ajax for delete

         $(".js_req_del").click(function() { 

          if (confirm("Are you sure want to delete ?")) {
            var urlpage="req_delete.php";
            var sid = $(this).attr("id");
            var dataString = 'rqst_id='+ sid;

            var parent = $(this).parent().parent().parent();
            $.ajax({
              type: "POST",
              url: urlpage,
              data: dataString,
              cache: false,
              success: function(){
                alert("ajax deleted one record");
                parent.fadeOut('fast', function() {
                  $(this).hide();
                });
              }
            });
          }
          return false;
        });
               

               $('.show_image').click(function() {

                var url = $(this).attr('id');
                
                var title = "title";
                var w=700;
                var h=850; 
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
});               


       }

                   




     });





}

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

//display date on the banner
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_dt()',refresh)
}

function display_dt() {
var strcount
var x = new Date()
document.getElementById('dt').innerHTML = x;
tt=display_c();
}



</script>
</body>
</html>
