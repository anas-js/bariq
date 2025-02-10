<script setup lang="ts">
import Chart from "chart.js/auto";

const revenueChart = ref() as Ref<HTMLCanvasElement>;

const data = [
    { date: '2024-10-01', Income: 122 },
    { date: '2024-10-02', Income: 175 },
    { date: '2024-10-03', Income: 301 },
    { date: '2024-10-04', Income: 210 },
    { date: '2024-10-05', Income: 95 },
    { date: '2024-10-06', Income: 150 },
    { date: '2024-10-07', Income: 180 },
    { date: '2024-10-08', Income: 212 },
    { date: '2024-10-09', Income: 320 },
    { date: '2024-10-10', Income: 248 },
    { date: '2024-10-11', Income: 400 },
    { date: '2024-10-12', Income: 310 },
    { date: '2024-10-13', Income: 260 },
    { date: '2024-10-14', Income: 515 },
    { date: '2024-10-15', Income: 670 },
    { date: '2024-10-16', Income: 530 },
    { date: '2024-10-17', Income: 625 },
    { date: '2024-10-18', Income: 710 },
    { date: '2024-10-19', Income: 810 },
    { date: '2024-10-20', Income: 935 },
    { date: '2024-10-21', Income: 755 },
    { date: '2024-10-22', Income: 980 },
    { date: '2024-10-23', Income: 1160 },
    { date: '2024-10-24', Income: 1250 },
    { date: '2024-10-25', Income: 1050 },
    { date: '2024-10-26', Income: 800 },
    { date: '2024-10-27', Income: 920 },
    { date: '2024-10-28', Income: 1180 },
    { date: '2024-10-29', Income: 1500 },
    { date: '2024-10-30', Income: 1380 },
    { date: '2024-10-31', Income: 1600 }
];

// Chart.defaults.font.family ="Baloo Bhaijaan 2";
onMounted(() => {
    new Chart(revenueChart.value, {
        type: "line",
        data: {
            labels: data.map((row) => row.date),
            datasets: [
                {
                 data: data.map((row) => row.Income),

                  backgroundColor : '#3FDCAA',
                    borderColor : "#3FDCAA",
                    // pointRadius:0,
                    pointBackgroundColor:"transparent",
                    pointBorderColor: 'transparent',
                    pointHoverBackgroundColor: "#3FDCAA",
                    pointHoverBorderColor: "#3FDCAA",
                    tension:0.4,
                    // pointRadius:7,
                    pointHoverRadius: 7,

                    // pointBackgroundColor : "#3FDCAA"
                },
            ],
        },
        options : {
            maintainAspectRatio : false,
            responsive:true,
            hover : {
                mode : "index",
                intersect : false,
            },
           scales : {
            x : {
                ticks : {
                    display:false,


                },
                grid : {
                    display: false,
                },
                border : {
                    display : false
                }
            },
            y : {
                ticks : {
                    display:false
                },
                grid : {
                    display: false,

                },
                border : {
                    display : false
                }
            }
           },
           layout : {
            padding : 0
           },
           plugins :{
            legend : {
                display : false,

            },

            tooltip : {
                mode:"index",
                intersect:false,
                enabled:true,
                backgroundColor: "#343586",
                displayColors:false,
                // bodyFont : {
                //     family: 'Baloo Bhaijaan 2',
                //     size:20,
                //     weight: 'bold'
                // },
                // titleFont : {
                //     family: 'Baloo Bhaijaan 2',
                //     size:25
                // }
            }
           }
        }
    });
});
</script>

<template>
    <div class="dashboard-page">
        <h1><i class="ri-pie-chart-line"></i>لوحة التحكم</h1>

        <div class="statistics">
            <div>
                <div class="top">
                    <p class="title">الإيرادات</p>
                    <span class="tag green">+13%</span>
                    <div class="timeline">
                        <span class="date"
                            >آخر شهر<i class="ri-arrow-drop-down-line"></i
                        ></span>
                    </div>
                </div>
                <div class="value">
                    <h2>1304</h2>
                    <p>ريال</p>
                </div>
                <div class="chart">
                    <canvas ref="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>
