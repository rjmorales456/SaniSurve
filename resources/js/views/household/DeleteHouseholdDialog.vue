<script setup>
import axios from 'axios';
import { defineEmits, defineProps } from 'vue';

// Get Item as Props
const props = defineProps({
  data: Object,
  item: Object,
  itemIndex: Number
});

const data = props.data
const item = props.item // Set props as item
const index = props.itemIndex

// Emit Close Function
const emit = defineEmits()

const onClose = () => {
  emit('close')
}

const confirmDelete = async () => {
  try {
    await axios.post('/api/deleteHouseholdSurveyRecord', {id: item.id})
    data.splice(index, 1)
    console.log('Item deleted successfully');
    onClose()
  } catch (error) {
    console.error('Error updating item:', error);
    // Optionally handle errors, e.g., show an error message
  }
  
}
</script>

<template>
  <VCard>
      <VCardTitle>
        Are you sure you want to delete this item?
      </VCardTitle>

      <VCardText>
        <VRow>
          <VCol>
            <VBtn 
              @click="confirmDelete"
              class="mr-5"
            >
              Yes
            </VBtn>

            <VBtn
              @click="onClose"
              color="secondary"
              variant="tonal"
            >
              No
            </VBtn>
          </VCol>
        </VRow>
      </VCardText>
    </VCard>
</template>
