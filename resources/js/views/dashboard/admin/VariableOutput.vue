<script setup>
import axios from 'axios';
import { ref } from 'vue';

const count_data = ref([])
const total_occupant_data = ref([])
const avg_family_data = ref([])

// Getting the Count answered surveys
await axios.get('/api/answered-surveys').then(response =>{
    //get the count data
    count_data.value = response.data;
}).catch(error =>{
    // Hanle erroes
    console.error('Error fetching data:',error)
});

// Get total family occupants
await axios.get('/api/total-occupant-survey').then(response =>{
    //get the count data
    total_occupant_data.value = response.data;
}).catch(error =>{
    // Hanle erroes
    console.error('Error fetching data:',error)
});


// Getting the Average Family Number
await axios.get('/api/avg-family-number').then(response =>{
    //get the count data
    avg_family_data.value = response.data;
}).catch(error =>{
    // Hanle erroes
    console.error('Error fetching data:',error)
});


const header1 = [
    {
        count_survey: count_data
    }

]

const header2 = [
    {
        total_occupant_survey: total_occupant_data
    }
]

const header3=[
    {
        avg_family_total: avg_family_data
    }
]

</script>


<template>

<VCard >
    <VRow no-gutters style="height: auto;">
        <VCol 
        cols="5"
        md="4"
        sm="12">

                <VCardItem >

                    <!-- Number of Answered Surveys -->
                    <VCardTitle style="font-size: 15px;">Number of Answered Surveys</VCardTitle>
                    

                    <VCardText>
                        <VList class="number_of_answered_survey">
                            <VListItem v-for="answered in header1">
                                <VListItemSubtitle class="font-weight-medium mb-1" style="font-size: 12px;">
                                    {{ answered.count_title }}
                                </VListItemSubtitle>
                                
                                <template #append>
                                    <VListItemAction>
                                        {{ answered.count_survey }}
                                    </VListItemAction>
                                </template>
                            </VListItem>
                        </VList>
                    </VCardText>
                </VCardItem>
        </VCol>

        <VDivider :vertical="$vuetify.display.mdAndUp" />
 
         <!-- Total Number of Occupants -->
        <VCol
        cols="5"
        md="4"
        sm="12">
            <VCardItem>
                <VCardTitle style="font-size: 15px;">Total Number of Family Occupants</VCardTitle>

                <VCardText>
                    <VList class="total_occupants_list">
                        <VListItem v-for="total_occupant in header2">
                            <VListItemSubtitle class="font-weight-medium mb-1" style="font-size: 12px;">
                                {{ total_occupant.total_occupant_title }}
                            </VListItemSubtitle>

                            <template #append>
                                <VListItemAction>
                                    {{ total_occupant.total_occupant_survey }}
                                </VListItemAction>
                            </template>
                        </VListItem>
                    </VList>
                </VCardText>
            </VCardItem>
        </VCol>
        <VDivider :vertical="$vuetify.display.mdAndUp" />

        <VCol
         cols="5"
         md="4"
         sm="12">

            <VCardItem>
                <VCardTitle style="font-size: 15px;">Average Number of Family Members</VCardTitle>

                <VCardText>
                    <VList class="avg_family_list">
                        <VListItem v-for="avg_family in header3">
                            <VListItemSubtitle class="font-weight-medium mb-1">
                                {{ avg_family.avg_family_title }}
                            </VListItemSubtitle>

                            <template #append>
                                <VListItemAction>
                                    {{ avg_family.avg_family_total }}
                                </VListItemAction>
                            </template>

                        </VListItem>
                    </VList>
                </VCardText>
            </VCardItem>

        </VCol>

    </VRow>
</VCard>
    
</template>
