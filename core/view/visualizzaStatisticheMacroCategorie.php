<!DOCTYPE html>
<html>
<head>
    <title>CrowdMine</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">


    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
    <link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">

</head>

<body>
<div class="app app-default">
    <?php include_once VIEW_DIR . "header.php" ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">Statistiche Macro Categorie</div>
                <div class="card-body">
                    <div>
                        <canvas id="statisticheMacro"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once VIEW_DIR . "footer.php" ?>
</body>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
<script src="<?php echo STYLE_DIR; ?> assets\js\Chart.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "macroCategorieStat",
            dataType: "json",
            data: {},
            success:function(response){
                drawMacroChart(response)
            }
        });
    });


    function drawMacroChart(result){

        var ctx = document.getElementById("statisticheMacro").getContext("2d");

        var numOfMacro = $.map(result, function(el,key){return key;}).length;

        var colors = rgbaRandom(numOfMacro);

        var i=0;
        function createElements() {
           var allElement = [];
            for (var key in result) {
                var grafics = {
                    label: [key],
                    data: [result[key]],
                    backgroundColor: colors[i],
                    borderColor: colors[i],
                    borderWidth: 1,
                }
                allElement.push(grafics);
                i++;
            }
            return allElement;
        };

        var macroChartData = {
            labels:[], //va lasciato vuoto
            datasets: createElements()
        };

        var macroChart = new Chart.Bar(ctx, {
            data: macroChartData,
            options: {
                pointHitRadius: 3,
                responsive: true,
                tooltipEvents: [],
                showTooltips: true,
                onAnimationComplete: function () {
                    this.showTooltip(this.segments, true);
                },
                tooltipTemplate: "<%= label %>  -  <%= value %>"
            }
        });
    }


    function rgbaRandom(numElements) {

        var rgbaArray = [
            "rgba(255,192,0.7)","rgba(255,192,0,0.7)","rgba(224,255,0,0.7)","rgba(126,255,0,0.7)"
            ,"rgba(33, 255,0,0.7)","rgba(0,255,65,0.7)","rgba(0,255,159,0.7)","rgba(0,253,255,0.7)"
            ,"rgba(0,159,255,0.7)","rgba(0,61,255,0.7)","rgba(33,0,255,0.7)","rgba(131,0,255,0.7)"
            ,"rgba(229,0,255,0.7)","rgba(0,82,255,0.7)","rgba(255,0,124,0.7)","rgba(16,0,255,0.7)"
        ];


        var resultSetColors = [];

        for (var k = 0; k < numElements; k++) {
            var numberRandom = Math.floor(Math.random() * (rgbaArray.length - 1) + 1);
                    resultSetColors.push(rgbaArray[numberRandom]);
                    rgbaArray.splice( $.inArray(rgbaArray[numberRandom],rgbaArray) ,1 );
        }

        return resultSetColors;
    }


</script>

</html>