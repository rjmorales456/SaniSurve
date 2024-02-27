<script setup>


const headingColor = 'rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity))'
const labelColor = 'rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity))'

const ChartColors={
    donut:{
        series1: '#FFD1DC',
        series2: '#FF91A4',
        series3: '#FF1493',
        series4: '#DB7093',
    },
    
}

const typeofWaterSourceSeries=[
    13,
    25,
    22,
    40,
]

const typeofWaterChartConfig={
    labels:[
        'Level 1',
        'Level 2',
        'Level 3',
        'Doubtful'
    ],
    colors: [
        ChartColors.donut.series1,
        ChartColors.donut.series2,
        ChartColors.donut.series3,
        ChartColors.donut.series4
    ],
    stroke: { width: 0 },
    dataLabels: {
            enabled: false,
            formatter(val) {
                return `${ Number.parseInt(val) }%`
            },
    },
    legend: {
        show: true,
        position: 'bottom',
        offsetY: 10,
        markers: {
            width: 8,
            height: 8,
            offsetX: -3,
        },
        itemMargin: {
            horizontal: 15,
            vertical: 5,
        },
        fontSize: '16px',
        fontWeight: 400,
        labels: {
            colors: headingColor,
            useSeriesColors: false,
        },
    },
    tooltip: { theme: false },
    grid: { padding: { top: 15 } },
    plotOptions:{
        pie:{
            donut:{
                size:"75%",
                labels:{
                    show:true,
                    value:{
                        fontSize: '20px',
                        color: headingColor,
                        fontWeight: 500,
                        offsetY: -15,
                        formatter(val) {
                            return `${ Number.parseInt(val) }%`
                        },
                    },
                    name: { offsetY: 30 },
                    
                }
            }
        },
    },
    responsive: [{
        breakpoint: 420,
        options: { chart: { height: 400 } },
    }],
}


</script>

<template>

    <VCard>

        <VRow>
            <VCol>
                <VCardTitle>Type of Water Source</VCardTitle>
                <VCardSubtitle>Percentage of the Types of Water Source</VCardSubtitle>
                <VCardItem>
                    <VueApexCharts
                        type="donut"
                        
                        :options="typeofWaterChartConfig"
                        :series="typeofWaterSourceSeries"
                        >
                        

                    </VueApexCharts>
                </VCardItem>
            </VCol>
            
            <VDivider :vertical="$vuetify.display.mdAndUp" />


            
            
        </VRow>
        
    </VCard>


</template>
