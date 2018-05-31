<?php

// reference the Dompdf namespace
require_once('../DAO/BeneficiariosDAO.php');
$DaoBeneficiarios = new BeneficiariosDAO();
$lista = $DaoBeneficiarios->Relatorio4();



require_once("dompdf/dompdf_config.inc.php");
ob_start();

// #Relatório PDF com o número de beneficiários por cidade e o valor total pago por cidade, por mês, ordenados por valor total decrescente;

$html = ob_get_clean();
$dompdf = new DOMPDF();
$tr = "";
$html = "<html>"
    ."<head></head>"
    . "<body><h1></h1>"
    . "<table border='1'>"
    ."<thead><th>numBenefi</th>"
    ."<th>cidade</th>"
    ."<th>total</th>"
    ."<th>mes</th></thead>";
foreach ($lista as $item) {
    $tr .=  "<tr>"
        ."<td>". $item->numBenefi ."</td>"
        ."<td>". $item->cidade ."</td>"
        ."<td>". $item->total ."</td>"
        ."<td>". $item->mes ."</td>"
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
$pdf = $dompdf->output();
$dompdf->stream("Rel_4.pdf", $pdf );
?>
