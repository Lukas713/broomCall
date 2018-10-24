<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).


include_once "../../config.php";


$query=$conn->prepare("SELECT  b.id, a.firstName, a.lastName, a.email, b.phoneNumber, c.squadNumber, c.squadColor 
                        from employees b 
                        inner join person a on a.id=b.person
                        inner join squad c on c.id=b.squad
                        group by b.id
                        order by a.firstName desc");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);


require_once('../../TCPDF-6.2.17/config/tcpdf_config.php');
require_once('../../TCPDF-6.2.17/tcpdf.php');

// create new PDF document
$pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("BroomCall");
$pdf->SetTitle('BroomCall v1 2018');
$pdf->SetKeywords('BroomCall, PDF, users');

// set default header data
//$pdf->SetHeaderData($pathAPP . "img/logo.svg", PDF_HEADER_LOGO_WIDTH, "Ispis smjerova","", array(0,64,255), array(0,64,128));
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT );
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/hrv.php')) {
	require_once(dirname(__FILE__).'/lang/hrv.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect

// Set some content to print
$html =  '<table border="1" cellspacing="1" cellpadding="4" width="100%" >'.
                "<tr>".
                    "<th>"."First name"."</th>".
                    "<th>"."Last name"."</th>".
                    "<th>"."Email"."</th>".
                    "<th>"."Phone number"."</th>".
                    "<th>"."Squad"."</th>".
                "</tr>";	
					foreach ($result as $row){
				
                        $html = $html .   '<tr nobr="true">'.
                                        "<td>".
                                            $row->firstName.
                                        "</td>".
                                        "<td>".
                                            $row->lastName.
                                        "</td>".
                                        "<td>".
                                            $row->email.
                                        "</td>".
                                        "<td>".
                                            $row->phoneNumber.
                                        "</td>".
                                        "<td>".
                                            $row->squadNumber.
                                        "</td>".
                                    "</tr>";
                                    
                    }
$html = $html .  "</table>";		

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('users.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
