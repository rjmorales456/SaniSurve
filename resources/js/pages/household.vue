<script setup>

import axios from 'axios';
import { ref } from 'vue';

import AddHouseholdSurveyDialog from '@/views/household/AddHouseholdSurveyDialog.vue';
import DeleteHouseholdDialog from '@/views/household/DeleteHouseholdDialog.vue';
import EditHouseholdDialog from '@/views/household/EditHouseholdDialog.vue';
import ViewHouseholdDialog from '@/views/household/ViewHousegoldDialog.vue';

const data = ref({})
// Get all household survey records
const getData = async () => {
  try{
    await axios.get('/api/sanitation-surveys')
  .then(response => {
      // Handle success response
      data.value = response.data
  })
  .catch(error => {
      // Handle error response
      console.error('Error fetching data:', error);
  });
  } catch {

  }
  
}

await getData()

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

const selectedBarangay = ref()
const selectedOwnership = ref()
const selectedWaterSource = ref()
const searchQuery = ref()

const filteredItems = ref(data.value)


// Filter Logic
watch([selectedBarangay, selectedOwnership, selectedWaterSource],() => {
  filteredItems.value = data.value.filter(
    item => {
      if (!selectedBarangay.value && !selectedOwnership.value && !selectedWaterSource.value) {
        return true
      } else {
        return item.ownership === selectedOwnership.value || item.barangay === selectedBarangay.value || item.kind_of_water_source === selectedWaterSource.value
      }
    }
  )
})

// Search Logic
watch([searchQuery], () => {
  selectedBarangay.value = null
  selectedOwnership.value = null
  selectedWaterSource.value = null

  filteredItems.value = data.value.filter(
    item => {
      if (!searchQuery.value) {
        return true
      } else {
        return item.surname.toLowerCase().includes(searchQuery.value.toLowerCase()) || item.first_name.toLowerCase().includes(searchQuery.value.toLowerCase()) || item.middle_name.toLowerCase().includes(searchQuery.value.toLowerCase()) 
      }
    }
  )
})

const barangayList = [
    'Alitao',
    'Alsam Ibaba',
    'Alsam Ilaya',
    'Alupay',
    'Angeles Zone I (Poblacion)',
    'Angeles Zone II',
    'Angeles Zone III',
    'Angeles Zone IV',
    'Angustias Zone I (Poblacion)',
    'Angustias Zone II',
    'Angustias Zone III',
    'Angustias Zone IV',
    'Anos',
    'Ayaas',
    'Baguio',
    'Banilad',
    'Ibabang Bukal',
    'Ilayang Bukal',
    'Calantas',
    'Calumpang',
    'Camaysa',
    'Dapdap',
    'Kanlurang Domoit',
    'Silangang Domoit',
    'Gibanga',
    'Ibas',
    'Ilasan Ibaba',
    'Ilasan Ilaya',
    'Ipilan',
    'Isabang',
    'Katigan Kanluran',
    'Katigan Silangan',
    'Lakawan',
    'Lalo',
    'Lawigue',
    'Lita',
    'Malaoa',
    'Masin',
    'Mate',
    'Mateuna',
    'Mayowe',
    'Ibabang Nangka',
    'Ilayang Nangka',
    'Opias',
    'Ibabang Palale',
    'Ilayang Palale',
    'Kanlurang Palale',
    'Silangang Palale',
    'Pandakaki',
    'Pook',
    'Potol',
    'San Diego Zone I (Poblacion)',
    'San Diego Zone II (Poblacion)',
    'San Diego Zone III',
    'San Diego Zone IV',
    'San Isidro Zone I (Poblacion)',
    'San Isidro Zone II',
    'San Isidro Zone III',
    'San Isidro Zone IV',
    'San Roque Zone I (Poblacion)',
    'San Roque Zone II',
    'Talolong',
    'Tamlong',
    'Tongko',
    'Valencia',
    'Wakas',
];

const ownershipList = [
  'Owned', 'Informal Settler', 'Rent', 'Tenant'
]

const waterTypeList = [
  'Level I', 'Level II', 'Level III', 'Doubtful'
]

// Dialog States
const viewDialog = ref(false)
const editDialog = ref(false)
const deleteDialog = ref(false)

const selectedItem = ref({})
const selectedItemIndex = ref(-1)
const defaultItem = ref({
  id: -1,
  date_encoded: '',
  surname: '',
  first_name: '',
  middle_name: '',
  sitio: '',
  barangay: '',
  ownership: '',
  number_of_occupants: 0,
  number_of_families: 0,
  type_of_water_source: '',
  accessibility_to_water_source: '',
  kind_of_water_source: '',
  excreta_disposal: '',
  shared_with_other_household: '',
  household_practices_waste_segregation: '',
  collected_by_city_collection_and_disposal_system: '',
  disposal_of_biodegradable: [],
  disposal_of_non_biodegradable: [],
  recycling_and_reusing: '',
  depth: '',
  years_constructed: '',
  specified_method_for_excreta_disposal: []
}) 

// View Function
const onView = (item) => {
  selectedItem.value = { ...item};
  viewDialog.value = true
}

// Edit Function
const onEdit = (item) => {
  selectedItem.value = { ...item};
  selectedItemIndex.value = data.value.indexOf(item)
  editDialog.value = true
}

// Delete Function
const onDelete = (item) => {
  selectedItem.value = { ...item};
  selectedItemIndex.value = data.value.indexOf(item)
  deleteDialog.value = true
}

// Close Function
const onClose = async () => {
  selectedItemIndex.value = -1
  selectedItem.value = { ...defaultItem.value}
  editDialog.value = false
  viewDialog.value = false
  deleteDialog.value = false
}

</script>

<template>
  <section>
    <VCard> 
      <VCardTitle>
        Household Sanitation Survey
      </VCardTitle>

      <VDivider/>
      <!-- Filter Section -->

      <VCardTitle>
        Filter
      </VCardTitle>
      <VCardText>
        <VRow>
          <!--  Barangay -->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
              v-model="selectedBarangay"
              label="Select Barangay"
              placeholder="Select Barangay"
              :items="barangayList"
              clearable
              clear-icon="ri-close-line"
            />
          </VCol>

          <!-- Ownership -->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
              v-model="selectedOwnership"
              label="Select Ownership"
              placeholder="Select Ownership"
              :items="ownershipList"
              clearable
              clear-icon="ri-close-line"
            />
          </VCol>
          <!-- Type of Water Source-->
          <VCol
            cols="12"
            sm="4"
          >
            <VSelect
              v-model="selectedWaterSource"
              label="Select Water Source"
              placeholder="Select Water Source"
              :items="waterTypeList"
              clearable
              clear-icon="ri-close-line"
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
            placeholder="Search Name"
            density="compact"
            class="me-4 flex-grow-1"
          />

          <!-- Conduct Survey -->
          <AddHouseholdSurveyDialog
            :data="data"
          />

      </VCardText>

      <!-- SECTION datatable -->
      
      <VDataTable
      :headers="headers"
      :items="filteredItems"
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

  <!--View Dialog-->
  <VDialog
    v-model="viewDialog"
    class="v-dialog-sm"
  >
    <!-- Dialog Content -->
    <ViewHouseholdDialog 
      :item="selectedItem" 
      @close="onClose"
    />
  </VDialog>

  <!--Edit Dialog-->
  <VDialog
    v-model="editDialog"
    max-width="600px"
    persistent
  >
    <!-- Dialog Content -->
    <EditHouseholdDialog
      :data="filteredItems"
      :item="selectedItem"
      :itemIndex="selectedItemIndex" 
      @close="onClose"
    />
  </VDialog>

  <!--Delete Dialog-->
  <VDialog
    v-model="deleteDialog"
    class="v-dialog-sm"
  >
    <!-- Dialog Content -->
    <DeleteHouseholdDialog 
      :data="filteredItems"
      :item="selectedItem"
      :itemIndex="selectedItemIndex" 
      @close="onClose"
    />
  </VDialog>

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
