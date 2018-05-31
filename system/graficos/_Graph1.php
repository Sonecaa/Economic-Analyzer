<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 01:25
 */
require_once "../system/DAO/BeneficiariosDAO.php";
$daobeneficiarios = new BeneficiariosDAO();
?>

<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Um gráfico contendo a série histórica, com o total de beneficiário por mês, por ano;"
            },
            axisY:{
                includeZero: false
            },
            data: [{
                type: "line",
                dataPoints: [
                    <?php
                    for($i = 0; $i <= 12; $i++){
                      $valor = $daobeneficiarios->Grafico1($i)->total;
                    ?>
                    { y: <?=  $valor ?> },
                        <?php
                             } // fim do for
                        ?>
                ]
            }]
        });
        chart.render();

    }
</script>
<div id="chartContainer1" style="height: 170px; max-width: 920px; margin: 0px auto;"></div>
<script src="../graficos/canvasjs.min.js"></script>