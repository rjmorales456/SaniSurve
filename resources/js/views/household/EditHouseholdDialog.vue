<script setup>
import axios from 'axios';

// Get Item as Props
const props = defineProps({
  data: Object,
  item: Object,
  itemIndex: Number
});

const data = props.data
const editedItem = props.item // Set props as item
const index = props.itemIndex

// Emit Close Function
const emit = defineEmits()

const onClose = () => {
  emit('close')
}

const onSave = async () => {
  try {
    await axios.put(`/api/sanitation-surveys/${editedItem.id}`, editedItem);
    Object.assign(data[index], editedItem)
    // Optionally handle success, e.g., show a success message
    console.log('Item updated successfully');
    onClose()
  } catch (error) {
    console.error('Error updating item:', error);
    // Optionally handle errors, e.g., show an error message
  }
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
  'Connected to Sewer System',
  'Ventilated Improved Pit Latrine',
  'With Septic Tank',
  'Water Sealed With Other Containment'
]

const isUnsanitary = [
  'Open Pit Latrine',
  'Overhung Latrine',
  'Water Sealed Connected to Open Drainage'
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
  <VCard>
    <VForm 
      ref="refForm"
      @submit.prevent=(onSave)
    > 
      <VRow>
        <VCardText>
          <VCol 
            cols = '12'
            md = '12'      
          >
            <h3 class="font-weight-medium">Edit Record</h3>
            <DialogCloseBtn
              variant="text"
              size="default"
              @click="onClose"
            />
          </VCol>

          <VDivider class="my-2 mx-3" />

          <VCol 
            cols = '12'
            md = '12'      
          >
            <span class="font-weight-medium">1. Personal Information</span>
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
            <span class="font-weight-medium">2. Water Source</span>
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
            <span class="font-weight-medium">3. Waste Disposal</span>
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
            <VBtn 
            type="submit">
              Save
            </VBtn>

            <VBtn
              @click="onClose"
              color="secondary"
              variant="tonal"
            >
              Cancel
            </VBtn>
          </VCol>
        </VCardText>
      </VRow>
    </VForm>
  </VCard>
</template>

