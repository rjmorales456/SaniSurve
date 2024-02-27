<script setup>

import axios from 'axios';
import { ref, watch } from 'vue';

import AddEstablishmentSurveyDialog from '@/views/establishment/AddEstablishmentSurveyDialog.vue';
import DeleteEstablishmentDialog from '@/views/establishment/DeleteEstablishmentDialog.vue';
import EditEstablishmentDialog from '@/views/establishment/EditEstablishmentDialog.vue';
import ViewEstablishmentDialog from '@/views/establishment/ViewEstablishmentDialog.vue';

const data = ref({})

const getData = async () => {
  try {
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
  } catch (error) {
    console.error("Error:",error)
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

const selectedBarangay = ref()
const searchQuery = ref()

const filteredItems = ref(data.value)

// Filter Logic
watch([selectedBarangay],() => {
  filteredItems.value = data.value.filter(
    item => {
      if (!selectedBarangay) {
        return true
      } else {
        return item.barangay === selectedBarangay.value
      }
    }
  )
})

// Search Logic
watch([searchQuery], () => {
  selectedBarangay.value = null

  filteredItems.value = data.value.filter(
    item => {
      if (!searchQuery.value) {
        return true
      } else {
        return item.owner_firstname.toLowerCase().includes(searchQuery.value.toLowerCase()) || item.owner_surname.toLowerCase().includes(searchQuery.value.toLowerCase()) || item.establishment_name.toLowerCase().includes(searchQuery.value.toLowerCase()) 
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

// Dialog States
const viewDialog = ref(false)
const editDialog = ref(false)
const deleteDialog = ref(false)

const selectedItem = ref({})
const selectedItemIndex = ref(-1)
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
    <VCard
      title="Establishment Sanitation Permit"
      class="mb-6"
    >

      <VDivider />

      <VCardText class="d-flex flex-wrap gap-4">
        <VRow>
          <!-- Filter -->
          <VCol 
            cols="12"
            md="6"  
          >
            <VSelect
              v-model="selectedBarangay"
              label="Select Barangay"
              placeholder="Select Barangay"
              :items="barangayList"
              density="compact"
              clearable
              clear-icon="ri-close-line"
            />
          </VCol>

          <VCol 
            cols="12"
            md="6"  
          >
            <div class="d-flex align-center">
              <VTextField
                v-model="searchQuery"
                placeholder="Search"
                density="compact"
                class="me-4"
              />
              
              <AddEstablishmentSurveyDialog 
                :data="data"
              />
            </div>
          </VCol>
        </VRow>
      </VCardText>

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

  <!--View Dialog-->
  <VDialog
    v-model="viewDialog"
    class="v-dialog-sm"
  >
    <!-- Dialog Content -->
    <ViewEstablishmentDialog
      :item="selectedItem" 
      @close="onClose"
    />
  </VDialog>

  <!--Edit Dialog-->
  <VDialog
    v-model="editDialog"
    max-width="600px"
  >
    <!-- Dialog Content -->
    <EditEstablishmentDialog
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
    <DeleteEstablishmentDialog
      :data="filteredItems"
      :item="selectedItem"
      :itemIndex="selectedItemIndex" 
      @close="onClose"
    />
  </VDialog>

</template>

<style lang="scss">

.text-capitalize {
  text-transform: capitalize;
}

.user-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity));
}
</style>
