<?php
namespace store\Helpers;

use Connect as Db;
use Dompdf\Dompdf;
class Pdf {


    public static function show($html, $ref)
    {


        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');
        //$dompdf->loadHtmlFile('http://masquebits.com');

        //var_dump($html); exit;

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('pedido-'.$ref);

        return;

    }
}