<script setup>


const headingColor = 'rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity))'
const labelColor = 'rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity))'

const ChartColors={
    
    donut3:{
        series1:'#FFD1DC',
        series2:'#FF91A4',
        series3:'#FF69B4',
        series4:'#E75480',
        series5:'#C2185B'

    }
}


const kindofWaterSourceSeries=[
    13,
    25,
    22,
    40,
    50
]



const kindofWaterSourceConfig={
    labels:[
        'Bored/Drilled Well',
        'Dug Well',
        'Surface Water',
        'Water & Sewagrage System (Prime Water)',
        'Spring Water'

    ],
    colors: [
        ChartColors.donut3.series1,
        ChartColors.donut3.series2,
        ChartColors.donut3.series3,
        ChartColors.donut3.series4,
        ChartColors.donut3.series5,
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
        fontSize: '12px',
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
                <VCardTitle>Kind of Water Source</VCardTitle>
                <VCardSubtitle>Percentage of Kind of Water Source</VCardSubtitle>
                
                
                <VCardText>
                    <VueApexCharts
                            type="donut"
                            
                            :options="kindofWaterSourceConfig"
                            :series="kindofWaterSourceSeries">

                    </VueApexCharts>
                </VCardText>
            </VCol>
            
        </VRow>
        
    </VCard>


</template>
