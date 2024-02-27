<script setup>
import { hexToRgb } from '@layouts/utils';
import { ref } from 'vue';
import { useTheme } from 'vuetify';

const vuetifyTheme = useTheme()
const chartConfig = computer(()=>{
    const currentTheme = ref(vuetifyTheme.current.value.colors)
    const variableTheme = ref(vuetifyTheme.current.value.variables)
    const borderColor = `rgba(${ hexToRgb(String(variableTheme.value['border-color'])) },${ variableTheme.value['border-opacity'] })`


    return{
        chart:{
            offsetY: -10,
            offsetX: -15,
            parentHeightOffset: 0,
            toolbar: { show: false },
        },
        
        xaxis:{
            categories:[
    
                'Waste Disposal',
                'Sanitary',
                'Unsanitary'
            ]
        },
        dataLabels: { enabled: false },
        grid: {
            borderColor,
            strokeDashArray: 7,
            xaxis: { lines: { show: false } },
        },
        colors: [
            ' rgba(255, 209, 220, 1)',
            'rgba(255, 182, 193, 1)',
            'rgba(255, 192, 203, 1)',
            'rgba(255, 204, 218, 1)'

        ],
        yaxis: {
            show: true,
            tickAmount: 4,
            labels: {
                style: {
                fontSize: '15px',
                },
                
            },
        },

    }
})

const series = [{
  data: [
    37,
    57,
    45,
    75
  ],
}]

</script>


<template>
    <VCard>
        <VRow>
            <VCol>
                <VCardTitle>Waste Disposal</VCardTitle>


                <VCardItem>
                    <VueApexCharts
                    type="bar"
                    :options="chartConfig"
                    :series="series"
                    >

                    </VueApexCharts>
                </VCardItem>
            </VCol>
        </VRow>
    </VCard>
</template>
