<script setup>
import axios from 'axios';
import { ref } from 'vue';

const survey_data = ref({});

await axios.get('/api/waste-collected').then(response =>{
    //get data
    survey_data.value = response.data;
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
                    <VCardTitle>Waste Collected</VCardTitle>
                    <VCardSubtitle>Does the household practice waste segregation?</VCardSubtitle>

                    <VCardText>
                        <p><b>Yes: {{ survey_data.yesCount }}</b></p><br>
                        <p><b>No: {{ survey_data.noCount }}</b></p>
                    </VCardText>
                </VCardItem>
            </VCol>
        </VRow>
    </VCard>
</template>
