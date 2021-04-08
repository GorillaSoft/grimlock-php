<?php

namespace Grimlock\Test;

use Grimlock\Exception\GrimlockException;
use Grimlock\GrimlockPdf;
use PHPUnit\Framework\TestCase;

class GrimlockPdfTest extends TestCase
{

    public function testLoadHtml()
    {
        $grimlockPdf = new GrimlockPdf();
        $this->assertEmpty($grimlockPdf->loadHTML("./test/resources/template.html.php"));
    }

    public function testLoadHtmlException()
    {
        $grimlockPdf = new GrimlockPdf();
        $this->expectException(GrimlockException::class);
        $this->expectException($grimlockPdf->loadHTML("./test/resources/templates.html.php"));
    }

    /*public function testGeneratePDF()
    {
        $htmlToPdf = new GrimlockPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $htmlToPdf->generatePDF("template.pdf");
    }*/

    public function testGeneratePDFException()
    {
        $grimlockPdf = new GrimlockPdf();
        $grimlockPdf->loadHTML("./test/resources/template.html.php");
        $this->expectException(GrimlockException::class);
        $grimlockPdf->generatePDF();
    }

    /*public function testDownloadPDF()
    {
        $htmlToPdf = new GrimlockPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $this->assertEmpty($htmlToPdf->downloadPDF("template.pdf"));
    }*/

    public function testDownloadPDFException()
    {
        $htmlToPdf = new GrimlockPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $this->expectException(GrimlockException::class);
        $htmlToPdf->downloadPDF();
    }
    
}