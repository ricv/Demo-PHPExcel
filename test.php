<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require('Classes/PHPExcel.php');
require_once "Classes/PHPExcel/IOFactory.php";
$path = "archivos/funcionamineto.xls";
$fileObj = PHPExcel_IOFactory::load($path);
$sheetObj = $fileObj->getActiveSheet();
//get the  header details.
$startFrom = 1; //default value is 1
$limit = null;
$header = array();
foreach ($sheetObj->getRowIterator($startFrom, $limit) as $row) {

    foreach ($row->getCellIterator() as $cell) {
        $value = $cell->getCalculatedValue();
        array_push($header, $value);
    }
    break;
}
$startFrom = 2; //default value is 1
$limit = count($header);

$outp = "";
foreach ($sheetObj->getRowIterator($startFrom, $limit) as $row) {
    if ($outp != "") {
        $outp .= ",";
    }
    foreach ($row->getCellIterator() as $key => $cell) {
        $value = $cell->getCalculatedValue();

        if ($key == 0) {
            $outp .= '{"' . $header[$key] . '":"' . $value . '",';
        } else
        if ($key == ($limit - 1)) {
            $outp .= '"' . $header[$key] . '":"' . $value . '"}';
        } else {

            $outp .= '"' . $header[$key] . '":"' . $value . '",';
        }
    }
}
$outp = '{"records":[' . $outp . ']}';

echo $outp;
?>