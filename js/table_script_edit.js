function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";
	
 var name=document.getElementById("name_row"+no);
 var country=document.getElementById("country_row"+no);
 var age=document.getElementById("age_row"+no);
	
 var name_data=name.innerHTML;
 var country_data=country.innerHTML;
 var age_data=age.innerHTML;
	
 name.innerHTML="<input type='text' id='name_text"+no+"' class='td1' value='"+name_data+"'>";
 country.innerHTML="<input type='text' id='country_text"+no+"' class='td3' value='"+country_data+"'>";
 age.innerHTML="<input type='text' id='age_text"+no+"'  class='td2'value='"+age_data+"'>";
}

function save_row(no)
{
 var name_val=document.getElementById("name_text"+no).value;
 var country_val=document.getElementById("country_text"+no).value;
 var age_val=document.getElementById("age_text"+no).value;
 
 document.getElementById("name_row"+no).innerHTML=name_val;
 document.getElementById("country_row"+no).innerHTML=country_val;
 document.getElementById("age_row"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";

}

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row()
{
 var new_name=document.getElementById("new_item").value;
 var new_country=document.getElementById("new_code").value;
 var new_age=document.getElementById("new_qty").value;
 var new_recqty=document.getElementById("new_recqty").value;
	if (new_name && new_country && new_age){
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr class='item_row' id='row"+table_len+"'><td><input type='text' name='name_row"+table_len+"' id='name_row"+table_len+"' class='td1' value="+new_name+"></td><td id='country_row"+table_len+"' class='td3'>"+new_country+"</td><td id='age_row"+table_len+"' class=''>"+new_age+"</td><td id='rec_row"+table_len+"' class=''>"+new_recqty+"</td><td><input type='button' value='Delete' class='delete' onclick='delete_row("+table_len+")'></td></tr>";
}else
{ alert("Please fill all columns");
  exit;
}
 document.getElementById("new_name").value="";
 document.getElementById("new_country").value="";
 document.getElementById("new_age").value="";
}