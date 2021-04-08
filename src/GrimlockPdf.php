<?php

namespace Grimlock;

use Dompdf\Dompdf;
use Grimlock\Enum\EnumPdfOrientation;
use Grimlock\Enum\EnumPdfSize;
use Grimlock\Util\Enumeration;
use Grimlock\Exception\GrimlockException;
use Exception;

/**
 * Class GrimlockPdf
 * Class that facilitates the use of the DOMPDF library to load HTML and render it as PDF.
 * @package Grimlock
 * @author Rubén Darío Huamaní Ucharima
 */
class GrimlockPdf
{

    /**
     * @var Dompdf
     */
    private $pdf;

    /**
     * GrimlockPdf constructor.
     */
    public function __construct()
    {
        $this->pdf = new Dompdf();
    }

    /**
     * Load File HTML
     * @param $pathHTML
     * @param string $size {@link Grimlock\Enum\EnumPdfSize}
     * @param string $orientation {@link Grimlock\Enum\EnumPdfOrientation}
     * @throws GrimlockException
     */
    public function loadHTML($pathHTML, $size = EnumPdfSize::A4, $orientation = EnumPdfOrientation::VERTICAL)
    {
        if (is_readable($pathHTML)) {
            if (!Enumeration::contains(EnumPdfSize::class, $size)) {
                throw new GrimlockException(GrimlockPdf::class, 'Size PDF not exist');
            }

            if (!Enumeration::contains(EnumPdfOrientation::class, $orientation)) {
                throw new GrimlockException(GrimlockPdf::class, 'Orientation PDF not exist');
            }

            ob_start();
            require_once($pathHTML);
            $pdf_html = ob_get_contents();
            ob_end_clean();

            $this->pdf->loadHtml($pdf_html, 'UTF-8');
            $this->pdf->setPaper($size, $orientation);
            $this->pdf->render();
        } else {
            throw new GrimlockException(GrimlockPdf::class, 'Template HTML not exist.');
        }
    }

    /**
     * Generate File PDF
     * @param string $nomPDF Name Pdf
     * @throws GrimlockException
     */
    public function generatePDF($nomPDF = "")
    {
        try {
            if (!empty($nomPDF)) {
                $options = array('MailAttachment' => 0);
                $this->pdf->stream($nomPDF, $options);
            } else {
                throw new GrimlockException(GrimlockPdf::class, 'Name PDF cannot be null or empty');
            }
        } catch(Exception $e) {
            throw new GrimlockException(GrimlockPdf::class, $e->getMessage());
        }
    }

    /**
     * Generate File PDF Downloable
     * @param string $nomPDF Name pdf
     * @throws GrimlockException
     */
    public function downloadPDF($nomPDF = "")
    {
        try {
            if (!empty($nomPDF)) {
                $options = array('MailAttachment' => 1);
                $this->pdf->stream($nomPDF, $options);
            } else {
                throw new GrimlockException(GrimlockPdf::class, 'Name PDF cannot be null or empty');
            }
        } catch(Exception $e) {
            throw new GrimlockException(GrimlockPdf::class, $e->getMessage());
        }
    }

}