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
    $fecha = date('d-m-Y');
    date_default_timezone_set('America/Lima');
    $currentDateTime=date('m/d/Y H:i:s');
    $hora = date('h:i A', strtotime($currentDateTime));
    $PHPJasperXML->arrayParameter=array("parameter1"=>1,"FECHA"=>$fecha,"HORA"=>$hora,"IDITINERARIO"=>$IDITINERARIO,"IdVenta"=>$IdVenta);
    $url = APPPATH."third_party/reportes/reporteVentas.jrxml";
    $PHPJasperXML->load_xml_file($url);
    $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
    $PHPJasperXML->outpage("I");

