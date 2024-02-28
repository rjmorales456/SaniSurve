<script setup>


const headingColor = 'rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity))'
const labelColor = 'rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity))'

const ChartColors={
   
    donut2:{
        series1: '#FFD1DC',
        series2: '#FF91A4',
        series3: '#FF1493',
    },

}


const accesstoWaterSourceSeries=[
    13,
    25,
    22,
]

const chartConfig={
    labels:[
       'Sanitary',
       'Unsanitary',
       'Without Toilet'
    ],
    colors: [
        ChartColors.donut2.series1,
        ChartColors.donut2.series2,
        ChartColors.donut2.series3,
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
        position: 'left',
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
        fontSize: '20x',
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
            
               size:"100%", 
                labels:{
                    show:true,
                    value:{
                        fontSize: '14px',
                        color: headingColor,
                        fontWeight: 500,
                        offsetY: -15,
                        formatter(val) {
                            return `${ Number.parseInt(val) }%`
                        },
                    },
                    name: { offsetY: 30 },
                    
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
                <VCardTitle>Access to Water Source</VCardTitle>
                <VCardSubtitle>Percentage of the Access of Water Source</VCardSubtitle>
                <VCardItem>
                    <VCardItem>
                        <VueApexCharts
                            type="pie"
                            
                            :options="chartConfig"
                            :series="accesstoWaterSourceSeries"
                            height="300">

                        </VueApexCharts>
                    </VCardItem>
                </VCardItem>
                
            </VCol>

            
            
        </VRow>
        
    </VCard>


</template>
