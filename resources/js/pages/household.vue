<script setup>

import axios from 'axios';
import { ref } from 'vue';

import AddHouseholdSurveyDialog from '@/views/household/AddHouseholdSurveyDialog.vue';

const data = ref({})
// Get all household survey records
await axios.get('/api/sanitation-surveys')
  .then(response => {
      // Handle success response
      data.value = response.data
  })
  .catch(error => {
      // Handle error response
      console.error('Error fetching data:', error);
  });

// Table Headers
const headers = [
  {
    title: 'DATE',
    key: 'date_encoded',
  },
  {
    title: 'NAME',
    key: 'surname',
  },
  {
    title: 'BARANGAY',
    key: 'barangay',
  },
  {
    title: 'OWNERSHIP',
    key: 'ownership',
  },
  {
    title: 'TYPE OF WATER SOURCE',
    key: 'type_of_water_source',
  },
  {
    title: 'EXCRETA DISPOSAL',
    key: 'excreta_disposal',
  },
  {
    title: 'ACTIONS',
    key: 'actions',
  },
]

// Dialog States
const viewDialog = ref(false)
const deleteDialog = ref(false)

</script>

<template>
  <section>
    <VCard> 
      <VCardTitle>
        Household Sanitation Survey
      </VCardTitle>

      <VDivider/>
      <!-- Filter Section -->
      <VCardText>
        Filters

        <VRow>
          <!--  -->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
            />
          </VCol>

          <!-- -->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
            />
          </VCol>
          <!-- -->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
            />
          </VCol>
        </VRow>
      </VCardText>

      <VDivider />

      <!-- Search and Add Section -->
      <VCardText class="d-flex align-center">
          <!-- Search -->
          <VTextField
            v-model="searchQuery"
            placeholder="Search User"
            density="compact"
            class="me-4 flex-grow-1"
          />

          <!-- Conduct Survey -->
          <AddHouseholdSurveyDialog/>

      </VCardText>

      <!-- SECTION datatable -->
      
      <VDataTable
      :headers="headers"
      :items="data"
      :items-per-page="10"
      class="text-no-wrap"
      >
        <!-- Date -->
        <template #item.date_encoded="{ item }">
          {{ item.date_encoded }}
        </template>

        <!-- Full Name -->
        <template #item.surname="{ item }">
          {{ item.surname }}, {{ item.first_name }} {{ item.middle_name }}
        </template>

        <!-- Barangay -->
        <template #item.barangay="{ item }">
          {{ item.barangay }}
        </template>

        <!-- Ownership -->
        <template #item.ownership="{ item }">
          {{ item.ownership }}
        </template>

        <!-- Type of Water Source -->
        <template #item.type_of_water_source="{ item }">
          {{ item.type_of_water_source }}
        </template>

        <!-- Excreta Disposal -->
        <template #item.excreta_disposal="{ item }">
          {{ item.excreta_disposal }}
        </template>

        <!-- Actions -->
        <template #item.actions="{ item }">
          <IconBtn
            size="small"
            color="medium-emphasis"
          >
            <VIcon
              size="24"
              icon="ri-more-2-line"
            />

            <VMenu activator="parent">
              <VList>
                <VListItem @click="onView(item)">
                  <template #prepend>
                    <VIcon icon="ri-eye-line" />
                  </template>
                  <VListItemTitle>View</VListItemTitle>
                </VListItem>
                <VListItem @click="onEdit(item)">
                  <template #prepend>
                    <VIcon icon="ri-pencil-line" />
                  </template>
                  <VListItemTitle>Edit</VListItemTitle>
                </VListItem>
                <VListItem @click="onDelete(item)">
                  <template #prepend>
                    <VIcon icon="ri-delete-bin-line" />
                  </template>
                  <VListItemTitle>Delete</VListItemTitle>
                </VListItem>
              </VList>
            </VMenu>
          </IconBtn>
        </template>
      </VDataTable>
    </VCard>
  </section>
</template>

<style lang="scss">
.app-user-search-filter {
  inline-size: 24.0625rem;
}

.text-capitalize {
  text-transform: capitalize;
}

.user-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity));
}
</style>
