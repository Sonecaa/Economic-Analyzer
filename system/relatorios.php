<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 23/05/2018
 * Time: 23:31
 */


require_once "classes/template.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

?>

    <ul class="nav">
        <li class="nav-item dropdown">
                    <a style="font-size: 3em;" class="nav-link dropdown-toggle btn btn-outline-dark display-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <p>Relatorios</p>
                        <i class="ti-angle-down"></i>
                    </a>


        <div class="dropdown-menu">
                        <a href="../system/relatorios/Rel_BeneficiariosOrdemAlfabetica.php" class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                         beneficiários e seus respectivos dados em ordem alfabética
                       </a>
                     <div class="dropdown-divider"></div>
                        <a href="../system/relatorios/Rel_BeneficiariosEcidade.php" class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                       beneficiários e a cidade a qual pertencem, com todos os dados do beneficiário e da cidade
                       </a>
            <div class="dropdown-divider"></div>
                         <a href="../system/relatorios/Rel_Pagamentos.php" class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                        lista de os pagamentos
                       </a>
            <div class="dropdown-divider"></div>
                         <a href="../system/relatorios/Rel_4.php" class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                        número de beneficiários por cidade e o valor total pago por cidade, por mês
                       </a>
            <div class="dropdown-divider"></div>
                        <a class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                        soma de vezes que o Beneficiários ganhou auxilio, os meses que foram e os valores de cada mês
                       </a>
            <div class="dropdown-divider"></div>
                        <a class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                        valor total dos pagamentos por região em ordem alfabética
                       </a>
            <div class="dropdown-divider"></div>
                         <a class="dropdown-item">
                        <i class="ti-bar-chart"></i>
                        valor total dos pagamentos por estado em ordem alfabética
                       </a>
        </div>
    </ul>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php

$template->footer();

?>
