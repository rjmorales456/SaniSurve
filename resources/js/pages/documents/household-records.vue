<script setup>
const data = ref({})


const editDialog = ref(false)
const deleteDialog = ref(false)

const defaultItem = ref({
  id: -1,
  date: '',
  surName: '',
  firstName: '',
  middleName: '',
  sitio: '',
  barangay: '',
  ownership: '',
  numOccupants: 0,
  numFamilies: 0,
  typeWater: '',
  accessWater: '',
  kindWater: '',
  excretaDisposal: '',
  isShared: '',
  isSegragated: '',
  isCollected: '',
  disposalBio: [],
  disposalNonBio: [],
  isRecycled: '',
  wellDepth: '',
  yearConstructed: '',
  specifiedMethod: ''
})

const editedItem = ref(defaultItem.value)
const editedIndex = ref(-1)

// status options
const selectedOptions = [
  {
    text: 'Current',
    value: 1,
  },
  {
    text: 'Professional',
    value: 2,
  },
  {
    text: 'Rejected',
    value: 3,
  },
  {
    text: 'Resigned',
    value: 4,
  },
  {
    text: 'Applied',
    value: 5,
  },
]

// headers
const headers = [
  {
    title: 'DATE',
    key: 'date',
  },
  {
    title: 'NAME',
    key: 'fullName',
  },
  {
    title: 'BARANGAY',
    key: 'barangay',
  },
  {
    title: 'OWNERSHIP',
    key: 'ownership',
  },
  {
    title: 'TYPE OF WATER SOURCE',
    key: 'typeWater',
  },
  {
    title: 'KIND OF WATER SOURCE',
    key: 'kindWater',
  },
  {
    title: 'EXCRETA DISPOSAL',
    key: 'disposalMethod',
  },
  {
    title: 'ACTIONS',
    key: 'actions',
  },
]

const resolveStatusVariant = status => {
  if (status === 1)
    return {
      color: 'primary',
      text: 'Current',
    }
  else if (status === 2)
    return {
      color: 'success',
      text: 'Professional',
    }
  else if (status === 3)
    return {
      color: 'error',
      text: 'Rejected',
    }
  else if (status === 4)
    return {
      color: 'warning',
      text: 'Resigned',
    }
  else
    return {
      color: 'info',
      text: 'Applied',
    }
}

/*
const editItem = item => {
  editedIndex.value = userList.value.indexOf(item)
  editedItem.value = { ...item }
  editDialog.value = true
}

const deleteItem = item => {
  editedIndex.value = userList.value.indexOf(item)
  editedItem.value = { ...item }
  deleteDialog.value = true
}

const close = () => {
  editDialog.value = false
  editedIndex.value = -1
  editedItem.value = { ...defaultItem.value }
}

const closeDelete = () => {
  deleteDialog.value = false
  editedIndex.value = -1
  editedItem.value = { ...defaultItem.value }
}

const save = () => {
  if (editedIndex.value > -1)
    Object.assign(userList.value[editedIndex.value], editedItem.value)
  else
    userList.value.push(editedItem.value)
  close()
}

const deleteItemConfirm = () => {
  userList.value.splice(editedIndex.value, 1)
  closeDelete()
}

onMounted(() => {
  userList.value = JSON.parse(JSON.stringify(data))
})
*/
</script>

<template>
  <VCard class="pa-10">
    <!-- 👉 Datatable  -->
    <VDataTable
      :headers="headers"
      :items="data"
      :items-per-page="5"
      class="text-no-wrap"
    >
      <!-- Date -->
      <template #item.date="{ item }">
      </template>

      <!-- Full Name -->
      <template #item.fullName="{ item }">
      </template>

      <!-- Barangay -->
      <template #item.barangay="{ item }">
      </template>

      <!-- Ownership -->
      <template #item.ownership="{ item }">
      </template>

      <!-- Type of Water Source -->
      <template #item.typeWater="{ item }">
      </template>

      <!-- Kind of Water Source -->
      <template #item.kindWater="{ item }">
      </template>

      <!-- Excreta Disposal -->
      <template #item.disposalMethod="{ item }">
      </template>

      <!-- Actions -->
      <template #item.actions="{ item }">
      </template>

    </VDataTable>
  </VCard>

  <!-- 👉 Edit Dialog  -->
  <VDialog
    v-model="editDialog"
    max-width="600px"
  >
    <VCard>
      <VCardTitle>
        <span class="headline">Edit Item</span>
      </VCardTitle>

      <VCardText>
        <VContainer>
          <VRow>
            <!-- fullName -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VTextField
                v-model="editedItem.fullName"
                label="User name"
              />
            </VCol>

            <!-- email -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VTextField
                v-model="editedItem.email"
                label="Email"
              />
            </VCol>

            <!-- salary -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VTextField
                v-model="editedItem.salary"
                label="Salary"
                prefix="$"
                type="number"
              />
            </VCol>

            <!-- age -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VTextField
                v-model="editedItem.age"
                label="Age"
                type="number"
              />
            </VCol>

            <!-- start date -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VTextField
                v-model="editedItem.startDate"
                label="Date"
              />
            </VCol>

            <!-- status -->
            <VCol
              cols="12"
              sm="6"
              md="4"
            >
              <VSelect
                v-model="editedItem.status"
                :items="selectedOptions"
                item-title="text"
                item-value="value"
                label="Status"
                variant="outlined"
              />
            </VCol>
          </VRow>
        </VContainer>
      </VCardText>

      <VCardActions>
        <VSpacer />

        <VBtn
          color="error"
          variant="outlined"
          @click="close"
        >
          Cancel
        </VBtn>

        <VBtn
          color="success"
          variant="elevated"
          @click="save"
        >
          Save
        </VBtn>
      </VCardActions>
    </VCard>
  </VDialog>

  <!-- 👉 Delete Dialog  -->
  <VDialog
    v-model="deleteDialog"
    max-width="500px"
  >
    <VCard>
      <VCardTitle>
        Are you sure you want to delete this item?
      </VCardTitle>

      <VCardActions>
        <VSpacer />

        <VBtn
          color="error"
          variant="outlined"
          @click="closeDelete"
        >
          Cancel
        </VBtn>

        <VBtn
          color="success"
          variant="elevated"
          @click="deleteItemConfirm"
        >
          OK
        </VBtn>

        <VSpacer />
      </VCardActions>
    </VCard>
  </VDialog>
</template>
