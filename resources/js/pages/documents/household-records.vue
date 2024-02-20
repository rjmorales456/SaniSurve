<script setup>

import axios from 'axios';
import { ref } from 'vue';

const data = ref({})

const viewDialog = ref(false)
const editDialog = ref(false)
const deleteDialog = ref(false)

await axios.get('/api/sanitation-surveys')
  .then(response => {
      // Handle success response
      data.value = response.data
      console.log(data.value)
  })
  .catch(error => {
      // Handle error response
      console.error('Error fetching data:', error);
  });

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
  specified_method_for_excreta_disposal: ''
})

const refForm = ref()
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
  await axios.post('/api/deleteHouseholdSurveyRecord', {id: editedItem.value.id})
  closeDelete()
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

const ownershipType = [
  'Owned', 'Informal Settler', 'Rent', 'Tenant'
]

const waterTypes = [
  'Level I', 'Level II', 'Level III', 'Doubtful'
]

const waterAccess = [
  'Individual Connection', 'Private', 'Shared'
]

const waterKinds = [
  'Bored/Drilled Well', 'Dug Well', 'Surfaced Water', 'Water & Sewerage System (Prime Water)', 'Spring'
]

const wellDepth= [
  'Deep Well (more than 100 meters)', 'Shallow Well (less than 100 metes)'
]

const wellConstructions = [
  '1 Year', '2 - 5 Years', 'Above 5 Years'
]

const disposalTypes = [
  'Sanitary', 'Unsanitary', 'Without Toilet'
]

const isSanitary = [
  'Connected to serwer system',
  'Ventilated improved pit latrine',
  'With Septic Tank',
  'Water sealed with other containment'
]

const isUnsanitary = [
  'Open Pit Latrine',
  'Overhung Latrine',
  'Water sealed connected to open drainage'
]

const isWithoutToilet = [
'Open Defecation',
'Sharing (Sanitary)',
'Sharing (Unsanitary)'
]

const disposalBio = [
  'Burning', 'Burying', 'Open Dumping', 'Composting'
]

const disposalNonBio = [
  'Burning', 'Burying', 'Open Dumping', 'Collection'
]

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
        <VCol cols="12" md="6"><p>{{ JSON.parse(viewItem.specified_method_for_excreta_disposal).join(', ') }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Excreta Disposal is shared with other household: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.shared_with_other_household }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Household practices waste segregation: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.household_practices_waste_segregation }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is collected by city collection and disposal system: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.collected_by_city_collection_and_disposal_system }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Waste is resycled and reused: </span></VCol>
        <VCol cols="12" md="6"><p>{{ viewItem.recycling_and_reusing }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing biodegradables: </span></VCol>
        <VCol cols="12" md="6"><p>{{ JSON.parse(viewItem.disposal_of_biodegradable).join(', ') }}</p></VCol>
        
        <VCol cols="12" md="6"><span class="font-weight-bold">Method of disposing non-biodegradables </span></VCol>
        <VCol cols="12" md="6"><p>{{ JSON.parse(viewItem.disposal_of_non_biodegradable).join(', ') }}</p></VCol>

      </VRow>
    </VCard>
  </VDialog>

  <!-- 👉 Edit Dialog  -->
  <VDialog
    v-model="editDialog"
    max-width="600px"
  >
    <VCard class="pa-5">
      <VForm 
      ref="refForm"
      @submit.prevent=(save)
      > 
        <VRow>
          <VCol 
            cols = '12'
            md = '12'      
          >
            <h1>Household Sanitation Survey</h1>
          </VCol>

          <VDivider class="my-2 mx-3" />

          <VCol 
            cols = '12'
            md = '12'      
          >
            <h3>1. Personal Information</h3>
          </VCol>

          <!-- Date Picker -->
          <VCol 
            cols = "12"
            md = "12"
          >
            <AppDateTimePicker
              v-model="editedItem.date_encoded"
              label="Date"
              placeholder="Select date"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- SurName-->
          <VCol
            cols="12"
            md="12"
          >
            <VTextField
              v-model="editedItem.surname"
              label="Surname"
              placeholder="Last Name"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- First Name -->
          <VCol
            cols="12"
            md="12"
          >
            <VTextField
              v-model="editedItem.first_name"
              label="First Name"
              placeholder="First Name"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Middle Name -->
          <VCol
            cols="12"
            md="12"
          >
            <VTextField
              v-model="editedItem.middle_name"
              label="Middle Name"
              placeholder="Middle Name"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Name of Sitio -->
          <VCol
            cols="12"
            md="12"
          >
          <VTextField
              v-model="editedItem.sitio"
              label="Name of Sitio"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Name of Barangay -->
          <VCol
            cols="12"
            md="12"
          >
            <VAutocomplete
              label="Barangay"
              :items="barangayList"
              placeholder="Select Barangay"
              v-model = "editedItem.barangay"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Ownership Type-->
          <VCol
            cols="12"
            md="12"
          >
            <VSelect
              v-model="editedItem.ownership"
              label="Ownership of House and Lot"
              :items="ownershipType"
              placeholder = "Select Ownership Type"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Number of Family -->
          <VCol
            cols="12"
            md="6"
          >
            <VTextField
              v-model="editedItem.number_of_families"
              label="Number of Family"
              placeholder="0 to 50"
              :rules="[requiredValidator, integerValidator, betweenValidator(editedItem.number_of_families, 0, 50)]"
            />
          </VCol>

          <!-- Number of Occupants -->
          <VCol
            cols="12"
            md="6"
          >
            <VTextField
              v-model="editedItem.number_of_occupants"
              label="Number of Occupants"
              placeholder="0 - 100"
              :rules="[requiredValidator, integerValidator, betweenValidator(editedItem.number_of_occupants, 0, 100)]"
            />
          </VCol>

          <VCol 
            cols = '12'
            md = '12'      
          >
            <h3>2. Water Source</h3>
          </VCol>

          <!-- Type of Water Source -->
          <VCol
            cols="12"
            md="12"
          >
            <VSelect
              label="Type of Water Source"
              :items="waterTypes"
              v-model = "editedItem.type_of_water_source"
              placeholder = "Select Water Source Type"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Accessibility to Water Source -->
          <VCol
            cols="12"
            md="12"
          >
            <VSelect
              label="Accessibility to Water Source"
              :items="waterAccess"
              v-model = "editedItem.accessibility_to_water_source"
              placeholder = "Select Water Source Accessibility"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Kind of Water Source -->
          <VCol
            cols="12"
            md="12"
          >
            <VSelect
              label="Kind of Water Source"
              :items="waterKinds"
              v-model = "editedItem.kind_of_water_source"
              placeholder = "Select Kind of Water Source"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Depth of Well -->
          <VCol
            cols="12"
            md="6"
            v-if = "editedItem.kind_of_water_source == 'Bored/Drilled Well'"
          >
            <VSelect
              label="Depth of Well"
              :items="wellDepth"
              placeholder="Select Well Depth"
              v-model = "editedItem.depth"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Year Contructed-->
          <VCol
            cols="12"
            md="6"
            v-if = "editedItem.kind_of_water_source == 'Bored/Drilled Well'"
          >
            <VSelect
              label="Year Contructed of Well"
              :items="wellConstructions"
              placeholder="Select Year Constructed"
              v-model = "editedItem.years_constructed"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol 
            cols = '12'
            md = '12'      
          >
            <h3>3. Waste Disposal</h3>
          </VCol>

          <!-- Excreta Disposal -->
          <VCol
            cols="12"
            md="12"
          >
            <VSelect
              label="Excreta Disposal Method"
              :items= "disposalTypes"
              placeholder="Select Method"
              v-model = "editedItem.excreta_disposal"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Specify -->
          <VCol
            cols="12"
            md="12"
          >

            <div class="demo-space-y">
              <VCheckbox
                v-if= "editedItem.excreta_disposal == 'Sanitary'"
                v-for="item in isSanitary"
                v-model="editedItem.specified_method_for_excreta_disposal"
                :label="item" 
                :value="item"  
              />

              <VCheckbox
              v-if= "editedItem.excreta_disposal == 'Unsanitary'"
                v-for="item in isUnsanitary"
                v-model="editedItem.specified_method_for_excreta_disposal"
                :label="item" 
                :value="item"  
              />

              <VCheckbox
              v-if= "editedItem.excreta_disposal == 'Without Toilet'"
                v-for="item in isWithoutToilet"
                v-model="editedItem.specified_method_for_excreta_disposal"
                :label="item" 
                :value="item"  
              />
              
            </div>
          </VCol>

          <!-- Shared with other Household -->
          <VCol
            cols="12"
            md="6"
          >
            <p class="text-body-1">
              Are the excreta disposal facilities shared with other households?
            </p>

            <div class="">
              <VRadioGroup 
                v-model="editedItem.shared_with_other_household" 
                inline
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Yes`"
                  :value="`Yes`"
                />
                <VRadio
                  :key="2"
                  :label="`No`"
                  :value="`No`"
                />
              </VRadioGroup>
            </div>
          </VCol>

          <!-- Household is practicing waste segregation -->
          <VCol
            cols="12"
            md="12"
          >

            <p class="text-body-1">
              Does the household practice waste segregation?
            </p>

            <div class="">
              <VRadioGroup 
                v-model="editedItem.household_practices_waste_segregation" 
                inline
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Yes`"
                  :value="`Yes`"
                />
                <VRadio
                  :key="2"
                  :label="`No`"
                  :value="`No`"
                />
              </VRadioGroup>
            </div>

          </VCol>

          <!-- Collected by City Collection and Disposal System -->
          <VCol
            cols="12"
            md="12"
          >

            <p class="text-body-1">
              Is the waste collected by city collection and disposal system?
            </p>

            <div class="">
              <VRadioGroup 
                v-model="editedItem.collected_by_city_collection_and_disposal_system" 
                inline
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Yes`"
                  :value="`Yes`"
                />
                <VRadio
                  :key="2"
                  :label="`No`"
                  :value="`No`"
                />
              </VRadioGroup>
            </div>

          </VCol>

          <!-- Recycling and Reuse -->
          <VCol
            cols="12"
            md="12"
          >

            <p class="text-body-1">
              Does the household practice recycling and reuse?
            </p>

            <div class="">
              <VRadioGroup 
                v-model="editedItem.recycling_and_reusing" 
                inline
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Yes`"
                  :value="`Yes`"
                />
                <VRadio
                  :key="2"
                  :label="`No`"
                  :value="`No`"
                />
              </VRadioGroup>
            </div>
          </VCol>

          <!-- Disposal of Biodegradable -->
          <VCol
            cols="12"
            md="6"
          >
            <VSelect
              v-model="editedItem.disposal_of_biodegradable"
              :items="disposalBio"
              :menu-props="{ maxHeight: '400' }"
              label="Disposal of Biodegradable"
              multiple
              persistent-hint
              placeholder="Select Method"
              :rules="[requiredValidator]"
            />
          </VCol>

          <!-- Disposal of Non-Biodegradable -->
          <VCol
            cols="12"
            md="6"
          >

            <VSelect
              v-model="editedItem.disposal_of_non_biodegradable"
              :items="disposalNonBio"
              :menu-props="{ maxHeight: '400' }"
              label="Disposal of Non-Biodegradable"
              multiple
              persistent-hint
              placeholder="Select Method"
              :rules="[requiredValidator]"
            />
            
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4"
          >
            <VBtn type="submit">
              Submit
            </VBtn>

            <VBtn
              @click="close"
              color="secondary"
              variant="tonal"
            >
              Cancel
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
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
