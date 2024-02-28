<script setup>


// Get Item as Props
const props = defineProps({
  data: Object,
  item: Object,
  itemIndex: Number
});

const data = props.data
const editedItem = props.item // Set props as item
const index = props.itemIndex

console.log(editedItem)

// Emit Close Function
const emit = defineEmits()

const onClose = () => {
  emit('close')
}

const onSubmit = async () => {
  
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
              @click="onClose"
            />
          </VCol>
        </VRow>

        <VDivider class="my-5" />

        <VRow>
          <VCol 
            cols="6"
          >
            <AppDateTimePicker
              v-model="editedItem.date_encoded"
              label="Date"
              placeholder="Select date"
              :rules="[requiredValidator]"
            />           
          </VCol>
          <VCol
            cols="6"
          >
            <AppDateTimePicker
              v-model="editedItem.time_of_inspection"
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
              v-model="editedItem.owner_firstname"
              label="First Name of Owner"
              :rules="[requiredValidator]"
            />
          </VCol>
          <VCol
            cols="6"
          >
            <VTextField
              v-model="editedItem.owner_surname"
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
              v-model="editedItem.establishment_name"
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
              v-model="editedItem.sitio"
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
              v-model = "editedItem.barangay"
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
              v-model="editedItem.sanitary_permit_number"
              label="Sanitary Permit Number"
              :rules="[requiredValidator]"
            />
          </VCol>
          <VCol
            cols="6"
          >
            <VRadioGroup 
              v-model="editedItem.permit_type" 
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
              v-model="editedItem.malePersonnel_count"
              label="No. of Male Employees"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol
            cols="4"
          >
            <VTextField
              v-model="editedItem.femalePersonnel_count"
              label="No. of Female Employees"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol 
            cols="4"
          >
            <VTextField
              v-model="editedItem.personnel_count"
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
              v-model="editedItem.toilet_provision" 
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
              v-model="editedItem.solid_waste_management" 
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
              v-model="editedItem.water_supply" 
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
              v-model= "editedItem.inspected" 
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
              v-model="editedItem.recommendation"
            />
          </VCol>
        </VRow>
        <VRow>
          <VCol
          cols="12"
          class="d-flex gap-4"
          >
            <VBtn type="submit">
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
        </VRow>
      </VCardText>
    </VForm>
  </VCard>
</template>
