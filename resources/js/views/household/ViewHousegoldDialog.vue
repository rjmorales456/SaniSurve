<script setup>

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
          <h3 class="font-weight-medium">Survey Record</h3>
          <DialogCloseBtn
            variant="text"
            size="default"
            @click="onClose"
          />
        </VCol>
      </VRow>

      <VRow>
        <VDivider class="my-2 mx-3" />
      </VRow>
      
      <VRow>
        <VCol cols="12" class="d-flex flex-column">
          <h4 class="font-weight-medium mb-4">Personal Information</h4>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Date: </span> <p>{{ item.date_encoded }}</p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Full Name: </span> <p>{{ item.surname }}, {{ item.first_name }} {{ item.middle_name }}</p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Barangay: </span> <p>{{ item.barangay }}</p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Sitio: </span> <p>{{ item.sitio }}</p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Ownership: </span> <p>{{ item.ownership }} </p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Number of Occupants: </span> <p>{{ item.number_of_occupants }} </p>
          </div>
          <div class="d-flex justify-space-between">
            <span class="font-weight-medium">Number of Family: </span> <p>{{ item.number_of_families }} </p>
          </div>
        </VCol>
      </VRow>

      <VRow>
        <VCol cols="12" class="d-flex flex-column">
          <h4 class="font-weight-medium mb-4">Water Source</h4>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Type of Water Source: </span> <p>{{ item.type_of_water_source }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Accessibility to Water Source: </span> <p>{{ item.accessibility_to_water_source }}</p>
          </div> 
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Kind of Water Source:  </span> <p>{{ item.kind_of_water_source }}</p>
          </div>
          <div class="d-flex justify-space-between" v-if="item.depth">
            <span class="font-weight-medium">Depth of Well:  </span> <p>{{ item.depth }}</p>
          </div>
          <div class="d-flex justify-space-between" v-if="item.years_constructed">
            <span class="font-weight-medium">Year Well was Constructed: </span> <p>{{ item.years_constructed }}</p>
          </div>
        </VCol>
      </VRow>

      <VRow>
        <VCol cols="12" class="d-flex flex-column">
          <h4 class="font-weight-medium mb-4">Waste Disposal</h4>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Method of Excreta Disposal: </span> <p>{{ item.excreta_disposal }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Specific: </span> <p>{{ item.specified_method_for_excreta_disposal.join(', ') }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Excreta Disposal is shared with other household: </span> <p>{{ item.shared_with_other_household }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Household practices waste segregation: </span> <p>{{ item.household_practices_waste_segregation }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Waste is collected by city collection and disposal system: </span> <p>{{ item.collected_by_city_collection_and_disposal_system }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Waste is resycled and reused: </span> <p>{{ item.recycling_and_reusing }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Method of disposing biodegradables: </span> <p>{{ item.disposal_of_biodegradable.join(', ') }}</p>
          </div>
          <div class="d-flex justify-space-between"> 
            <span class="font-weight-medium">Method of disposing non-biodegradables </span> <p>{{ item.disposal_of_non_biodegradable.join(', ') }}</p>
          </div>
        </VCol>
      </VRow>
    </VCard>
</template>
