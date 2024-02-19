<script setup>

import axios from 'axios';
import { ref } from 'vue';

const data = ref({})

const viewDialog = ref(false)
const editDialog = ref(false)
const deleteDialog = ref(false)

await axios.get('/api/sanitation-permit')
  .then(response => {
      // Handle success response
      data.value = response.data;
      console.log(data)
  })
  .catch(error => {
      // Handle error response
      console.error('Error fetching data:', error);
  });

const defaultItem = ref({
  id: -1,
  date: '',
  surName: '',
  firstName: '',
  middleName: '',
  sitio: '',
  barangay: '',
  ownership: '',
  numOccupants: 0,
  numFamilies: 0,
  typeWater: '',
  accessWater: '',
  kindWater: '',
  excretaDisposal: '',
  isShared: '',
  isSegragated: '',
  isCollected: '',
  disposalBio: [],
  disposalNonBio: [],
  isRecycled: '',
  wellDepth: '',
  yearConstructed: '',
  specifiedMethod: ''
})

const viewItem = ref({})
const editedItem = ref(defaultItem.value)
const editedIndex = ref(-1)

// headers
const headers = [
  {
    title: 'DATE',
    key: 'date_encoded',
  },
  {
    title: 'NAME',
    key: 'owner_surname',
  },
  {
    title: 'BARANGAY',
    key: 'barangay',
  },
  {
    title: 'ESTABLISHMENT',
    key: 'establishment_name',
  },
  {
    title: 'SANITARY PERMIT NUMBER',
    key: 'sanitary_permit_number',
  },
  {
    title: 'ACTIONS',
    key: 'actions',
  },
]

const onView = (item) => {
  viewItem.value = item
  viewDialog.value = true
}

const onEdit = (item) => {
  editedIndex.value = data.value.indexOf(item)
  editedItem.value = { ...item }
  editDialog.value = true
}

const onDelete = (item) => {
  editedIndex.value = data.value.indexOf(item)
  editedItem.value = { ...item }
  deleteDialog.value = true
}

const close = () => {
  editDialog.value = false
  editedIndex.value = -1
  editedItem.value = { ...defaultItem.value }
}

const closeDelete = () => {
  deleteDialog.value = false
  editedIndex.value = -1
  editedItem.value = { ...defaultItem.value }
}

const save = () => {
  // Update Function Here
  close()
}

const deleteItemConfirm = () => {
  // Delete Function Here
  closeDelete()
}
</script>

<template>
  <VCard class="pa-10">
    <!-- 👉 Datatable  -->
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
      <template #item.owner_surname="{ item }">
        {{ item.owner_surname }}, {{ item.owner_firstname }}
      </template>

      <!-- Barangay -->
      <template #item.barangay="{ item }">
        {{ item.barangay }}
      </template>

      <!-- Establishment Name -->
      <template #item.establishment_name="{ item }">
        {{ item.establishment_name }}
      </template>

      <!-- Sanitary Permit Number -->
      <template #item.sanitary_permit_number="{ item }">
        {{ item.sanitary_permit_number }}
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

  <!-- View Dialog -->
  <VDialog
    v-model="viewDialog"
    class="v-dialog-sm"
  >
    <!-- Dialog Content -->
    <VCard class="pa-5">
      <VRow>

        <VCol cols="12">
          <h1>Survey Record</h1>
          <DialogCloseBtn
            variant="text"
            size="default"
            @click="viewDialog = false"
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
        <VCol cols="12" md="6"><p>{{ viewItem.date_encoded }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Full Name: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.surname }}, {{ viewItem.first_name }} {{ viewItem.middle_name }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Sitio: </span> </VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.sitio }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Barangay: </span> </VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.barangay }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Ownership: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.ownership }} </p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Number of Occupants: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.number_of_occupants }} </p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Number of Family: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.number_of_families }} </p></VCol>

        <VCol 
          cols = '12'
          md = '12'      
        >
          <h3>2. Water Source</h3>
        </VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Type of Water Source: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.type_of_water_source }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Accessibility to Water Source: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.accessibility_to_water_source }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Kind of Water Source:  </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.kind_of_water_source }}</p></VCol>

        <VCol cols="12" md="6" v-if="viewItem.depth"><span class="font-weight-bold">Depth of Well:  </span></VCol>
        <VCol cols="12" md="6" v-if="viewItem.depth"><p>{{ viewItem.depth }}</p></VCol>

        <VCol cols="12" md="6" v-if="viewItem.years_constructed"><span class="font-weight-bold">Year Well was Constructed: </span></VCol>
        <VCol cols="12" md="6" v-if="viewItem.years_constructed"><p>{{ viewItem.years_constructed }}</p></VCol>

        <VCol 
          cols = '12'
          md = '12'      
        >
          <h3>3. Waste Disposal</h3>
        </VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of Excreta Disposal: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.excreta_disposal }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Specific: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.specified_method_for_excreta_disposal }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Excreta Disposal is shared with other household: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.shared_with_other_household }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Household practices waste segregation: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.household_practices_waste_segregation }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is collected by city collection and disposal system: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.collected_by_city_collection_and_disposal_system }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is resycled and reused: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.recycling_and_reusing }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing biodegradables: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.disposal_of_biodegradable }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing non-biodegradables </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.disposal_of_non_biodegradable }}</p></VCol>

      </VRow>
    </VCard>
  </VDialog>

  <!-- 👉 Edit Dialog  -->
  <VDialog
    v-model="editDialog"
    max-width="600px"
  >
    <VCard>
      <VCardTitle>
        <span class="headline">Edit Item</span>
      </VCardTitle>

      <VCardText>
        <VContainer>
          <VRow>
          </VRow>
        </VContainer>
      </VCardText>

      <VCardActions>
        <VSpacer />

        <VBtn
          color="error"
          variant="outlined"
          @click="close"
        >
          Cancel
        </VBtn>

        <VBtn
          color="success"
          variant="elevated"
          @click="save"
        >
          Save
        </VBtn>
      </VCardActions>
    </VCard>
  </VDialog>

  <!-- 👉 Delete Dialog  -->
  <VDialog
    v-model="deleteDialog"
    max-width="500px"
  >
    <VCard>
      <VCardTitle>
        Are you sure you want to delete this item?
      </VCardTitle>

      <VCardActions>
        <VSpacer />

        <VBtn
          color="error"
          variant="outlined"
          @click="closeDelete"
        >
          Cancel
        </VBtn>

        <VBtn
          color="success"
          variant="elevated"
          @click="deleteItemConfirm"
        >
          OK
        </VBtn>

        <VSpacer />
      </VCardActions>
    </VCard>
  </VDialog>
</template>
