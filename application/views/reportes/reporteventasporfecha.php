<?php
    require_once(APPPATH."third_party/ireport/PHPJasperXML.inc.php");
    require_once(APPPATH."third_party/ireport/tcpdf/tcpdf.php");
    $server="localhost";
    $db="ventas_pasaje_transportes";
    $user="root";
    $pass="";
    $version="0.9d";
    $pgport=5432;
    $pchartfolder=APPPATH."third_party/ireport/pchart2";
    $PHPJasperXML = new PHPJasperXML();
    date_default_timezone_set('America/Lima');
    $currentDateTime=date('m/d/Y H:i:s');
    $fecha = date('d/m/Y');
    $hora = date('h:i A', strtotime($currentDateTime));
    $PHPJasperXML->arrayParameter=array("parameter1"=>1,"FECHA"=>$fecha,"HORA"=>$hora,"FECHAINI"=>$FECHAINI,"FECHAFIN"=>$FECHAFIN);
    $url = APPPATH."third_party/reportes/reporteVentasPorRangoDeFechas.jrxml";
    $PHPJasperXML->load_xml_file($url);
    $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
    $PHPJasperXML->outpage("I");