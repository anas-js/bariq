<script setup lang="ts">
import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

// Chart.register(ChartDataLabels);
const props = defineProps({
    row: {
        type: Array<any>,
        required: true,
    },
    column: {
        type: Array<any>,
        required: true,
    },
    status: {
        type: Number,
        required: false,
    },
    chart: {
        type: String,
        required: false,
        default: "line",
    },
});

const color = ref(
    props.status === 1 ? "#3FDCAA" : props.status === 0 ? "#6366FF" : "#F26A81"
);
let chartObject: Chart;

const chart = ref() as Ref<HTMLCanvasElement>;
onMounted(() => {
    switch (props.chart) {
        case "line": {
            chartObject = new Chart(chart.value, {
                type: "line",
                data: {
                    labels: props.row,
                    datasets: [
                        {
                            data: props.column,

                            backgroundColor: color.value,
                            borderColor: color.value,

                            pointBackgroundColor: "transparent",
                            pointBorderColor: "transparent",
                            pointHoverBackgroundColor: color.value,
                            pointHoverBorderColor: color.value,
                            tension: 0.4,

                            pointHoverRadius: 7,
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,

                    responsive: true,
                    hover: {
                        mode: "index",
                        intersect: false,
                    },
                    scales: {
                        x: {
                            ticks: {
                                display: false,
                            },
                            grid: {
                                display: false,
                            },
                            border: {
                                display: false,
                            },
                        },
                        y: {
                            ticks: {
                                display: false,
                            },
                            grid: {
                                display: false,
                            },
                            border: {
                                display: false,
                            },
                        },
                    },
                    layout: {
                        padding: 0,
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },

                        tooltip: {
                            mode: "index",
                            intersect: false,
                            enabled: true,
                            backgroundColor: "#343586",
                            displayColors: false,
                            bodyFont: {
                                family: '"Baloo Bhaijaan 2"',
                                size:13
                            },
                            titleFont: {
                                family: '"Baloo Bhaijaan 2"',
                                size:15
                            },
                        },
                    },
                },
            });
            break;
        }
        case "pie": {
            chartObject = new Chart(chart.value, {
                type: "doughnut",
                data: {
                    labels: props.row,
                    datasets: [
                        {
                            data: props.column,
                            backgroundColor: ["#6366FF", "#6ACEF2", "#F26A81"],
                            borderWidth: 0,
                            hoverOffset: 0,
                        },
                    ],
                },
                options: {
                    cutout: "85%",
                    maintainAspectRatio: false,
                    responsive: true,
                    interaction: { mode: null },
                    hover: {
                        mode: null,
                    },

                    layout: {
                        padding: 57,
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        datalabels: {
                            anchor: "end",
                            //  backgroundColor : "#000",
                            align: "end",
                            textAlign: "right",
                            clip: false,
                            formatter(value, context) {
                                const label = props.row[context.dataIndex];

                                return `${label}\n ${value}%`;
                            },
                            font: {
                                family: '"Baloo Bhaijaan 2"',
                                weight: "bold",
                                size: 20,
                            },
                            offset: 10,
                            color: ["#6366FF", "#6ACEF2", "#F26A81"],
                        },

                        tooltip: {
                            enabled: false,
                        },
                    },
                },

                plugins: [ChartDataLabels],
            });
            break;
        }
    }
});

watch([() => props.column, () => props.row, () => props.status], (p) => {
    const datasets = chartObject.data.datasets[0];
    switch (props.chart) {
        case "line": {
            color.value =
                p[2] === 1 ? "#3FDCAA" : p[2] === 0 ? "#6366FF" : "#F26A81";

            datasets.backgroundColor = color.value;
            datasets.borderColor = color.value;

            datasets.hoverBackgroundColor = color.value;
            datasets.hoverBorderColor = color.value;
            //@ts-ignore
            datasets.pointHoverBorderColor = color.value;
            //@ts-ignore
            datasets.pointHoverBackgroundColor = color.value;
            datasets.borderColor = color.value;

            break;
        }
        case "pie": {
            break;
        }
    }
    datasets.data = p[0];
    chartObject.data.labels = p[1];

    chartObject.update();
});
</script>
<template>
    <canvas ref="chart"></canvas>
</template>
