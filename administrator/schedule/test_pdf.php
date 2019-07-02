<?php
    include_once('../vendor/autoload.php');

    // and now we can use library
    $pdf = new \Jurosh\PDFMerge\PDFMerger;

    // add as many pdfs as you want
    $pdf->addPDF('../../upload/service_report_open/SR 62-07-001.pdf', 'all')
    ->addPDF('../../upload/service_report_open/SR 62-07-002.pdf', 'all');

    // call merge, output format `file`
    $pdf->merge('file', '../../upload/service_report_open/TEST01-02.pdf');
?>