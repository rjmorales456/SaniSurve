<script setup>
import axios from 'axios';
import { ref } from 'vue';
const shared_data = ref({})

await axios.get('/api/shared-household').then(response =>{
    //get data
    shared_data.value = response.data;
}).catch(error =>{
    //Handle Error
    console.error('Error fetching data',error)
})

</script>

<template>

<VCard>
    <VRow>
        <VCol>
            <VCardItem>
                <VCardTitle>Excreta Disposal Facility</VCardTitle>
                <VCardSubtitle>Are the excreta disposal facilities shared with other households?</VCardSubtitle>
                <VCardText>
                    <p><b>Yes {{ shared_data.yesCount }}</b></p><br>
                    <p><b>No: {{ shared_data.noCount }}</b></p>

                </VCardText>
            </VCardItem>
        </VCol>
    </VRow>
</VCard>



</template>
