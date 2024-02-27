<script setup>
import axios from 'axios';
import { ref } from 'vue';

const survey_data = ref({})
await axios.get('/api/recycle-and-reuse').then(response =>{
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
                    <VCardTitle>Recycling and Reuse</VCardTitle>
                    <VCardSubtitle>Does the household practice recycling and reuse?</VCardSubtitle>

                    <VCardText>
                        <p><b>Yes: {{ survey_data.yesCount }}</b></p><br>
                        <p><b>No: {{ survey_data.noCount }}</b></p>
                    </VCardText>
                    
                </VCardItem>
            </VCol>
        </VRow>
    </VCard>
</template>
