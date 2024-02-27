<script setup>

import { hexToRgb } from '@layouts/utils';
import { ref } from 'vue';
import { useTheme } from 'vuetify';

const vuetifyTheme = useTheme()

const type_of_ownership = computed(()=>{
    const currentTheme = ref(vuetifyTheme.current.value.colors)
    const variableTheme = ref(vuetifyTheme.current.value.variables)
    const borderColor = `rgba(${ hexToRgb(String(variableTheme.value['border-color'])) },${ variableTheme.value['border-opacity'] })`
    const secondaryColor = `rgba(${ hexToRgb(currentTheme.value['on-surface']) },${ variableTheme.value['medium-emphasis-opacity'] })`


    return{
    class:{
        offsetY: -10,
        offsetX: -15,
        parentHeightOffset: 0,
        toolbar: { show: false },
    },
    states: {
      hover: { filter: { type: 'none' } },
      active: { filter: { type: 'none' } },
    },
    xaxis:{
        categories:[
            'Owned',
            'Informal Settler',
            'Rent',
            'Tenant'
        ],
        axisTicks: { show: false },
        crosshairs: { opacity: 0 },
        axisBorder: { show: false },
        tickPlacement: 'on',
        labels:{
          show:true,
          style:{
            color:currentTheme,
            fontSize: '15px',
          }
        },
        
    },
    legend:{show:false},
    dataLabels: { enabled: false },
    grid: {
      borderColor,
      strokeDashArray: 7,
      xaxis: { lines: { show: false } },
      tooltip:{enabled:false}
    },
    plotOptions: {
      bar: {
        distributed: true,
        columnWidth: '30%',
        legend: { show: false },
      },
    },
    
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
    tooltip:{enable:false}

    }
});

const series = [{
  data: [
    37,
    57,
    45,
    75
  ],
}]

const property_ownership = ref('');
const property_ownership_labels = ref([]);
</script>

<template>
    <!-- Property of Ownership Distribution -->
    <VCard>
        <VCardItem>
            <VCardTitle>Property Distribution of Owners</VCardTitle>
        </VCardItem>

        <VCardItem>
            <VueApexCharts
                type="bar"
                :options="type_of_ownership"
                :series="series"
                :height="280"
            />
        </VCardItem>
    </VCard>
</template>
