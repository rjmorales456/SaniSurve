

<script setup>

import axios from 'axios';
import { watch } from 'vue';

// Get Item as Props
const props = defineProps({
  data: Object
});

const table = props.data

const addSurveyDialog = ref(false)

const onAddSurvey = () => {
  addSurveyDialog.value = true
}

const iNotify = ref(false)
const notifMessage = ref('')

const refForm = ref() // Form Reference
const date = ref() // Date of Inspection
const time = ref() // Time of Inspection
const surname = ref() // Surname of the Owner
const firstName = ref() // First Name of the Owner
const sitio = ref() // Name of Sitio
const barangay = ref() // Name of Barangay
const establishment = ref() // Name of the establishment
const numPersonnel = ref(0) // Total Personnel
const numMale = ref(0) // Number of Male Personnel
const numFemale = ref(0) // Number of Female Personnel
const sanitaryPermit = ref() // Sanitary PermitNumber
const typePermit = ref() // Where New or Renewal
const toiletProvision = ref() // Toilet Provision
const wasteManagement = ref() // Solid Waste Management
const waterSupply = ref() // Water Supply
const isInspected = ref() //Is inspected?
const remarks = ref() // Remarks

import { defineEmits } from 'vue';

// Define the emit function for "close-dialog" event
const emit = defineEmits(['close-dialog']);

// Method to emit the event
const closeDialog = () => {
  emit('close-dialog')
  console.log('close');;
};

watch([numMale, numFemale], () => {
  const maleCount = parseInt(numMale.value, 10) || 0; // Parsing as integer with base 10
  const femaleCount = parseInt(numFemale.value, 10) || 0; // Parsing as integer with base 10
  
  numPersonnel.value = maleCount + femaleCount;
});



const onSubmit = async () => {
  refForm.value?.validate().then(async ({ valid }) => {
    const maleCount = parseInt(numMale.value, 10) || 0; // Parsing as integer with base 10
    const femaleCount = parseInt(numFemale.value, 10) || 0; // Parsing as integer with base 10

    const [hours, minutes] = rawTime.split(":"); // Split the time into hours and minutes
    const formattedTime = `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`; // Format the time as HH:mm
    
    if (valid) {

      const data = {
        date_encoded: date.value,
        time_of_inspection: formattedTime,
        owner_firstname: firstName.value,
        owner_surname: surname.value,
        establishment_name: establishment.value,
        sitio: sitio.value,
        barangay: barangay.value,
        personnel_count: numPersonnel.value,
        malePersonnel_count: maleCount,
        femalePersonnel_count: femaleCount,
        permit_type: typePermit.value,
        toilet_provision: toiletProvision.value,
        solid_waste_management: wasteManagement.value,
        water_supply: waterSupply.value,
        sanitary_permit_number: sanitaryPermit.value,
        inspected: isInspected.value,
        recommendation: remarks.value
      }

      await axios.post('/api/sanitation-permit', data)
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
        Release Permit
      </VBtn>
    </template>,

    <!-- Dialog Content -->
    <VCard>
      <VForm 
        ref = "refForm"
        @submit.prevent=(onSubmit)
      > 
        <VCardText>
          <VRow>
            <VCol 
              cols = '12'
            >
              <h3 class="font-weight-medium">Establishment Sanitation Permit Form</h3>
              <DialogCloseBtn
                variant="text"
                size="default"
                @click="addSurveyDialog = false"
              />
            </VCol>
          </VRow>

          <VDivider class="my-5" />

          <VRow>
            <VCol 
              cols="6"
            >
              <AppDateTimePicker
                v-model="date"
                label="Date"
                placeholder="Select date"
                :rules="[requiredValidator]"
              />           
            </VCol>
            <VCol
              cols="6"
            >
              <AppDateTimePicker
                v-model="time"
                label="Time picker"
                placeholder="Select time"
                :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i' }"
              />
            </VCol>
          </VRow>

          <VRow>
            <VCol 
              cols="6"
            >
              <VTextField
                v-model="firstName"
                label="First Name of Owner"
                :rules="[requiredValidator]"
              />
            </VCol>
            <VCol
              cols="6"
            >
              <VTextField
                v-model="surname"
                label="Surname of Owner"
                :rules="[requiredValidator]"
              />
            </VCol>
          </VRow>

          <VRow>
            <VCol 
              cols="12"
            >
              <VTextField
                v-model="establishment"
                label="Name of Establishment"
                :rules="[requiredValidator]"
              />
            </VCol>
          </VRow>

          <VRow>
            <VCol 
              cols="6"
            >
              <VTextField
                v-model="sitio"
                label="Sitio"
                :rules="[requiredValidator]"
              />
            </VCol>
            <VCol
              cols="6"
            >
              <VAutocomplete
                label="Barangay"
                :items="barangayList"
                placeholder="Select Barangay"
                v-model = barangay
                :rules="[requiredValidator]"
              />
            </VCol>
          </VRow>

          <VRow
            class="d-flex align-center"
          >
            <VCol 
              cols="6"
            >
              <VTextField
                v-model="sanitaryPermit"
                label="Sanitary Permit Number"
                :rules="[requiredValidator]"
              />
            </VCol>
            <VCol
              cols="6"
            >
              <VRadioGroup 
                v-model="typePermit" 
                inline 
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`New`"
                  :value="`New`"
                />
                <VRadio
                  :key="2"
                  :label="`Renewal`"
                  :value="`Renewal`"
                />
              </VRadioGroup>
            </VCol>
          </VRow>

          <VRow>
            <VCol 
              cols="4"
              class="text-align-center"
            >
              <VTextField
                v-model="numMale"
                label="No. of Male Employees"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="4"
            >
             <VTextField
                v-model="numFemale"
                label="No. of Female Employees"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol 
              cols="4"
            >
              <VTextField
                v-model="numPersonnel"
                label="Total Employees"
                :rules="[requiredValidator]"
                disabled
              />
            </VCol>
          </VRow>

          <VRow
            class="d-flex align-center"
          >
            <VCol 
              cols="12"
            >
              <p class="text-body-1">
                Toilet Provision:
              </p>
              <VRadioGroup 
                v-model="toiletProvision" 
                inline 
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Sanitary`"
                  :value="`Sanitary`"
                />
                <VRadio
                  :key="2"
                  :label="`Unsanitary`"
                  :value="`Unsanitary`"
                />
              </VRadioGroup>
            </VCol>
          </VRow>

          <VRow
            class="d-flex align-center"
          >
            <VCol 
              cols="12"
            >
              <p class="text-body-1">
                Solit Waste Management:
              </p>
              <VRadioGroup 
                v-model="wasteManagement" 
                inline 
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Segregated`"
                  :value="`Segregated`"
                />
                <VRadio
                  :key="2"
                  :label="`Not Segregated`"
                  :value="`Not Segregated`"
                />
              </VRadioGroup>
            </VCol>
          </VRow>

          <VRow>
            <VCol 
              cols="12"
            >
              <p class="text-body-1">
                Water Supply:
              </p>
              <VRadioGroup 
                v-model="waterSupply" 
                inline 
                :rules="[requiredValidator]"
              >
                <VRadio
                  :key="1"
                  :label="`Access to Safe Water`"
                  :value="`Access to Safe Water`"
                />
                <VRadio
                  :key="2"
                  :label="`No Access to Safe Water`"
                  :value="`No Access to Safe Water`"
                />
              </VRadioGroup>
            </VCol>
          </VRow>
          
          
          <VRow>
            <VCol
              cols="12"
            >
              <p class="text-body-1">
                Has the establishment been inspected?
              </p>

              <VSpacer/>

              <VRadioGroup 
                v-model= "isInspected" 
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
            </VCol>  
          </VRow>


          <VRow>
            <VCol
              cols="12"
            >
              <VTextarea
                label="Remarks"
                placeholder="Remarks"
                v-model="remarks"
              />
            </VCol>
          </VRow>
          <VRow>
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
        </VCardText>
      </VForm>
    </VCard>
  </VDialog>
</template>
