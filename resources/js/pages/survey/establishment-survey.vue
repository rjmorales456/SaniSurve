

<script setup>
 
import axios from 'axios';

const iNotify = ref(false)
const notifMessage = ref('')

const refForm = ref() // Form Reference
const date = ref() // Date
const surname = ref() // Surname of the Owner
const firstName = ref() // First Name of the Owner
const sitio = ref() // Name of Sitio
const barangay = ref() // Name of Barangay
const establishment = ref() // Name of the establishment
const numPersonnel = ref() // Number of Personnel
const sanitaryPermit = ref() // Sanitary PermitNumber
const isInspected = ref() // Was inspected?
const recomendation = ref() // Recomendation: to be filled by sanitation inspector

const onSubmit = async () => {
  refForm.value?.validate().then(async ({ valid }) => {
    if (valid) {

      const data = {
      date_encoded: date.value,
      owner_surname: surname.value,
      owner_firstname: firstName.value,
      sitio: sitio.value,
      barangay: barangay.value,
      establishment_name: establishment.value,
      personnel_count: numPersonnel.value,
      sanitary_permit_number: sanitaryPermit.value,
      inspected: isInspected.value,
      recommendation: recomendation.value
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

  <VSnackbar
      v-model="iNotify"
      location="top"
    >
      {{ notifMessage }}
  </VSnackbar>

  
  <VCard class="pa-10">
    <VForm 
      ref = "refForm"
      @submit.prevent=(onSubmit)
    > 
      <VRow>
        <VCol 
          cols = '12'
          md = '12'      
        >
          <h1>Establishment Sanitary Form</h1>
        </VCol>

        <VDivider class="my-2 mx-3" />

        <!-- Date Picker -->
        <VCol 
          cols = "12"
          md = "12"
        >
          <AppDateTimePicker
            v-model="date"
            label="Date"
            placeholder="Select date"
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- First Name-->
        <VCol
          cols="12"
          md="12"
        >
          <VTextField
            v-model="firstName"
            label="First Name of the Owner"
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- Surname-->
        <VCol
          cols="12"
          md="12"
        >
          <VTextField
            v-model="surname"
            label="Surname of the Owner"
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- Name of Establishment -->
        <VCol
          cols="12"
          md="12"
        >
          <VTextField
            v-model="establishment"
            label="Name of the Establishment"
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- Name of Sitio -->
        <VCol
          cols="12"
          md="12"
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
          md="12"
        >
          <VAutocomplete
            label="Barangay"
            :items="barangayList"
            placeholder="Select Barangay"
            v-model = barangay
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- Number of Personnel -->
        <VCol
          cols="12"
          md="12"
        >
          <VTextField
            v-model="numPersonnel"
            label="Number of Personnel"
            :rules="[requiredValidator, integerValidator]"
          />
        </VCol>

        <!-- Sanitary Permit Number -->
        <VCol
          cols="12"
          md="12"
        >
          <VTextField
            v-model="sanitaryPermit"
            label="Sanitary Permit"
            :rules="[requiredValidator]"
          />
        </VCol>

        <!-- Has the Establishment been Inspected? -->
        <VCol
          cols="12"
          md="12"
          class="demo-space-x"
        >
          <p class="text-body-1">
            Has the establishment been inspected?
          </p>

          <VSpacer/>

          <div class="">
            <VRadioGroup 
              v-model="isInspected" 
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

        <!-- Recomendation -->
        <VCol
          cols="12"
          md="12"
        >
          <VTextarea
            v-model="recomendation"
            label="Recomendation (for Sanitation Inspector Only)"
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
</template>
