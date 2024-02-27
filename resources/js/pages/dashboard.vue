<script setup>
import ExcretaDisposalFacility from '@/views/dashboard/admin/ExcretaDisposalFacility.vue';
import PropertyOwnership from '@/views/dashboard/admin/PropertyOwnership.vue';
import RecyclePractice from '@/views/dashboard/admin/RecyclePractice.vue';
import TypeofWaterSource from '@/views/dashboard/admin/TypeofWaterSource.vue';
import UserRegistration from '@/views/dashboard/admin/UserRegistration.vue';
import VariableOutput from '@/views/dashboard/admin/VariableOutput.vue';
import WasteCollected from '@/views/dashboard/admin/WasteCollected.vue';
import WasteSegregation from '@/views/dashboard/admin/WasteSegregation.vue';

import AccesstoWaterSource from '@/views/dashboard/admin/AccesstoWaterSource.vue';

import KindofWaterSource from '@/views/dashboard/admin/KindofWaterSource.vue';

import { ref } from 'vue';


const data = ref({})
// Get all household survey records
const getData = async () => {
  try{
    await axios.get('/api/sanitation-surveys')
  .then(response => {
      // Handle success response
      data.value = response.data
  })
  .catch(error => {
      // Handle error response
      console.error('Error fetching data:', error);
  });
  } catch {

  }
  
}

const filteredItems = ref(data.value)
const selectedBarangay = ref()
const selectYear =ref()
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

const yearList = [
  '2023',
  '2024',
  '2025',
  '2026'
];

// Filter Logic
watch([selectedBarangay],() => {
  filteredItems.value = data.value.filter(
    item => {
      if (!selectedBarangay.value) {
        return true
      }
    }
  )
})
</script>


<template>
  <section>
    <VCard>
      <VCardTitle>
        Sanitation Survey Statistics
      </VCardTitle>

      <VDivider/>

      <VCardTitle>
        Filter
      </VCardTitle>

      <VCardText>
        <VRow>
          <VCol
          cols="12"
          sm="4">
            <VSelect
            v-model="selectedBarangay"
            label="Select Barangay"
            placeholder="Select Barangay"
            :items="barangayList"
            clearable
            clear-icon="ri-close-lint">
            
            </VSelect>
          </VCol>

          <VCol
          cols="12"
          sm="4">
            <VSelect
            v-model="selectYear"
            label="Select Year"
            placeholder="Select Year"
            :items="yearList"
            clearable
            clear-icon="ri-close-lint">

            </VSelect>
          </VCol>
        </VRow>
      </VCardText>

      <VDivider />

    </VCard>
  </section>
  

  <section>
    <VRow>
      <!-- Variables -->
        <VCol
        cols="12"
        sm="12">
          <VariableOutput 
          :data="filteredItems"/>
        </VCol> 

        <!-- Excreta Disposal Facility -->
        <VCol
        cols="12"
        md="3"
        sm="4">
          <ExcretaDisposalFacility />
        </VCol>

        <!-- Waste Segregation -->
      
        <VCol
        cols="12"
        md="3"
        sm="4">
          <WasteSegregation/>
        </VCol>

        <!-- Waste Colected -->
        <VCol
        cols="12"
        md="3"
        sm="4">
          <WasteCollected/>
        </VCol>

        <!-- Recycling and Reuse -->
        <VCol
        cols="12"
        md="3"
        sm="4">
          <RecyclePractice />
        </VCol>
    </VRow>
  </section>
  
    <VRow>

      <!-- Property Ownsership Graph -->
      <VCol
      cols="12"
      sm="5">
        <PropertyOwnership />
      </VCol>

      <!-- User Regestration per Month -->

      <VCol
      cols="12"
      sm="7">
        <UserRegistration />
      </VCol>
    </VRow>

    <VRow>

      <!-- Type of Water Source -->
      <VCol
      cols="12"
      sm="4">
        <TypeofWaterSource/>
      </VCol>
      

      <!-- Access to Water Source -->
      <VCol
      cols="12"
      sm="4">
        <AccesstoWaterSource />
      </VCol>

      <VCol
      cols="12"
      sm="4">
        <KindofWaterSource/>
      </VCol>
    </VRow>

    
</template>
