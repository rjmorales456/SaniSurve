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
  date_encoded: '',
  owner_firstname: "",
  owner_surname: "",
  establishment_name: '',
  sitio: '',
  barangay: '',
  personnel_count: '',
  sanitary_permit_number: '',
  inspected: '',
  recommendation: ''
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



const isAddNewUserDrawerVisible = ref(false)



</script>

<template>
  <section>
    <VCard
      title="Establishment Sanitation Permit"
      class="mb-6"
    >

      <VDivider />

      <VCardText class="d-flex flex-wrap gap-4">
        <!-- 👉 Export button -->
        <VSelect
          v-model="selectedBarangay"
          label="Select Barangay"
          placeholder="Select Barangay"
          :items="barangayList"
          density="compact"
          clearable
          clear-icon="ri-close-line"
        />
        <VSpacer />
        <div class="app-user-search-filter d-flex align-center">
          <!-- 👉 Search  -->
          <VTextField
            v-model="searchQuery"
            placeholder="Search"
            density="compact"
            class="me-4"
          />
          <!-- 👉 Add user button -->
          <VBtn @click="isAddNewUserDrawerVisible = true">
            Add New User
          </VBtn>
        </div>
      </VCardText>

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
