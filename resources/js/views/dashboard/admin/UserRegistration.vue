<script setup>
import { hexToRgb } from '@layouts/utils';
import { useTheme } from 'vuetify';
const vuetifyTheme = useTheme()

const chartConfig = computed(() =>{
    const currentTheme = ref(vuetifyTheme.current.value.colors)
    const variableTheme = ref(vuetifyTheme.current.value.variables)
    const secondaryTextColor = `rgba(${ hexToRgb(currentTheme.value['on-surface']) },${ variableTheme.value['medium-emphasis-opacity'] })`


    return{
        chart:{
            parentHeightOffset: 0,
            toolbar:{show:false}
        },
        
        stroke: {
            width: 5,
            curve: 'smooth',
            lineCap: 'round',
        },
        colors: [currentTheme.value.success],
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0,
                bottom: -10,
            },
        },
        xaxis:{
            axisTicks:{show:false},
            axisBoarder:{show:false},
            categories:[
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sept',
                'Oct',
                'Nov',
                'Dec'
            ],
            labels:{style:{colors:secondaryTextColor}},
        },
        yaxis:{
            labels:{
                show:true,
                style:{colors:secondaryTextColor}
            },

        },
        tooltip:{enable:false}
    }
})


const series = [{
  name: 'Total Sales',
  data: [
    0,
    258,
    30,
    240,
    150,
    400,,
    750,
    630,
    456,
    125,
    144
  ],
}]
</script>

<template>

<VCard>
    <VCardItem>
        <VCardTitle>User Registration per Month</VCardTitle>
        <VCardSubtitle>Users that Registered within the following Months.</VCardSubtitle>
    </VCardItem>
    
    <VCardText>
        <VueApexCharts
            type="line"
            :options="chartConfig"
            :series="series"
            :height="290"
            >
        </VueApexCharts>
    </VCardText>
    
</VCard>
    
</template>
