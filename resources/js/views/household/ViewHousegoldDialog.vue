<script setup>
import { defineEmits, defineProps } from 'vue';

// Get Item as Props
const props = defineProps({
  item: Object
});

const item = props.item // Set props as item

// Emit Close Function
const emit = defineEmits()

const onClose = () => {
  emit('close')
}

</script>

<template>
  <VCard class="pa-5">
      <VRow>

        <VCol cols="12">
          <h1>Survey Record</h1>
          <DialogCloseBtn
            variant="text"
            size="default"
            @click="onClose"
          />
        </VCol>
        
        <VDivider class="my-2 mx-3" />

        <VCol 
          cols = '12'
          md = '12'      
        >
          <h3>1. Personal Information</h3>
        </VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Date: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.date_encoded }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Full Name: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.surname }}, {{ item.first_name }} {{ item.middle_name }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Sitio: </span> </VCol>
        <VCol cols="12" md="6"><p>{{ item.sitio }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Barangay: </span> </VCol>
        <VCol cols="12" md="6"><p>{{ item.barangay }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Ownership: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.ownership }} </p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Number of Occupants: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.number_of_occupants }} </p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Number of Family: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.number_of_families }} </p></VCol>

        <VCol 
          cols = '12'
          md = '12'      
        >
          <h3>2. Water Source</h3>
        </VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Type of Water Source: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.type_of_water_source }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Accessibility to Water Source: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.accessibility_to_water_source }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Kind of Water Source:  </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.kind_of_water_source }}</p></VCol>

        <VCol cols="12" md="6" v-if="item.depth"><span class="font-weight-bold">Depth of Well:  </span></VCol>
        <VCol cols="12" md="6" v-if="item.depth"><p>{{ item.depth }}</p></VCol>

        <VCol cols="12" md="6" v-if="item.years_constructed"><span class="font-weight-bold">Year Well was Constructed: </span></VCol>
        <VCol cols="12" md="6" v-if="item.years_constructed"><p>{{ item.years_constructed }}</p></VCol>

        <VCol 
          cols = '12'
          md = '12'      
        >
          <h3>3. Waste Disposal</h3>
        </VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of Excreta Disposal: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.excreta_disposal }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Specific: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.specified_method_for_excreta_disposal.join(', ') }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Excreta Disposal is shared with other household: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.shared_with_other_household }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Household practices waste segregation: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.household_practices_waste_segregation }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is collected by city collection and disposal system: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.collected_by_city_collection_and_disposal_system }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is resycled and reused: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.recycling_and_reusing }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing biodegradables: </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.disposal_of_biodegradable.join(', ') }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing non-biodegradables </span></VCol>
        <VCol cols="12" md="6"><p>{{ item.disposal_of_non_biodegradable.join(', ') }}</p></VCol>

      </VRow>
    </VCard>
</template>
