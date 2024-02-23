<script setup>

// Filter
import FilterDashboard from '@/views/dashboard/admin/FilterDashboard.vue';

<template>
    <VRow class="match-height">
        
      <VCol 
          cols = '12'
          md = '12'      
        >
          <h1>Sanitation Survey Statistics</h1>
        </VCol>

        {/* Filtering */}
        <VCol
        cols = '12'
        md = '4'>
          <FilterDashboard />
        </VCol>

        
      
    </VRow>
</template>
