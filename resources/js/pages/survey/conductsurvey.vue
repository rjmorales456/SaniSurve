

<script setup>

//import axios from 'axios';

const onSubmit = () => {
  /*
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
        depth: wellDepth.value,
        years_constructed: wellConstructions.value,
        specified_method_for_excreta_disposal: specifiedMethod.value,

        // Add other fields as needed
    
    };

    axios.post('/api/sanitation-surveys', data)
        .then(response => {
            // Handle success response
            console.log(response.data.message);
        })
        .catch(error => {
            // Handle error response
            console.error('Error storing data:', error.response.data);
        });
        */
};


const date = ref() //
const surname = ref() //
const firstName = ref() //
const middleName = ref() //
const sitio = ref() //
const barangay = ref() //
const ownership = ref() //
const numOccupants = ref() //
const numFamily = ref() //
const typeWater = ref()
const accessWater = ref()
const kindWater = ref()
const typeWell = ref()
const yearWell = ref()
const excretaDisposal = ref()
const specifiedMethod = ref()
const isShared = ref()
const isSegregated = ref()
const isCollected = ref()
const disposeBio = ref()
const disposeNonBio = ref()
const isRecycled = ref()

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
  'Depth Well (more than 100 meters)', 'Shallow Well (less than 100 metes)'
]

const wellConstructions = [
  '1 Year', '2 - 5 Years', 'Above 5 Years'
]

const disposalTypes = [
  'Sanitary', 'Unsanitary', 'Without Toilet'
]

const specify = []

if (excretaDisposal == 'Sanitary') {
  specify = [
    'Connected to serwer system',
    'Ventilated improved pit latrine',
    'With Septic Tank',
    'Water sealed with other containment'
  ]
}
else if (excretaDisposal == 'Unsanitary') {
  specify = [
    'Open Pit Latrine',
    'Overhung Latrine',
    'Water sealed connected to open drainage'
  ]
}
else if (excretaDisposal == 'Without Toilet') {
  specify = [
  'Open Defecation',
  'Sharing (Sanitary)',
  'Sharing (Unsanitary)'
  ]
}

const yesorNo = [
  'Yes', 'No'
]

const disposalMethods = [
  'Burning', 'Burying', 'Open Dumping', 'Collection'
]

</script>

<template>
  <div>
    <VCard class='pa-5'>
      <VForm @submit.prevent=(onSubmit)> 
        <VRow>
          <VCol 
            cols = '12'
            md = '12'      
          >
            <h1>Sanitation Survey Form</h1>
          </VCol>
          <!-- Date Picker -->
          <VCol 
            cols = "12"
            md = "12"
          >
            <AppDateTimePicker
              v-model="date"
              label="Date"
              placeholder="Select date"
            />
          </VCol>

          <!-- SurName-->
          <VCol
            cols="12"
            md="4"
          >
            <VTextField
              v-model="surname"
              label="Surname"
              placeholder="Last Name"
            />
          </VCol>

          <!-- First Name -->
          <VCol
            cols="12"
            md="4"
          >
            <VTextField
              v-model="firstName"
              label="First Name"
              placeholder="First Name"
            />
          </VCol>

          <!-- Middle Name -->
          <VCol
            cols="12"
            md="4"
          >
            <VTextField
              v-model="middleName"
              label="Middle Name"
              placeholder="Middle Name"
            />
          </VCol>

          <!-- Name of Sitio -->
          <VCol
            cols="12"
            md="6"
          >
            <VTextField
              v-model="sitio"
              label="Name of Sitio"
            />
          </VCol>

          <!-- Name of Barangay -->
          <VCol
            cols="12"
            md="6"
          >
            <VAutocomplete
              label="Barangay"
              :items="barangayList"
              placeholder="Select Barangay"
              v-model = barangay
            />
          </VCol>

          <!-- Ownership Type-->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              v-model="ownership"
              label="Ownership of House and Lot"
              :items="ownershipType"
              placeholder = "Select Ownership Type"
            />
          </VCol>

          <!-- Number of Family -->
          <VCol
            cols="12"
            md="4"
          >
            <VTextField
              v-model="numFamily"
              label="Number of Family"
              placeholder="0 to 50"
            />
          </VCol>

          <!-- Number of Occupants -->
          <VCol
            cols="12"
            md="4"
          >
            <VTextField
              v-model="numOccupants"
              label="Number of Occupants"
              placeholder="0 - 100"
            />
          </VCol>

          <!-- Type of Water Source -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Type of Water Source"
              :items="waterTypes"
              v-model = typeWater
              placeholder = "Select Water Source Type"
            />
          </VCol>

          <!-- Accessibility to Water Source -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Accessibility to Water Source"
              :items="waterAccess"
              v-model = accessWater
              placeholder = "Select Water Source Accessibility"
            />
          </VCol>

          <!-- Kind of Water Source -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Kind of Water Source"
              :items="waterKinds"
              v-model = kindWater
              placeholder = "Select Kind of Water Source"
            />
          </VCol>

          <!-- Depth of Well -->
          <VCol
            cols="12"
            md="6"
            v-if = "kindWater == 'Bored/Drilled Well'"
          >
            <VSelect
              label="Depth of Well"
              :items="wellDepth"
              placeholder="Select Well Depth"
              v-model = typeWell
            />
          </VCol>

          <!-- Year Contructed-->
          <VCol
            cols="12"
            md="6"
            v-if = "kindWater == 'Bored/Drilled Well'"
          >
            <VSelect
              label="Year Contructed of Well"
              :items="wellConstructions"
              placeholder="Select Year Constructed"
              v-model = yearWell
            />
          </VCol>

          <!-- Excreta Disposal -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Excreta Disposal Method"
              :items= "disposalTypes"
              placeholder="Select Method"
              v-model = excretaDisposal
            />
          </VCol>

          <!-- Specify -->
          <VCol
            cols="12"
            md="8"
          >
            <VSelect
              label="Specify Specific Method"
              :items='specify'
              placeholder="Select Year Constructed"
              v-model = specifiedMethod
            />
          </VCol>

          <!-- Shared with other Household -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Shared with other Household"
              :items= "yesorNo"
              placeholder="Select Answer"
              v-model = isShared
            />
          </VCol>

          <!-- Household is practicing waste segregation -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Household is practicing waste segregation"
              :items= "yesorNo"
              placeholder="Select Answer"
              v-model = isSegregated
            />
          </VCol>

          <!-- Collected by City Collection and Disposal System -->
          <VCol
            cols="12"
            md="4"
          >
            <VSelect
              label="Collected by City Collection and Disposal System"
              :items= "yesorNo"
              placeholder="Select Answer"
              v-model = isCollected
            />
          </VCol>

          <!-- Disposal of Biodegradable -->
          <VCol
            cols="12"
            md="5"
          >
            <VSelect
              label="Disposal of Biodegradable"
              :items= "disposalMethods"
              placeholder="Select Method of Disposal"
              v-model = disposeBio
            />
          </VCol>

          <!-- Disposal of Non-Biodegradable -->
          <VCol
            cols="12"
            md="5"
          >
            <VSelect
              label="Disposal of Non-Biodegradable"
              :items= "disposalMethods"
              placeholder="Select Method of Disposal"
              v-model = disposeNonBio
            />
          </VCol>

          <!-- Recycling and Reuse -->
          <VCol
            cols="12"
            md="2"
          >
            <VSelect
              label="Recycling and Reuse"
              :items= "yesorNo"
              placeholder="Select Answer"
              v-model = isRecycled
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
              type="reset"
              color="secondary"
              variant="tonal"
            >
              Reset
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCard>
  </div>
</template>
