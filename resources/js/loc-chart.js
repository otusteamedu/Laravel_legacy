import * as Chart from "chart.js";
import {RED, BLUE} from "./chart-colors";

$(() => {
    $("canvas[data-loc-chart]").each((_, canvas) => {
        const data = JSON.parse(canvas.getAttribute("data-loc-chart"));
        const ctx = canvas.getContext("2d");

        const locData = data.map(c => c.loc);
        const filesData = data.map(c => c.files);

        const lineChartData = {
            labels: data.map(c => c.commit_datetime),
            datasets: [
                {
                    label: "Lines of Code",
                    borderColor: RED,
                    backgroundColor: RED,
                    fill: false,
                    data: locData,
                    yAxisID: "y-axis-loc"
                },
                {
                    label: "Files",
                    borderColor: BLUE,
                    backgroundColor: BLUE,
                    fill: false,
                    data: filesData,
                    yAxisID: "y-axis-files"
                }
            ]
        };

        window.myLine = Chart.Line(ctx, {
            data: lineChartData,
            options: {
                responsive: true,
                hoverMode: "index",
                stacked: false,
                title: {
                    display: true,
                    text: "PHPLOC"
                },
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    }],
                    yAxes: [
                        {
                            type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            scaleLabel: {
                                display: true,
                                labelString: 'Lines of Code',
                            },
                            ticks: {
                                precision: 0
                            },
                            position: "left",
                            id: "y-axis-loc",
                        },
                        {
                            type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            scaleLabel: {
                                display: true,
                                labelString: 'Files',
                            },
                            ticks: {
                                precision: 0
                            },
                            position: "right",
                            id: "y-axis-files",

                            // grid line settings
                            gridLines: {
                                drawOnChartArea: false // only want the grid lines for one axis to show up
                            }
                        }
                    ]
                }
            }
        });
    });
});
