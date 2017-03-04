<?php

include("dbconn.php");
$rqstid="";
$qry_qty="";
error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');
require_once './Classes/PHPExcel/IOFactory.php';
require_once './Classes/PHPExcel.php';


$fileName = './upload/ex.xls';

// Read the file
//$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objReader = PHPExcel_IOFactory::load($fileName);
//$objReader = $objReader->load($fileName);

$rqstid= mysql_real_escape_string($_GET['rid']);

$req_query=mysql_query("select request_details.rqst_date,request_details.rqst_by,item_details.item_name,item_details.item_code,item_details.rqst_qty from request_details INNER JOIN item_details ON request_details.rqst_id=item_details.rqst_id where request_details.rqst_id='".$rqstid."'");
if($req_query) {
	$sno=0;
	$line=11;
while($req_view=mysql_fetch_assoc($req_query))


{ //print_r($req_view);
  //exit;
$qty_pieces = array();
	//split qty and unit , date f
$qty_pieces = explode(" ", $req_view['rqst_qty']);
 
 

//preg_match("/(\\d+)([a-zA-Z]+)/", "str123", $qty_pieces);
//preg_replace("/([[:alpha:]])([[:digit:]])/", "\\1 \\2", $qry_qty);
//print_r($qry_qty); 
//exit;

$date_pieces = explode("-",$req_view['rqst_date']);
$pdate=$date_pieces[2].'-'.$date_pieces[1].'-'.$date_pieces[0];




          // Change the file
$objReader->setActiveSheetIndex(0)
            ->setCellValue('F8',$pdate)
            ->setCellValue('A29','REQUESTED BY : '.$req_view['rqst_by'])
            ->setCellValue('A'.$line, ++$sno)
            ->setCellValue('B'.$line, $req_view['item_name']." ".$req_view['item_code'])
            ->setCellValue('C'.$line, $qty_pieces[0])
            ->setCellValue('E'.$line, $qty_pieces[1]);
            



   ++$line;
  } //end of while
} //else if 

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$pdate.'.xls');
header('Cache-Control: max-age=0');

// Write the file
$objWriter = PHPExcel_IOFactory::createWriter($objReader, 'Excel5');
//$objWriter->save(str_replace("ex",$pdate,$fileName));
//$objWriter->save($fileName);
$objWriter->save('php://output');
exit;




?>