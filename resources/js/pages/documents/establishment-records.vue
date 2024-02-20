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

const deleteItemConfirm = async () => {
  // Delete Function Here
  await axios.post('/api/deleteEstablishmentSurveyRecord', {id: editedItem.value.id})
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
          <h1>Permit Record</h1>
          <DialogCloseBtn
            variant="text"
            size="default"
            @click="viewDialog = false"
          />
        </VCol>
        
        <VDivider class="my-2 mx-3" />
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Date: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.date_encoded }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Owner Name: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.owner_surname }}, {{ viewItem.owner_firstname }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Establishment Name:  </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.establishment_name }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Name of Sitio </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.sitio }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Barangay </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem. barangay }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Number of Personnel:  </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.personnel_count }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Sanitary Permit Number: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.sanitary_permit_number }}</p></VCol>

        <VCol cols="12" md="6"><span class="font-weight-bold">Inspected: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.inspected }}</p></VCol>

        <VCol cols="12" md="12"><span class="font-weight-bold">Recommendations: </span></VCol>
        <VCol cols="12" md="12"><p>{{ viewItem.recommendation }}</p></VCol>
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
