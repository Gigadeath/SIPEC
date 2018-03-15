
$(document).ready(function(){

  $(document).foundation();

  var flot1 = function () {
        var data = [[0, 65], [1, 59], [2, 80], [3, 81], [4, 56], [5, 55], [6, 40]];
        var data2 = [[0, 28], [1, 48], [2, 40], [3, 19], [4, 86], [5, 27], [6, 90]];
        var dataset =  [
            {
                data: data,
                color: "rgba(220,220,220,1)",
                lines: {
                    show: true,
                    fill: 0.2,
                },
                shadowSize: 0,
            }, {
                data: data,
                color: "#fff",
                lines: {
                    show: false,
                },
                points: {
                    show: true,
                    fill: true,
                    radius: 4,
                    fillColor: "rgba(220,220,220,1)",
                    lineWidth: 2
                },
                curvedLines: {
                    apply: false,
                },
                shadowSize: 0
            }, {
                data: data2,
                color: "rgba(34,186,160,1)",
                lines: {
                    show: true,
                    fill: 0.2,
                },
                shadowSize: 0,
            },{
                data: data2,
                color: "#fff",
                lines: {
                    show: false,
                },
                curvedLines: {
                    apply: false,
                },
                points: {
                    show: true,
                    fill: true,
                    radius: 4,
                    fillColor: "rgba(34,186,160,1)",
                    lineWidth: 2
                },
                shadowSize: 0
            }
        ];
        
        var ticks = [[0, "1"], [1, "2"], [2, "3"], [3, "4"], [4, "5"], [5, "6"], [6, "7"], [7, "8"]];

        var plot1 = $.plot("#flotchart1", dataset, {
            series: {
                color: "#14D1BD",
                lines: {
                    show: true,
                    fill: 0.2
                },
                shadowSize: 0,
                curvedLines: {
                    apply: true,
                    active: true
                }
            },
            xaxis: {
                ticks: ticks,
            },
            legend: {
                show: false
            },
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "%yK",
                defaultTheme: false
            }
        });
        
    };
    
    flot1();

    var flot2 = function () {
        var data = [[0, 11], [1, 15], [2, 25], [3, 24], [4, 13], [5, 18]];
        var dataset = [{
            data: data,
            color: "#22BAA0"
        }];
        var ticks = [[0, "1"], [1, "2"], [2, "3"], [3, "4"], [4, "5"], [5, "6"]];

        var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.15
            },
            xaxis: {
                ticks: ticks
            },
            legend: {
                show: false
            },
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "X: %x, Y: %y",
                defaultTheme: false
            }
        };

        $.plot($("#flotchart2"), dataset, options);
    };

    flot2();

});