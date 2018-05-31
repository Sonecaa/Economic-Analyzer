<?php

// reference the Dompdf namespace
require_once('../DAO/PagamentosDAO.php');
$DaoPagamentos = new PagamentosDAO();
$lista = $DaoPagamentos->AllPagamentos();



require_once("dompdf/dompdf_config.inc.php");
ob_start();

// instantiate and use the dompdf class

$html = ob_get_clean();
$dompdf = new DOMPDF();
$tr = "";
$html = "<html>"
        ."<head></head>"
        . "<body><h1>Relatório PDF com a lista de os pagamentos, incluindo seus respectivos dados</h1>"
        . "<table border='1'>"
        ."<thead><th>id_payment</th>"
        ."<th>tb_city_id_city</th>"
        ."<th>tb_functions_id_function</th>"
        ."<th>tb_subfunctions_id_subfunction</th>"
        ."<th>tb_program_id_program</th>"
        ."<th>tb_action_id_action</th>"
        ."<th>tb_beneficiaries_id_beneficiaries</th>"
        ."<th>tb_source_id_source</th>"
        ."<th>tb_files_id_file</th>"
        ."<th>db_value</th></thead>";
foreach ($lista as $item) {
    $tr .=  "<tr>"
            ."<td>". $item->id_payment ."</td>"
            ."<td>". $item->tb_city_id_city ."</td>"
            ."<td>". $item->tb_functions_id_function ."</td>"
            ."<td>". $item->tb_subfunctions_id_subfunction ."</td>"
            ."<td>". $item->tb_program_id_program ."</td>"
            ."<td>". $item->tb_action_id_action ."</td>"
            ."<td>". $item->tb_beneficiaries_id_beneficiaries ."</td>"
            ."<td>". $item->tb_source_id_source ."</td>"
            ."<td>". $item->tb_files_id_file ."</td>"
            ."<td>". $item->db_value ."</td>"
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
