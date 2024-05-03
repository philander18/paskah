<?php

namespace App\Controllers;

use TCPDF;
use App\Models\PaskahModel;

class Pdf extends BaseController
{
    protected $PaskahModel;
    public function __construct()
    {
        $this->PaskahModel = new PaskahModel();
    }
    public function cetakpendaftaran()
    {
        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Panitia Paskah');
        $pdf->SetTitle('Report Pendaftaran');
        $pdf->SetSubject('Pendaftaran');
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
        // set Header disable
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        $data = [
            'jemaat' => $this->PaskahModel->orderBy('bayar')->findAll(),
            'total' => $this->PaskahModel->data_report(),
        ];
        //view mengarah ke reportpendaftaran.php
        $html = view('report/reportpendaftaran', $data);
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Report_Pendaftaran.pdf', 'I');
    }
    public function cetaktransportasi()
    {
        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Panitia Paskah');
        $pdf->SetTitle('Report Transportasi');
        $pdf->SetSubject('Transportasi');
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
        // set Header disable
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
        $data = [
            'total' => $this->PaskahModel->data_report(),
        ];
        //view mengarah ke reportpendaftaran.php
        $html = view('report/reporttransportasi', $data);
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Report_Transportasi.pdf', 'I');
    }
    public function cetakSetor()
    {
        // create new PDF document
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Panitia Paskah');
        $pdf->SetTitle('Report Setoran');
        $pdf->SetSubject('Setoran');
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
        // set Header disable
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $data = [
            'setoran' => $this->PaskahModel->reportsetoran(),
        ];
        //view mengarah ke reportpendaftaran.php
        $html = view('report/reportsetor', $data);
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Report_Setoran.pdf', 'I');
    }
}
