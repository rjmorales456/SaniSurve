<script setup>
import { defineEmits, defineProps } from 'vue';

// Get Item as Props
const props = defineProps({
  item: Object
});

const item = props.item // Set props as item

console.log(item)
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
        <h3 class="font-weight-medium">Permit Record</h3>
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
      <VCol>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Data of Inspection: </span> <p>{{ item.date_encoded}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Time of Inspection</span> <p>{{ item.time_of_inspection}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Owner Name: </span> <p>{{item.owner_firstname}} {{ item.owner_surname }}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Name of Establishment: </span> <p>{{ item.establishment_name}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Establishment Address: </span> <p>{{ item.sitio }}, {{ item.barangay}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">No. of Male Personnel</span> <p>{{ item.malePersonnel_count}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">No. of Female Personnel </span> <p>{{ item.femalePersonnel_count}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Total Employees: </span> <p>{{ item.personnel_count}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Sanitary Permit Number </span> <p>{{ item.sanitary_permit_number}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Permit Type: </span> <p>{{ item.permit_type}}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Toilet Provision: </span> <p>{{ item.toilet_provision }}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Solid Waste Management: </span> <p>{{ item.solid_waste_mangement }}</p>
        </div>
        <div class="d-flex justify-space-between">
          <span class="font-weight-medium">Water Supply: </span> <p>{{ item.water_supply }}</p>
        </div>
        <div class="d-flex flex-column">
          <span class="font-weight-medium">Remarks: </span> <p>{{ item.recommendation}}</p>
        </div>
      </VCol>
    </VRow>
  </VCard>
</template>
