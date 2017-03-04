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
     //$rdate=$_POST['rdate'];
     //$pieces = explode("/", $rdate);
     //$pdate=$pieces[2].'-'.$pieces[1].'-'.$pieces[0];


    //$rqstby=$_POST['rqstby'];
    //$item=$_POST['item'];
    //$itemcode=$_POST['itemcode'];
    //$qty=$_POST['qty'];

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
  <script type="text/javascript" src="js/table_script.js"></script>
  <link rel="stylesheet" href="css/datepicker.css"/>
  <!--<script src="js/jquery.js"></script>-->
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>


  <title>Bootstrap</title>

</head>
<body>
  <nav Class="navheight navbar">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class ="navbar-brand">
         <h2 class="headeradj">Stationery Request Form</h2>
       </a>
     </div>
   </div>
 </nav>

 <div class="container">
  <div class="row">
    <section class="col col-md-12 col-sm-12">

     <form class="form-inline form_padding" id="save_form" name="save_form" method="POST" action="" role="form">

      <div class="form-group">
       <label class="" for="date">Request Date</label>

       <input type="text" id="rqst_date" placeholder="dd/mm/yyyy" name="rdate" class="form-control">

     </div>




     <!-- Text input-->
     <div class="form-group rqst_margin">
      <label class="" for="textinput">Requested By</label>

      <input type="text" id="rqst_by" placeholder="" name="rqstby" class="form-control">

    </div>

  </section> 
</div>       
<div class="container panel_padding">


  <div class="panel panel-table">
    <div class="panel-heading">
      <div class="row">
        <div class="col col-md-12 col-sm-12 col-xs-6">
          <h3 class="panel-title">Items Details</h3>


        </div>
      </div>
      <div class="panel-body">

        <table class="table table-striped table-bordered table-list" align='center' cellspacing=2 cellpadding=5 id="data_table" border=1>
          <thead>
            <tr>
              <th>Item</th>
              <th>Item Code</th>
              <th>Quantity</th>
              <th></th>
            </tr>

          </thead>
          <tbody>
            <tr>
              <td><input type="text" id="new_name" name="item" class="ui-autocomplete-input"></td>
              <td><input type="text" id="new_country" name="itemcode" val="" class=""></td>
              <td><input type="text" id="new_age"  name="qty" class="js_item"></td>
              <td><input type="button" class="form-control add"  name="add" onclick="add_row();" value="Add Row"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>


</div>
<div class="form-group">
  <div class="col-sm-10">
    <div class="pull-right">
      <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
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
  
document.getElementById("save").disabled = true;
  $(document).ready(function(){

    

 //$('#save').prop('disabled', true);

    $( function() {

      $( "#rqst_date" ).datepicker(
      {
        dateFormat: "dd/mm/yy",
        maxDate: 0,
        minDate: -10 

      });



    //autocomplete
    //$('.js_item').autocomplete({
       // source: "autosearch.php",
        //minLength: 1

//autocomplete jquery with multiple fields 
          $('#new_name').autocomplete({
  source: function( request, response ) {
      $.ajax({
        type: 'GET',
        url : 'autosearch.php',
        dataType: "json",
      data: {
         'name_startsWith': request.term,
         'type': 'country_table'
         //row_num : 1
      },
       success: function( data ) {
         response( $.map( data, function( item ) {
          var code = item.split("|");
          return {
            label: code[0],
            value: code[0],
            data : item
          }
        }));
      }
      });
    },
    autoFocus: true,          
    minLength: 1,
    select: function(event,ui)  {
    var names = ui.item.data.split("|");
                
    $('#new_country').val(names[1]);
   
  }           
});






    });  

     

  
   
    






    $('#save').click(function(e){

        // prevent executing PHP post initially
        e.preventDefault();

        var params = $('#js-rqstid').val();
        var rdate = $('#rqst_date').val();
        var rqstby = $('#rqst_by').val();

        if(rdate){
           // DATE SPLIT IN JQUERY
           var dateAr = rdate.split('/');
           var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);

         } 
         else
         {
           alert("Date cannot be empty");
           exit;

         }
         if(!rqstby){

           alert("Requested By field cannot be empty");
           exit;

         }



          //declare table array
          var table_array = [];

          


           //Looping thru html tables and retrieve row and column values
           $('tr.item_row').each(function() {
            var arrayOfThisRow = [];
            var tableData = $(this).find('td');
            if (tableData.length > 0) {
             tableData.each(function() { arrayOfThisRow.push($(this).text()); });
             table_array.push(arrayOfThisRow);
           }


         });

           $.ajax({
            type: 'POST',
            url: 'ajax_addRequest.php',
            dataType: 'html',
            data: {'table_array':table_array,'rqstid':params,'rqstdate':newDate,'rqstby':rqstby},
            beforeSend: function() {

            //document.getElementById("usernamechk").innerHTML= 'checking'  ;
          },
          complete: function() {
            //$('#save_form').submit();

          },
          success: function(html) {
            //$("#js-showimage").attr('src',"upload/"+html);
            var url = "index.php";
            $(location).attr('href',url);
            //$("#js-hideimage").val("upload/"+html)
            
            //$('#save_form').submit();
          }

        }); // ajax end

         }); // jquery save function ends here

    //insert space between letter and digit
    $('.js_item').mouseleave(function() {

   var tt = $(this).val();
   var res = tt.match(/[a-zA-Z]+|[0-9]+/g);
   var result = res[0]+" "+res[1];
document.getElementById('new_age').value = result;


    });

  });  //end of jquery         
</script>


