//Chart.platform.disableCSSInjection = true;
//GRÁFICOS

//VOLUMES CONFERIDOS POR DIA
function graficoSmppAndamento() {

    $.ajax({
        url: diretorio_sistema + "indicador/indicadores",
        type: "POST",
        data: { tipo: 'triagemporvolume' },
        success: function (dados) {
            var dados = JSON.parse(dados);
            var ctx = $("#graficoSmppAndamento")[0];
            var data = [];
            var qtd_conf = [];
            var qtd_rec = [];
            var qtd_back = [];
            var soma_total = 0;
            var media = 0;
            var i = 0;
            var mesano = mesano_extenso();
            var qtdBackSoma = 0;

            $.each(dados, function (key, value) {
                if (value['data'] != null) {
                    data.push(value['data']);
                    qtd_rec.push(value['vol']);
                    if (value['vol_conf'] == null) {
                        qtd_conf.push(0);
                    } else {
                        qtd_conf.push(value['vol_conf']);
                    }

                    qtdBackSoma += value['vol'] - value['vol_conf'];
                    qtd_back.push(qtdBackSoma);

                    //qtd_back.push(value['qtd_rec'] - value['qtd_conf']);
                    i++; //para calculo da média
                }
            });

            var tamanho = qtd_conf.length;

            while (tamanho--) {
                soma_total += parseInt(qtd_conf[tamanho]);
            }

            media = soma_total / i;
            media = Math.ceil(media);

            var grafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data,
                    datasets: [
                        {
                            label: "Volumes Recebidos",
                            backgroundColor: "rgba(255, 171, 88, 0.8)",
                            borderColor: "rgba(255, 171, 88, 0.8)",
                            data: qtd_rec,
                        }, {
                            label: "Volumes Conferidos",
                            backgroundColor: "rgba(148,57,50, 0.8)",
                            borderColor: "rgba(148,57,50, 0.8)",
                            data: qtd_conf,
                        }, {
                            label: "Backlog/Pipeline",
                            backgroundColor: "rgba(243, 106, 98, 0.8)",
                            borderColor: "rgba(243, 106, 98, 0.8)",
                            data: qtd_back,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Quantidade de Volumes Conferidos por Dia - " + mesano,
                        fontFamily: 'roboto',
                        fontSize: 18,
                        fontColor: '#3E3E3E'
                    },
                    tooltips: {
                        mode: "index",
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            color: '#000000',
                            font: function (context) {
                                var w = context.chart.width;
                                return {
                                    size: w < 512 ? 12 : 14
                                };
                            },
                            formatter: function (value, context) {
                                return value;
                            }
                        }
                    },
                    annotation: {
                        annotations: [{
                            type: 'line',
                            label: 'Volumes Conferidos',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: media,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Média ' + media + ' Vol/Dia Conferidos'
                            },
                        }, {
                            type: 'line',
                            label: 'Volumes Conferidos',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 100,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Target 100 Vol/Dia'
                            },
                        }],
                        drawTime: 'afterDraw'
                    }
                }
            });
        }
    });
}

//PEÇAS CONFERIDAS POR DIA
function graficoPecasDiaFiltrar() {

    $.ajax({
        url: diretorio_sistema + "indicador/indicadores",
        type: "POST",
        data: { tipo: 'pecasconferidasdia' },
        success: function (dados) {
            var dados = JSON.parse(dados);
            var ctx = $("#graficoPecasDia")[0];
            var data = [];
            var qtd = [];
            var soma_total = 0;
            var media = 0;
            var i = 0;
            var mesano = mesano_extenso();

            $.each(dados, function (key, value) {
                data.push(value['data']);
                qtd.push(value['qtd']);
                i++;
            });

            var tamanho = qtd.length;

            while (tamanho--) {
                soma_total += parseInt(qtd[tamanho]);
            }

            media = soma_total / i;
            media = Math.ceil(media);

            var grafico_a = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data,
                    datasets: [
                        {
                            label: "Itens Conferidos",
                            backgroundColor: "rgba(148,57,50, 0.8)",
                            borderColor: "rgba(148,57,50, 0.8)",
                            data: qtd,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Quantidade de Peças Conferidas por Dia - " + mesano,
                        fontFamily: 'roboto',
                        fontSize: 18,
                        fontColor: '#3E3E3E',
                    },
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            color: '#000000',
                            font: function (context) {
                                var w = context.chart.width;
                                return {
                                    size: w < 512 ? 12 : 14
                                };
                            },
                            formatter: function (value, context) {
                                return value;
                            }
                        }
                    },
                    tooltips: {
                        mode: "index",
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    annotation: {
                        drawTime: 'afterDatasetsDraw',
                        annotations: [{
                            type: 'line',
                            label: 'Peças Conferidas',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: media,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Média ' + media + ' Pc/Dia Conferidas'
                            },
                        }, {
                            type: 'line',
                            label: 'Peças Conferidas',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 1500,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Target 1.500 Pc/Dia'
                            },
                        }/*, {    
                            drawTime: "beforeDatasetsDraw",
                            type: "box",
                            xScaleID: "x-axis-0",
                            yScaleID: "y-axis-1",
                            xMin: 0,
                            xMax: 1,
                            backgroundColor: "rgba(101, 33, 171)",
                            borderColor: "rgb(101, 33, 171)",
                            borderWidth: 1,
                        }*/]
                    }
                }
            });

            grafico_a.update();
        }
    });

}

//LANCAMENTOS CONFERIDOS POR DIA
function graficoLctosDiaFiltrar() {

    $.ajax({
        url: diretorio_sistema + "indicador/indicadores",
        type: "POST",
        data: { tipo: 'lctoconferidosdia' },
        success: function (dados) {
            var dados = JSON.parse(dados);
            var ctx = $("#graficoLctosDia")[0];
            var data = [];
            var qtd = [];
            var soma_total = 0;
            var media = 0;
            var i = 0;
            var mesano = mesano_extenso();

            $.each(dados, function (key, value) {
                if (value['data'] != null){
                    data.push(value['data']);
                    qtd.push(value['lcto_conf']);
                    i++;
                }
            });

            var tamanho = qtd.length;

            while (tamanho--) {
                soma_total += parseInt(qtd[tamanho]);
            }

            media = soma_total / i;
            media = Math.ceil(media);

            var grafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data,
                    datasets: [
                        {
                            label: "Lançamentos Conferidos",
                            backgroundColor: "rgba(148,57,50, 0.8)",
                            borderColor: "rgba(148,57,50, 0.8)",
                            data: qtd,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Quantidade de Lançamentos Conferidos por Dia - " + mesano,
                        fontFamily: 'roboto',
                        fontSize: 18,
                        fontColor: '#3E3E3E'
                    },
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            color: '#000000',
                            font: function (context) {
                                var w = context.chart.width;
                                return {
                                    size: w < 512 ? 12 : 14
                                };
                            },
                            formatter: function (value, context) {
                                return value;
                            }
                        }
                    },
                    tooltips: {
                        mode: "index",
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    annotation: {
                        annotations: [{
                            type: 'line',
                            label: 'Lançamentos Conferidos',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: media,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Média ' + media + ' Lcto/Dia Conferidos'
                            },
                        }/*, {
                            type: 'line',
                            label: 'Peças Conferidas',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 1500,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Target 1.500 Pc/Dia'
                            },
                        }*/],
                        drawTime: 'afterDraw'
                    }
                }
            });
        }
    });
}

//VALOR DE REPAROS POR DIA
function graficoValorReparosDiaFiltrar() {

    $.ajax({
        url: diretorio_sistema + "indicador/indicadores",
        type: "POST",
        data: { tipo: 'reparosconferidosdia' },
        error: function (result) {
            //console.log(result);
        },
        success: function (dados) {
            var dados = JSON.parse(dados);
            var ctx = $("#graficoValorReparosDia")[0];
            var data = [];
            var vlr = [];
            var soma_total = 0;
            var media = 0;
            var i = 0;
            var mesano = mesano_extenso();

            $.each(dados, function (key, value) {
                data.push(value['data']);
                vlr.push(value['vlr']);
                i++;
            });

            var tamanho = vlr.length;

            while (tamanho--) {
                soma_total += parseInt(vlr[tamanho]);
            }

            media = soma_total / i;
            media = Math.ceil(media);

            var grafico = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data,
                    datasets: [
                        {
                            label: "Valor de Reparo Conferido",
                            backgroundColor: "rgba(148,57,50, 0.8)",
                            borderColor: "rgba(148,57,50, 0.8)",
                            data: vlr,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Valor de Reparos Conferidos por Dia - " + mesano,
                        fontFamily: 'roboto',
                        fontSize: 18,
                        fontColor: '#3E3E3E'
                    },
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            color: '#000000',
                            font: function (context) {
                                var w = context.chart.width;
                                return {
                                    size: w < 512 ? 0 : 0
                                };
                            },
                            formatter: function (value, context) {
                                return moedareal(value);
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    return moedareal(value);
                                }
                            }
                        }]
                    },
                    annotation: {
                        annotations: [{
                            type: 'line',
                            label: 'Valor Médio de Reparo Conferido',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: media,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Média ' + moedareal(media) + ' Val/Dia Conferidos'
                            },
                        }/*, {
                            type: 'line',
                            label: 'Peças Conferidas',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 1500,
                            borderColor: 'rgba(148,57,50)',
                            borderWidth: 2,
                            label: {
                                backgroundColor: 'rgba(148,57,50)',
                                fontFamily: 'sans-serif',
                                fontSize: 12,
                                fontColor: '#fff',
                                xPadding: 3,
                                yPadding: 3,
                                cornerRadius: 3,
                                position: 'right',
                                xAdjust: 0,
                                yAdjust: 0,
                                enabled: true,
                                content: 'Target R$ 11.500,00 Val/Dia'
                            },
                        }*/],
                        drawTime: 'afterDraw'
                    },
                    tooltips: {
                        callbacks: {
                            label: function (t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = moedareal(t.yLabel);
                                return xLabel + ': ' + yLabel;
                            }
                        }
                    }
                }
            });
        }
    });
}

$(function () {
    graficoPecasDiaFiltrar();
    graficoLctosDiaFiltrar();
    graficoValorReparosDiaFiltrar();
    graficoVolDiaFiltrar();
});