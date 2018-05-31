<?php

// reference the Dompdf namespace
require_once('../DAO/PagamentosDAO.php');
$DaoPagamentos = new PagamentosDAO();
$lista = $DaoPagamentos->Relatorio6();



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
    ."<thead><th>valor</th>"
    ."<th>region</th></thead>";
foreach ($lista as $item) {
    $tr .=  "<tr>"
        ."<td>". $item->valor ."</td>"
        ."<td>". $item->region ."</td>"
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
//$pdf = $dompdf->output();
$dompdf->stream("Rel_6.pdf");
?>
