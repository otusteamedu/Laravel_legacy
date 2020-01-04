import * as Chart from "chart.js";
import {RED, BLUE, ORANGE, GREEN, PURPLE} from "./chart-colors";

$(() => {
    $("canvas[data-insights-chart]").each((_, canvas) => {
        const data = JSON.parse(canvas.getAttribute("data-insights-chart"));
        const ctx = canvas.getContext("2d");

        const codeData = data.map(c => c.code);
        const complexityData = data.map(c => c.complexity);
        const architectureData = data.map(c => c.architecture);
        const styleData = data.map(c => c.style);
        const securityIssuesData = data.map(c => c.security_issues);

        const lineChartData = {
            labels: data.map(c => c.commit_datetime),
            datasets: [
                {
                    label: "Code",
                    borderColor: ORANGE,
                    backgroundColor: ORANGE,
                    fill: false,
                    data: codeData,
                    yAxisID: "y-axis-percents"
                },
                {
                    label: "Complexity",
                    borderColor: PURPLE,
                    backgroundColor: PURPLE,
                    fill: false,
                    data: complexityData,
                    yAxisID: "y-axis-percents"
                },
                {
                    label: "Architecture",
                    borderColor: GREEN,
                    backgroundColor: GREEN,
                    fill: false,
                    data: architectureData,
                    yAxisID: "y-axis-percents"
                },
                {
                    label: "Style",
                    borderColor: BLUE,
                    backgroundColor: BLUE,
                    fill: false,
                    data: styleData,
                    yAxisID: "y-axis-percents"
                },
                {
                    label: "Security Issues",
                    borderColor: RED,
                    backgroundColor: RED,
                    fill: false,
                    data: securityIssuesData,
                    yAxisID: "y-axis-issues"
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
                    text: "PHP Insights"
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
                                labelString: 'Percents: Higher is better',
                            },
                            ticks: {
                                precision: 0,
                                max: 100,
                            },
                            position: "left",
                            id: "y-axis-percents",
                        },
                        {
                            type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            scaleLabel: {
                                display: true,
                                labelString: 'Security Issues',
                            },
                            ticks: {
                                precision: 0,
                                min: 0,
                            },
                            position: "right",
                            id: "y-axis-issues",

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
