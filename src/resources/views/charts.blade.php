<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv@3.0.5/dist/chartjs-plugin-labels.min.js"></script>

<div class="asset">
    <div class="asset_chart">
        <canvas id="myChart"></canvas>
    </div>
    <div class="send_email" title="データをメール送信"></div>
</div>

<!-- グラフを描画 -->
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'pie',
    data : {
        labels: @json($labels),
        datasets: [{
           backgroundColor: ["#fa8072", "#00ff7f", "#00bfff", "#a9a9a9", "#f5f5f5"],
           data: @json($amount)
        }]
    },
    options: {
        plugins: {
            tooltip: {
                enabled: false
        },
        datalabels: {
            font: {
                size: 13
            },
            formatter: function( value, context ) {
                return context.dataset.labels[context.dataIndex];
            }
        },
        title: {
            display: true,
            text: '資産内訳'
        }
    },
    plugins: [
        ChartDataLabels,
    ],
}
});
</script>
