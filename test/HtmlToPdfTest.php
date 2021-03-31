<?php

namespace Grimlock\Test;

use Grimlock\Exception\GrimlockException;
use Grimlock\HtmlToPdf;
use PHPUnit\Framework\TestCase;

class HtmlToPdfTest extends TestCase
{

    public function testLoadHtml()
    {
        $htmlToPdf = new HtmlToPdf();
        $this->assertEmpty($htmlToPdf->loadHTML("./test/resources/template.html.php"));
    }

    public function testLoadHtmlException()
    {
        $htmlToPdf = new HtmlToPdf();
        $this->expectException(GrimlockException::class);
        $this->expectException($htmlToPdf->loadHTML('/resources/template.html'));
    }

    /*public function testGeneratePDF()
    {
        $htmlToPdf = new HtmlToPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $htmlToPdf->generatePDF("template.pdf");
    }*/

    public function testGeneratePDFException()
    {
        $htmlToPdf = new HtmlToPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $this->expectException(GrimlockException::class);
        $htmlToPdf->generatePDF();
    }

    /*public function testDownloadPDF()
    {
        $htmlToPdf = new HtmlToPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $this->assertEmpty($htmlToPdf->downloadPDF("template.pdf"));
    }*/

    public function testDownloadPDFException()
    {
        $htmlToPdf = new HtmlToPdf();
        $htmlToPdf->loadHTML("./test/resources/template.html.php");
        $this->expectException(GrimlockException::class);
        $htmlToPdf->downloadPDF();
    }
    
}