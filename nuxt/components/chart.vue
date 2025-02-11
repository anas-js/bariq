<script setup lang="ts">
import Chart from "chart.js/auto";
const props = defineProps({
    row: {
        type: Array<any>,
        required: true,
    },
    column : {
        type: Array<any>,
        required: true,
    },
    status : {
        type:Number,
        required:true
    }
});

const color = ref(props.status === 1 ? "#3FDCAA" : (props.status === 0 ? "#6366FF":"#F26A81"))
let chartObject : Chart;

const chart = ref() as Ref<HTMLCanvasElement>;
onMounted(() => {
    chartObject = new Chart(chart.value, {
        type: "line",
        data: {
            labels: props.row,
            datasets: [
                {
                    data: props.column,

                    backgroundColor: color.value,
                    borderColor: color.value,
                    // pointRadius:0,
                    pointBackgroundColor: "transparent",
                    pointBorderColor: "transparent",
                    pointHoverBackgroundColor: color.value,
                    pointHoverBorderColor: color.value,
                    tension: 0.4,
                    // pointRadius:7,
                    pointHoverRadius: 7,
                    // pointBackgroundColor : "#3FDCAA"
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
                    // bodyFont : {
                    //     family: 'Baloo Bhaijaan 2',
                    //     size:20,
                    //     weight: 'bold'
                    // },
                    // titleFont : {
                    //     family: 'Baloo Bhaijaan 2',
                    //     size:25
                    // }
                },
            },
        },
    });


});

watch([()=>props.column,()=>props.row,()=>props.status],(p) => {

    color.value = p[2] === 1 ? "#3FDCAA" : (p[2] === 0 ? "#6366FF":"#F26A81");

    chartObject.data.datasets[0].backgroundColor = color.value;
    chartObject.data.datasets[0].borderColor = color.value;
    // chartObject.tooltip

    // console.log(color.value);
    chartObject.data.datasets[0].hoverBackgroundColor = color.value;
    chartObject.data.datasets[0].hoverBorderColor = color.value;
    //@ts-ignore
    chartObject.data.datasets[0].pointHoverBorderColor = color.value;
      //@ts-ignore
    chartObject.data.datasets[0].pointHoverBackgroundColor = color.value;
    chartObject.data.datasets[0].borderColor = color.value;



    chartObject.data.datasets[0].data = p[0];
    chartObject.data.labels = p[1];
    chartObject.update();
    // console.log(color.value)
//     chartObject.value.data.datasets[0] = [3,5,6,7]

//   chartObject.value.update();
});
</script>
<template>
    <canvas ref="chart"></canvas>
</template>
