<?php

require_once "../system/DAO/BeneficiariosDAO.php";
$daobeneficiarios = new BeneficiariosDAO();
?>

<script>
    window.onload = function () {

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Um gráfico contendo a série histórica, com o total de beneficiário por mês, por ano;"
            },
            axisX: {
                interval: 1,
                intervalType: "month",
                valueFormatString: "MMM"
            },
            axisY:{
                title: "Price (in USD)",
                valueFormatString: "$#0"
            },
            data: [{
                type: "line",
                markerSize: 12,
                xValueFormatString: "MMM, YYYY",
                dataPoints: [{<?php for($i = 0; $i <= 12; $i++){$valor = $daobeneficiarios->Grafico2($i)->total;?>x: new Date(2016, <?=$i ?>, 1) , y: <?= $i?>, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },<?php } ?>
                ]
            }]
        });
        chart2.render();

    }
</script>
<div id="chartContainer2" style="height: 170px; max-width: 920px; margin: 0px auto;"></div>