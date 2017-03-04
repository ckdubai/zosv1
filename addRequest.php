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
<link rel="stylesheet" href="css/datepicker.css"/>
    
  <title>Bootstrap</title>
  <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
        </script>

 <SCRIPT language="javascript">
    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      var ct = 1;
      var cell1 = row.insertCell(0);
      var element1 = document.createElement("input");
      element1.type = "checkbox";
      element1.name="chkbox[]";
      cell1.appendChild(element1);
      cell1.innerHTML=rowCount;

      var cell2 = row.insertCell(1);
      var element2 = document.createElement("input");
      element2.type = "text";
      element2.name = "txtbox[]";
      element2.setAttribute("class", "td1");
      cell2.appendChild(element2);
      

      var cell3 = row.insertCell(2);
      var element3 = document.createElement("input");
      element3.type = "text";
      element3.name = "txtbox[]";
      element3.setAttribute("class", "td3");
      cell3.appendChild(element3);
      

      var cell4 = row.insertCell(3);
      var element4 = document.createElement("input");
      element4.type = "text";
      element4.name = "txtbox[]";
      element4.setAttribute("class", "td2");
      cell4.appendChild(element4);

      var cell5 = row.insertCell(4);
      var element5 = document.createElement("div");
      element5.innerHTML = "<input type = 'button' class='btn-xs' id='Delete' onClick = 'deleteRow(this)'>";  
      //element5.type = "button";
      //element5.name = "Delete";
      //element5.setAttribute("class", "btn-xs");
      //element5.onclick=deleteRow(tableID,this);
      //element5.setAttribute("onclick",deleteRow);
      //element5.setAttribute("onclick","deleteRow(tableID,this)";
      cell5.appendChild(element5);
      
    }

    function deleteRow(currentRow) {
    
        var parentRowIndex = currentRow.parentNode.parentNode.rowIndex;
     document.getElementById("tableID").deleteRow(parentRowIndex);
}
    
    //getValues();
}

  </SCRIPT>       
</head>
<body>
<nav Class=" navheight navbar navbar-inverse">
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

             <div class="form-group">
            <label class="col-sm-2 control-label" for="date">Request Date</label>
            <div class="col-sm-10">
              <input type="text" placeholder="dd/mm/yyyy" class="form-control">
            </div>
          </div>
       



          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Requested By</label>
            <div class="col-sm-10">
              <input type="text" placeholder="" class="form-control">
            </div>
          </div>

          <!-- Text input-->
          <!--<div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Received By</label>
            <div class="col-sm-10">
              <input type="text" placeholder="" class="form-control">
            </div>
          </div>-->

          <!-- Text input-->
          <!--<div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Status</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Status" class="form-control">
            </div>-->

            <!--<label class="col-sm-2 control-label" for="textinput">Attach File</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Attach Request FIle" class="form-control">
            </div>
          </div>-->

<div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Panel Heading</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create" onclick="addRow('dataTable')">Create New</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list" id="dataTable">
                  <thead>
                    <tr>
                        <th>SLNO:</th>
                        <th>ITEM</th>
                        <th>ITEM CODE</th>
                        <th>QTY</th>
                        <th></th>
                    </tr> 
                  </thead>
                  <tbody>
                          <tr>
                            <td class="hidden-xs">1</td>
                            <td><INPUT type="text" class="td1" name="txt"/></td>
                            <td><INPUT type="text" class="td3" name="txt"/></td>
                            <td><INPUT type="text" class="td2" name="txt"/></td>
                            <td><INPUT type="button" class="btn-xs" id="Delete" 
                            onclick="deleteRow(this)"/></td>
                          </tr>
                        </tbody>
                </table>
            
              </div>
              <div class="panel-footer">
                
              </div>
            </div>

</div></div></div>



<!--<div class="form-group">
<div class="col-sm-2 col-sm-10">
<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
</div>
</div>
  <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />

  <TABLE id="dataTable" width="350px" border="1">
    <TR>
      <TD><INPUT type="checkbox" name="chk"/></TD>
      <TD><INPUT type="text" name="txt"/></TD>
      <TD>
        <SELECT name="country">
          <OPTION value="in">India</OPTION>
          <OPTION value="de">Germany</OPTION>
          <OPTION value="fr">France</OPTION>
          <OPTION value="us">United States</OPTION>
          <OPTION value="ch">Switzerland</OPTION>
        </SELECT>
      </TD>
    </TR>
  </TABLE>-->
       
         
          

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
</div>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
