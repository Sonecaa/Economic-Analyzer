<?php
/**
 * Created by PhpStorm.
 * User: Marcelo
 * Date: 31/05/2018
 * Time: 01:25
 */
//require_once './system/DAO/BeneficiariosDAO.php';
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
                title: "B E N E F I C I A R I O S",
                includeZero: false
            },
            axisX:{
                title: "M Ê S"
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



            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Um gráfico contendo o total de beneficiário por mês, por estado;"
                },
                axisY:{
                    includeZero: false
                },
                axisX:{
                    interval: 1
                },
                data: [{
                    type: "bar",
                    name: "companies",
                    axisYType: "secondary",
                    color: "#68b4c8",
                    dataPoints: [
                        <?php
                        $array = $daobeneficiarios->Grafico3();
                        for($j = 0; $j < count($array); $j++){
                        $total = $array[$j]->total;
                        $estado = $array[$j]->estado;
                        ?>
                        { y: <?=  $total ?>, label: "<?=  $estado ?>"},
                        <?php
                        } // fim do for
                        ?>
                    ]
                }]
            });


        var chart4 = new CanvasJS.Chart("chartContainer4", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Um gráfico contendo o total de valores pagos por mês, por estado; "
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00",
                indexLabel: "{label} {y}",
                dataPoints: [
                    <?php
                    $array = $daobeneficiarios->Grafico4();
                    for($j = 0; $j < count($array); $j++){
                    $total = $array[$j]->total;
                    $estado = $array[$j]->estado;
                    ?>
                    { y: <?=  $total ?>, label: "<?=  $estado ?>"},
                    <?php
                    } // fim do for
                    ?>
                ]
            }]
        });

            chart.render();
            chart4.render();
            chart3.render();
    }
</script>
<div id="chartContainer1" style="height: 170px; max-width: 920px; margin: 0px auto;"></div>
<br>
<hr>
<br>
<div id="chartContainer3" style="height: 500px; max-width: 900px; margin: 0px auto;"></div>
<br>
<hr>
<br>
<div id="chartContainer4" style="height: 470px; max-width: 920px; margin: 0px auto;"></div>
<script src="/economic-analyzer/system/graficos/canvasjs.min.js"></script>