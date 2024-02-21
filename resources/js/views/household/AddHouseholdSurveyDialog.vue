

<script setup>

import axios from 'axios';
import { watch } from 'vue';

const addSurveyDialog = ref(false)

const onAddSurvey = () => {
  addSurveyDialog.value = true
}

const iNotify = ref(false)
const notifMessage = ref('')

const refForm = ref() // Form Reference
const date = ref('') // Date
const surname = ref('') // Surname
const firstName = ref('') // First Name
const middleName = ref('') // Middle Name
const sitio = ref('') // Name of Sitio
const barangay = ref() // Name of Barangay
const ownership = ref() // Type of Ownership
const numOccupants = ref() // Number of Occupants
const numFamily = ref() // Number of Family
const typeWater = ref() // Type of Water Source
const accessWater = ref() // Accessibility to Water
const kindWater = ref() // King of Water
const typeWell = ref() // Depth of Well
const yearWell = ref() // Year the Well was Constructed
const excretaDisposal = ref() // Type of Excrete Disposal
const specifiedMethod = ref([])
const isShared = ref() // Whether Facility is shared
const isSegregated = ref() // Wether waste is segregated
const isCollected = ref() // Wether waste is collected
const disposeBio = ref([]) // How biodegradables are disposed
const disposeNonBio = ref([]) // How non-biodegradables are disposed
const isRecycled = ref() // Where waste is recycled/reused

import { defineEmits } from 'vue';

// Define the emit function for "close-dialog" event
const emit = defineEmits(['close-dialog']);

// Method to emit the event
const closeDialog = () => {
  emit('close-dialog')
  console.log('close');;
};

watch(excretaDisposal, () => {
  specifiedMethod.value = []
})

watch(kindWater, () => {
  typeWell.value = null
  yearWell.value = null
})

const onSubmit = async () => {

  refForm.value?.validate().then(async ({ valid }) => {
    if (valid) {

      const data = {
      date_encoded: date.value,
      surname: surname.value,
      first_name: firstName.value,
      middle_name: middleName.value,
      sitio: sitio.value,
      barangay: barangay.value,
      ownership: ownership.value,
      number_of_occupants: numOccupants.value,
      number_of_families: numFamily.value,
      type_of_water_source: typeWater.value,
      accessibility_to_water_source: accessWater.value,
      kind_of_water_source: kindWater.value,
      excreta_disposal: excretaDisposal.value,
      shared_with_other_household: isShared.value,
      household_practices_waste_segregation: isSegregated.value,
      collected_by_city_collection_and_disposal_system: isCollected.value,
      disposal_of_biodegradable: disposeBio.value,
      disposal_of_non_biodegradable: disposeNonBio.value,
      recycling_and_reusing: isRecycled.value,
      depth: typeWell.value,
      years_constructed: yearWell.value,
      specified_method_for_excreta_disposal: specifiedMethod.value,

      // Add other fields as needed

      };

      await axios.post('/api/sanitation-surveys', data)
      .then(response => {
          // Handle success response
          notifMessage.value = response.data.message
          iNotify.value = true
      })
      .catch(error => {
          // Handle error response
          notifMessage.value = error.response.data.message
          iNotify.value = true
      });

      nextTick(() => {
        refForm.value?.reset()
        refForm.value?.resetValidation()
      })
    }
  })
};

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
  'Water Sealed with Other Containment'
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
  <VDialog
    v-model="addSurveyDialog"
    max-width="600px"
    persistent
  >
    <!-- Dialog Activator -->
    <template #activator="{ props }">
      <VBtn
        @click="onAddSurvey"
        v-bind="props"
      >
        Conduct Survey
      </VBtn>
    </template>

    <!-- Dialog Content -->
    <DialogCloseBtn
      variant="text"
      size="default"
      @click="addSurveyDialog = false"
    />
              
    <VCard>
      <VForm 
        ref="refForm"
        @submit.prevent=(onSubmit)
      > 
        
        <VRow>
          <VCardText>
            <VCol 
              cols = '12'
                    
            >
            <h3 class="font-weight-medium">Household Sanitation Survey</h3>
            </VCol>

            <VDivider class="my-2 mx-3" />

            <VCol 
              cols = '12'   
            >
            <span class="font-weight-medium">1. Personal Information</span>
            </VCol>

            <!-- Date Picker -->
            <VCol 
              cols = "12"
            >
              <AppDateTimePicker
                v-model="date"
                label="Date"
                placeholder="Select date"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- SurName-->
            <VCol
              cols="12"
            >
              <VTextField
                v-model="surname"
                label="Surname"
                placeholder="Last Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- First Name -->
            <VCol
              cols="12"
            >
              <VTextField
                v-model="firstName"
                label="First Name"
                placeholder="First Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Middle Name -->
            <VCol
              cols="12"
            >
              <VTextField
                v-model="middleName"
                label="Middle Name"
                placeholder="Middle Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Name of Sitio -->
            <VCol
              cols="12"
            >
            <VTextField
                v-model="sitio"
                label="Name of Sitio"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Name of Barangay -->
            <VCol
              cols="12"
            >
              <VAutocomplete
                label="Barangay"
                :items="barangayList"
                placeholder="Select Barangay"
                v-model = barangay
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Ownership Type-->
            <VCol
              cols="12"
            >
              <VSelect
                v-model="ownership"
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
                v-model="numFamily"
                label="Number of Family"
                placeholder="0 to 50"
                :rules="[requiredValidator, integerValidator, betweenValidator(numFamily, 0, 50)]"
              />
            </VCol>

            <!-- Number of Occupants -->
            <VCol
              cols="12"
            >
              <VTextField
                v-model="numOccupants"
                label="Number of Occupants"
                placeholder="0 - 100"
                :rules="[requiredValidator, integerValidator, betweenValidator(numOccupants, 0, 100)]"
              />
            </VCol>

            <VCol 
              cols = '12'
            >
              <span class="font-weight-medium">2. Water Source</span>
            </VCol>

            <!-- Type of Water Source -->
            <VCol
              cols="12"
            >
              <VSelect
                label="Type of Water Source"
                :items="waterTypes"
                v-model = typeWater
                placeholder = "Select Water Source Type"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Accessibility to Water Source -->
            <VCol
              cols="12"
            >
              <VSelect
                label="Accessibility to Water Source"
                :items="waterAccess"
                v-model = accessWater
                placeholder = "Select Water Source Accessibility"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Kind of Water Source -->
            <VCol
              cols="12"
            >
              <VSelect
                label="Kind of Water Source"
                :items="waterKinds"
                v-model = kindWater
                placeholder = "Select Kind of Water Source"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Depth of Well -->
            <VCol
              cols="12"
              v-if = "kindWater == 'Bored/Drilled Well'"
            >
              <VSelect
                label="Depth of Well"
                :items="wellDepth"
                placeholder="Select Well Depth"
                v-model = typeWell
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Year Contructed-->
            <VCol
              cols="12"
              v-if = "kindWater == 'Bored/Drilled Well'"
            >
              <VSelect
                label="Year Contructed of Well"
                :items="wellConstructions"
                placeholder="Select Year Constructed"
                v-model = yearWell
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol 
              cols = '12'
            >
              <span class="font-weight-medium">3. Waste Disposal</span>
            </VCol>

            <!-- Excreta Disposal -->
            <VCol
              cols="12"
            >
              <VSelect
                label="Excreta Disposal Method"
                :items= "disposalTypes"
                placeholder="Select Method"
                v-model = excretaDisposal
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- Specify -->
            <VCol
              cols="12"
            >

              <div class="demo-space-y">
                <VCheckbox
                  v-if= "excretaDisposal == 'Sanitary'"
                  v-for="item in isSanitary"
                  v-model="specifiedMethod"
                  :label="item" 
                  :value="item"  
                />

                <VCheckbox
                v-if= "excretaDisposal == 'Unsanitary'"
                  v-for="item in isUnsanitary"
                  v-model="specifiedMethod"
                  :label="item" 
                  :value="item"  
                />

                <VCheckbox
                v-if= "excretaDisposal == 'Without Toilet'"
                  v-for="item in isWithoutToilet"
                  v-model="specifiedMethod"
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
                  v-model="isShared" 
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
            >

              <p class="text-body-1">
                Does the household practice waste segregation?
              </p>

              <div class="">
                <VRadioGroup 
                  v-model="isSegregated" 
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
            >

              <p class="text-body-1">
                Is the waste collected by city collection and disposal system?
              </p>

              <div class="">
                <VRadioGroup 
                  v-model="isCollected" 
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
            >

              <p class="text-body-1">
                Does the household practice recycling and reuse?
              </p>

              <div class="">
                <VRadioGroup 
                  v-model="isRecycled" 
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
                v-model="disposeBio"
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
                v-model="disposeNonBio"
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
              color="primary"
              cols="12"
              class="d-flex align-center"
            >
              <VBtn type="submit" class="mr-5">
                Submit
              </VBtn>

              <VBtn
                type="reset"
                color="secondary"
                variant="tonal"
                @click="closeDialog"
              >
                Reset
              </VBtn>

            </VCol>     
          </VCardText>                    
        </VRow>
      </VForm>
    </VCard>
  </VDialog>
</template>
