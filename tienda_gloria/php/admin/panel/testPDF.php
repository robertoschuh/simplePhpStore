<?php
// in

require_once  '../../../../vendor/autoload.php';
//print 'http://'.$_SERVER['PHP_SELF']; exit;

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Monolog\Logger;


$file = 'http://www.gloriabotonero.com/tienda_gloria/index.php';
$html = file_get_contents($file);

$log = new Logger('name');
// instantiate and use the dompdf class
$dompdf = new Dompdf();
//$dompdf->loadHtml('hello world');
//$dompdf->loadHtmlFile('http://masquebits.com');

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
