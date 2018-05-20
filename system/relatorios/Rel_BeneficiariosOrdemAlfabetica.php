<?php

// reference the Dompdf namespace
require_once('../DAO/BeneficiariosDAO.php');
$DaoBeneficiarios = new BeneficiariosDAO();
$lista = $DaoBeneficiarios->AllBeneficiariosOrdemAlfabetica();



require_once("dompdf/dompdf_config.inc.php");
ob_start();

// instantiate and use the dompdf class

$html = ob_get_clean();
$dompdf = new DOMPDF();

$html = "<html>"
        ."<head></head>"
        . "<body><h1>Lista Beneficiarios pela ordem alfabetica</h1>"
        . "<table border='1'>"
        ."<thead><th>id_beneficiaries</th>"
        ."<th>str_nis</th>"
        ."<th>str_name_person</th></thead>";
foreach ($lista as $item) {
    $tr .=  "<tr>"
            ."<td>". $item->id_beneficiaries ."</td>"
            ."<td>". $item->str_nis ."</td>"
            ."<td>". $item->str_name_person ."</td>"
            ."</tr>";
}
$html .= $tr ."</table></body></html>";
echo $html;

$dompdf->load_html($html);
//$dompdf->load_html('TESTE');
// (Optional) Setup the paper size and orientation
$dompdf->set_paper('A4', 'landscape');

ob_clean();
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("BeneficiariosOrnadosAlfabetico.pdf");
?>
