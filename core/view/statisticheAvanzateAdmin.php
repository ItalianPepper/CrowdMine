<!DOCTYPE html>
<html>
<head>
    <?php include_once VIEW_DIR."headerStart.php";?>
</head>

<body>
<div class="app app-default">
    <?php include_once VIEW_DIR . "asidePannelloBackend.php"; ?>
    <div class="app-container">
        <?php include_once VIEW_DIR . "headerNavBar.php";?>
        <div class="app-head"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-tab">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li role="tab1" class="active">
                                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Generale</a>
                            </li>
                            <li role="tab2">
                                <a href="#tab2" aria-controls="tab1" role="tab" data-toggle="tab">Annunci</a>
                            </li>
                            <li role="tab3">
                                <a href="#tab3" aria-controls="tab1" role="tab" data-toggle="tab">Utenti</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1"><!--Inizio tab1-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Generale</div>
                                        <div class="section-body">
                                            <div>
                                                <canvas id="graficoGeneraleAnnunci"/>
                                            </div>
                                            <br>
                                            <div>
                                                Numero di Annunci pubblicati oggi:<span id="adsNumber"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="section">
                                                <div class="section-title">Macro Categorie</div>
                                                <div class="section-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <select id="selectMacro" style="width:100%"
                                                                    class="select2">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="fromdatemacro">Da</label>
                                                            <input id="fromdatemacro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="todatemacro">A</label>
                                                            <input id="todatemacro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <button id="submitMacro"
                                                                        class="btn btn-primary">Mostra Risultati
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div>
                                                                <canvas id="macroCategoriaGrafico"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="section">
                                                <div class="section-title">Micro Categorie</div>
                                                <div class="section-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <select id="selectMicro" style="width:100%"
                                                                    class="select2">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="fromdatemicro">Da</label>
                                                            <input id="fromdatemicro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label for="todatemicro">A</label>
                                                            <input id="todatemicro" type="date"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <button id="submitMicro"
                                                                        class="btn btn-primary">Mostra Risultati
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div>
                                                                <canvas id="microCategoriaGrafico"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Macro Categorie Preferite Dagli Utenti</div>
                                        <div class="section-body">
                                            <table id="macroUtenti" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Macro Categoria</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="section">
                                        <div class="section-title">Macro Categorie Offerte Degli Annunci</div>
                                        <div class="section-body">
                                            <table id="macroAnnunci" class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Macro Categoria</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                    <div class="section">
                                        <div class="section-title"><p id="labelMacro"></p></div>
                                        <div class="section-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div id="container-micro">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <nav id="pagination" max-buttons="6" pagination>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\vendor.js"></script>
<script type="text/javascript" src="<?php echo STYLE_DIR; ?>assets\js\app.js"></script>
<script src="<?php echo STYLE_DIR; ?>assets\js\Chart.min.js"></script>

<script type="text/javascript">


    //caricamento Generale
    $("#tab1").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabGenerale",
            dataType: "json",
            data: {option:"graphics"},
            success: function(response){
                var dates = $.map(response, function(value,key){return key});
                var values = $.map(response, function(value, key){return value});
                drawGeneralChart(dates,values);
            }
        });
    });

    $("#tab1").ready(function () {
        $.ajax({
            type: "POST",
            url:"tabGenerale",
            dataType: "json",
            data:  {option:"adsNumber"},
            success: function(response){
                $("#adsNumber").text(" "+response);
            }
        })
    });

///////////////////////////////////////////////////////////////// TAB 2 ///////////////////////////////////////////////
    $("#tab2").ready(function(){
        $("#submitMacro").attr("disabled", "true");
        $("#submitMicro").attr("disabled", "true");
    });


    $("#tab2").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {option:"selectMacro"},
            success: function (response) {
                var arrayMacroElements = $.map(response, function (el) {
                    return el;
                });
                appendMacroElements(arrayMacroElements)
            }
        })
    });

    function appendMacroElements(arrayMacroElements) {
      $.each(arrayMacroElements, function (i,item){
          $("#selectMacro").append($("<option>").text(item.macroName).attr("value",item.macroName));
      });
    }

    $("#tab2").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {option:"selectMicro"},
            success: function (response) {
                var arrayMicroElements = $.map(response, function (el) {
                    return el;
                });
                appendMicroElements(arrayMicroElements);
            }
        });
    });

    function appendMicroElements(arrayMicroElements) {
        $.each(arrayMicroElements, function (i,item){
            $("#selectMicro").append($("<option>").text(item.microName).attr("value",item.microName));
        });
    }

    $("#submitMacro").click(function () {

        var from = $("#fromdatemacro").val();
        var to = $("#todatemacro").val();
        var macro = $("#selectMacro").val();

        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {macrocategoria:macro,fromdatemacro:from, todatemacro:to},
            success: function(response){
                var dates = $.map(response, function(value,key){return key});
                var values = $.map(response, function(value, key){return value});
                drawMacroDateChart(dates,values);
            }
        });
    });


    $("#submitMicro").click(function () {

        var from = $("#fromdatemicro").val();
        var to = $("#todatemicro").val();
        var micro = $("#selectMicro").val();

        $.ajax({
            type: "POST",
            url: "tabAnnunci",
            dataType: "json",
            data: {microcategoria:micro,fromdatemicro:from,todatemicro:to},
            success: function(response){
                    var dates = $.map(response, function(value,key){return key});
                    var values = $.map(response, function(value, key){return value});
                drawMicroDateChart(dates,values);
            }
        });
    });


    $("#fromdatemacro,#todatemacro").change(function () {

        var fromDate = $("#fromdatemacro").val();
        var toDate = $("#todatemacro").val();

        if (fromDate != "" && toDate != "") {

            if (Date.parse(fromDate) > Date.parse(toDate)) {
                $("#submitMacro").attr("disabled", "true");
            } else {
                $("#submitMacro").removeAttr("disabled");
            }
        }
    });


    $("#fromdatemicro,#todatemicro").change(function () {

        var fromDate = $("#fromdatemicro").val();
        var toDate = $("#todatemicro").val();

        if (fromDate != "" && toDate != "" ) {

            if (Date.parse(fromDate) > Date.parse(toDate)) {
                $("#submitMicro").attr("disabled", "true");
            } else {
                $("#submitMicro").removeAttr("disabled");
            }
        }

    });
/////////////////////////////////////////////TAB 3////////////////////////////////////////////////////////

    $("#tab3").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data: {macrocategorie:"utenti"},
            success: function (response) {
                var arrayMacroUtenti = $.map(response, function (el) {
                    return el;
                });
                appendMacroUtentiToTable(arrayMacroUtenti);
            }
        });
    });

    function appendMacroUtentiToTable(arrayMacroUtenti) {
        $.each(arrayMacroUtenti, function (i,el) {
            $("#macroUtenti").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>")
                        .attr("scope", "row")
                        .text(i+1))
                    .append($("<td>")
                        .append($("<button>")
                            .attr("id",el)
                            .attr("type", "button")
                            .attr("class", "btn btn-info")
                            .attr("onclick", "bufferingMicroUtentiTable(this,1)")
                            .text(el)
                        )
                    )
                );
        });

    }

    function bufferingMicroUtentiTable(buttonSelected,initialPage) {

        var nameButton = buttonSelected.id;
        var type="Utenti";
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{macroCategoriaUtenti: nameButton,initpage:initialPage},
            success: function (response) {
                var arrayMicro = $.map(response, function (el) {
                    return el;
                });

                appendMicroToTable(type,nameButton, arrayMicro);
            }
        });
    }

    $("#tab3").ready(function () {
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data: {macrocategorie:"annunci"},
            success: function (response) {
                var arrayMacroAnnunci = $.map(response, function (el) {
                    return el;
                });
                appendMacroAnnunciToTable(arrayMacroAnnunci);
            }
        });
    });

    function appendMacroAnnunciToTable(arrayMacroAnnunci) {
        $.each(arrayMacroAnnunci, function (i,el) {
            $("#macroAnnunci").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>")
                        .attr("scope", "row")
                        .text(i+1))
                    .append($("<td>")
                        .append($("<button>")
                            .attr("id",el)
                            .attr("type", "button")
                            .attr("class", "btn btn-info")
                            .attr("onclick", "bufferingMicroAnnunciTable(this,1)")
                            .text(el)
                        )
                    )
                );
        });
    }


    function bufferingMicroAnnunciTable(buttonSelected,initialPage){
        var nameButton = buttonSelected.id;
        var type = "Annunci";
        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{macroCategoriaAnnunci:nameButton,initpage:initialPage},
            success: function (response) {
                var arrayMicro = $.map(response, function (el) {
                    return el;
                });

                appendMicroToTable(type,nameButton,arrayMicro);
            }
        });
    }

    function appendMicroToTable(type,nameButton,arrayMicro) {
        var labelMacro = type+" - "+nameButton;
        $("#pagination ul").remove();
        $("#container-micro table").remove();

        $("#container-micro").append($("<table>")
                .attr("id", "micro")
                .attr("class", "datatable table")
                .attr("cellspacing", "0")
                .attr("width", "100%")
            .append($("<thead>"))
            .append($("<tbody>")));

        $("#labelMacro").text(labelMacro);

        $("#micro").find("thead")
            .append($("<tr>")
                .append($("<th></th>").text("#"))
                .append($("<th></th>").text("Micro Categorie")));

        $.each(arrayMicro, function (i,el) {
            $("#micro").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>").text(i+1))
                    .append($("<td>").text(el)
                    )
                );
        });
        pagination(1,type,nameButton);
    }

    function pagination(page,type, nameMacro){

        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{type:type,macro:nameMacro,maxPage:"dimensionPaging"},
            success:function (response) {
                var dimensionPaging = response/10;

                if(dimensionPaging > 1) {
                    $("#pagination").attr("dimension-paging", dimensionPaging);
                    appendingPaging(page, type, nameMacro);
                }

            }
        });
    }

    function appendingPaging( page, type, nameMacro) {

        $("#pagination").append($("<ul>").attr("class", "pagination"));
        var dimensionPaging = parseInt($("#pagination").attr("dimension-paging"));
        var maxButtons = parseInt($("#pagination").attr("max-buttons"));
        var currentPage =  parseInt(page);

        //clamp currentPage to dimensionPaging
        if(currentPage>dimensionPaging)
        currentPage=dimensionPaging;

        //start/end indices for buttons
        var is;
        var ie;

        //ellipsis enabled for buttons after currentPage
        var nextEllipsis = false;

        /*Previous button*/
        if (currentPage < 2) {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + 0)
                    .attr("class","disabled")
                    .append($("<span>").attr("aria-hidden","true").html("&laquo;")));
        } else {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + 0)
                    .attr("onclick", "goToPage("+"'"+type+"'"+","+"'"+nameMacro+"'"+","+"'"+(currentPage-1)+"'"+")")
                    .append($("<span>").attr("aria-hidden","true").html("&laquo;")));
        }

        //starting point for the index, half back, half-1 front
        is = currentPage - Math.floor(maxButtons/2);
        ie = currentPage + Math.ceil(maxButtons/2)-1;

        //boundaries for indices, $is must be greater than 1
        if(is<1){
            //number of buttons lost now return by the other index
            ie+=1-is;
            is=1;
        }

        //$ie always before numPages
        if(ie>dimensionPaging){
            //number of buttons lost now return by the other index
            is+=dimensionPaging-ie;
            ie=dimensionPaging;
        }

        //clean carries
        if(is<1) is=1;

        //enabling ellipsis for the buttons after currentPage
        if (ie < dimensionPaging) {
            nextEllipsis = true;
            ie -= 1;
        }
        //ellipsis for the buttons before current page
        if (is > 1) {
            $("#pagination ul")
                .append($("<li>")
                    .append($("<span>").text("...")));
            is += 1;
        }


        /*Numbered buttons*/
        for (var i = is; i < currentPage; i++) {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + i)
                    .attr("onclick", "goToPage("+"'"+type+"'"+","+"'"+nameMacro+"'"+","+"'"+i+"'"+")")
                    .append($("<span>").attr("aria-hidden","true").text(i)));
        }

        $("#pagination ul")
            .append($("<li>")
                .attr("id", "page" + currentPage)
                .attr("class","active")
                .attr("onclick", "goToPage("+"'"+type+"'"+","+"'"+nameMacro+"'"+","+"'"+currentPage+"'"+")")
                .append($("<span>").attr("aria-hidden","true").text(currentPage)));

        for (var i = currentPage + 1; i <= ie; i++) {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + i)
                    .attr("onclick", "goToPage("+"'"+type+"'"+","+"'"+nameMacro+"'"+","+"'"+i+"'"+")")
                    .append($("<span>").attr("aria-hidden","true").text(i)));
        }

        if (nextEllipsis == true) {
            $("#pagination ul")
                .append($("<li>")
                    .append($("<span>").text("...")));
        }

        /*Next button*/
        if (currentPage >= dimensionPaging) {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + dimensionPaging)
                    .attr("class","disabled")
                    .append($("<span>").attr("aria-hidden","true").html("&raquo;")));
        } else {
            $("#pagination ul")
                .append($("<li>")
                    .attr("id", "page" + dimensionPaging)
                    .attr("onclick", "goToPage("+"'"+type+"'"+","+"'"+nameMacro+"'"+","+"'"+(currentPage+1)+"'"+")")
                    .append($("<span>").attr("aria-hidden","true").html("&raquo;")));
        }
    }


    function goToPage(type,nameMacro,numberPage){

        $.ajax({
            type: "POST",
            url: "tabUtenti",
            dataType: "json",
            data:{type:type, macrocategoria:nameMacro, pagination:numberPage},
            success: function (response) {
            var arrayMicroPage = $.map(response, function (el) {
                return el;
            });
                updatePage(arrayMicroPage);
                $("#pagination ul").remove();
                pagination(numberPage,type,nameMacro);
            }
        });
    }


    function updatePage(arrayMicroPage){
        $("#micro tr").remove();

        $.each(arrayMicroPage, function (i,el) {
            $("#micro").find("tbody")
                .append($("<tr>")
                    .append($("<th></th>").text(i + 1))
                    .append($("<td>").text(el)
                    )
                );
        });
    }

    function drawGeneralChart(dates, values) {

        var ctxGenerale = document.getElementById("graficoGeneraleAnnunci").getContext("2d");

        var generaleData = {
            labels:dates,
            datasets: [
                {
                    label:"Generale",
                    data: values,
                    backgroundColor: "rgba(0, 255, 0, 0.3)",
                    borderColor: "rgba(0, 255, 0, 0.3)",
                    borderWidth: 1
                }
            ]
        };

        var generaleChart = new Chart.Line(ctxGenerale, {
            data: generaleData,
            options: {
                pointHitRadius: 3,
                responsive: true,
                tooltipEvents:[],
                showTooltips: true,
                onAnimationComplete: function () {
                    this.showTooltip(this.segments, true);
                },
                tooltipTemplate: "<%= label %>  -  <%= value %>"
            }

        });
    }


    function drawMacroDateChart(dates,values) {

        var ctxMacro = document.getElementById("macroCategoriaGrafico").getContext("2d");

        var macroData = {
            labels:dates,
            datasets: [
                {
                    label:$("#selectMacro").val(),
                    data: values,
                    backgroundColor: "rgba(255, 0, 0, 0.3)",
                    borderColor: "rgba(255, 0, 0, 0.3)",
                    borderWidth: 1
                }
            ]
        };

        var macroChart = new Chart.Line(ctxMacro, {
            data: macroData,
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


    function drawMicroDateChart(dates,values) {

        var ctxMicro = document.getElementById("microCategoriaGrafico").getContext("2d");

        var microData = {
            labels: dates,
            datasets: [
                {
                    label: $("#selectMicro").val(),
                    data: values,
                    backgroundColor: "rgba(0, 0, 255, 0.3)",
                    borderColor: "rgba(0, 0, 255, 0.3)",
                    borderWidth: 1
                }
            ]
        };

        var microChart = new Chart.Line(ctxMicro, {
            data: microData,
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
</script>
</html>