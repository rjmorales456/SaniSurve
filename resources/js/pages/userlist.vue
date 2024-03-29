<script setup>
import AddNewUserDrawer from '@/views/AddNewUserDrawer.vue';
import axios from 'axios';

const usersData= ref({})

// 👉 Store
const searchQuery = ref('')

// Data table options
const itemsPerPage = ref(10)
const page = ref(1)
const sortBy = ref()
const orderBy = ref()

const updateOptions = options => {
  page.value = options.page
  sortBy.value = options.sortBy[0]?.key
  orderBy.value = options.sortBy[0]?.order
}

const getUsers = () => {
  axios.get('/api/users')
    .then(response => {
      // Handle success response
      usersData.value = response.data;
      console.log('Users retrieved successfully', response.data.users);

    })
    .catch(error => {
      // Handle error response
      console.error('Error retrieving users:', error.response.data.message);
      // Optionally, show an error message to the user
    });
};

await getUsers()

// Headers
const headers = [
  {
    title: 'NAME',
    key: 'last_name',
  },
  {
    title: 'Email',
    key: 'email',
  },
  {

    title: 'Contact Number',
    key: 'contact_number',
    //title: 'Role',
    //key: 'role',
  },
  {
    //title: 'Plan',
    //key: 'plan',
  },
  {
    //title: 'Status',
    //key: 'status',
  },
  {
    title: 'Actions',
    key: 'actions',
    sortable: false,
  },
]

const users = computed(() => usersData.value.users)
const totalUsers = computed(() => usersData.value.totalUsers)

const resolveUserRoleVariant = role => {
  const roleLowerCase = role.toLowerCase()
  if (roleLowerCase === 'subscriber')
    return {
      color: 'success',
      icon: 'ri-user-line',
    }
  if (roleLowerCase === 'author')
    return {
      color: 'error',
      icon: 'ri-computer-line',
    }
  if (roleLowerCase === 'maintainer')
    return {
      color: 'info',
      icon: 'ri-pie-chart-line',
    }
  if (roleLowerCase === 'editor')
    return {
      color: 'warning',
      icon: 'ri-edit-box-line',
    }
  if (roleLowerCase === 'admin')
    return {
      color: 'primary',
      icon: 'ri-vip-crown-line',
    }
  
  return {
    color: 'success',
    icon: 'ri-user-line',
  }
}

const resolveUserStatusVariant = stat => {
  const statLowerCase = stat.toLowerCase()
  if (statLowerCase === 'pending')
    return 'warning'
  if (statLowerCase === 'active')
    return 'success'
  if (statLowerCase === 'inactive')
    return 'secondary'
  
  return 'primary'
}

const isAddNewUserDrawerVisible = ref(false)
/* 

const addNewUser = async userData => {

  // userListStore.addUser(userData)
  await $api('/apps/users', {
    method: 'POST',
    body: userData,
  })

  // refetch User
  fetchUsers()
}

const deleteUser = async id => {
  await $api(`/apps/users/${ id }`, { method: 'DELETE' })

  // refetch User
  fetchUsers()
}
*/
</script>

<template>
  <section>
    <VCard
      class="mb-6 pa-10"
    >
      <h1>User Management</h1>
      <VDivider class="my-4"/>
      <VCardText class="d-flex flex-wrap gap-4">
        
        <VSpacer />
        <div class="app-user-search-filter d-flex align-center">
          <!-- 👉 Search  -->
          <VTextField
            v-model="searchQuery"
            placeholder="Search User"
            density="compact"
            class="me-4"
          />
          <!-- 👉 Add user button -->
          <VBtn @click="isAddNewUserDrawerVisible = true">
            Add New User
          </VBtn>
        </div>
      </VCardText>

      <!-- SECTION datatable -->
      <VDataTableServer
        v-model:items-per-page="itemsPerPage"
        v-model:page="page"
        :items="users"
        item-value="id"
        :items-length="totalUsers"
        :headers="headers"
        show-select
        class="text-no-wrap rounded-0"
        @update:options="updateOptions"
      >
        <!-- User -->
        <template #item.last_name="{ item }">
          {{ item.last_name }}, {{ item.first_name }}
        </template>
        
        <template #item.email="{ item }">
          {{ item.email }}
        </template>
        
        <template #item.contact_number="{ item }">
          {{ item.contact_number }}
        </template>
        

        <!-- Actions -->
        <template #item.actions="{ item }">
          <IconBtn
            size="small"
            @click="deleteUser(item.id)"
          >
            <VIcon icon="ri-delete-bin-7-line" />
          </IconBtn>

          <IconBtn
            size="small"
            :to="{ name: 'apps-user-view-id', params: { id: item.id } }"
          >
            <VIcon icon="ri-eye-line" />
          </IconBtn>

          <IconBtn
            size="small"
            color="medium-emphasis"
          >
            <VIcon
              size="24"
              icon="ri-more-2-line"
            />

            <VMenu activator="parent">
              <VList>
                <VListItem link>
                  <template #prepend>
                    <VIcon icon="ri-download-line" />
                  </template>
                  <VListItemTitle>Download</VListItemTitle>
                </VListItem>
                <VListItem link>
                  <template #prepend>
                    <VIcon icon="ri-edit-box-line" />
                  </template>
                  <VListItemTitle>Edit</VListItemTitle>
                </VListItem>
              </VList>
            </VMenu>
          </IconBtn>
        </template>

        <!-- Pagination -->
        <template #bottom>
          <VDivider />

          <div class="d-flex justify-end flex-wrap gap-x-6 px-2 py-1">
            <div class="d-flex align-center gap-x-2 text-medium-emphasis text-base">
              Rows Per Page:
              <VSelect
                v-model="itemsPerPage"
                class="per-page-select"
                variant="plain"
                :items="[10, 20, 25, 50, 100]"
              />
            </div>

            <p class="d-flex align-center text-base text-high-emphasis me-2 mb-0">
              {{ paginationMeta({ page, itemsPerPage }, totalUsers) }}
            </p>

            <div class="d-flex gap-x-2 align-center me-2">
              <VBtn
                class="flip-in-rtl"
                icon="ri-arrow-left-s-line"
                variant="text"
                density="comfortable"
                color="high-emphasis"
                :disabled="page <= 1"
                @click="page <= 1 ? page = 1 : page--"
              />

              <VBtn
                class="flip-in-rtl"
                icon="ri-arrow-right-s-line"
                density="comfortable"
                variant="text"
                color="high-emphasis"
                :disabled="page >= Math.ceil(totalUsers / itemsPerPage)"
                @click="page >= Math.ceil(totalUsers / itemsPerPage) ? page = Math.ceil(totalUsers / itemsPerPage) : page++ "
              />
            </div>
          </div>
        </template>
      </VDataTableServer>
      <!-- SECTION -->
    </VCard>
    <!-- 👉 Add New User -->
    <AddNewUserDrawer
      v-model:isDrawerOpen="isAddNewUserDrawerVisible"
      @user-data="addNewUser"
    />
  </section>
</template>

<style lang="scss">
.app-user-search-filter {
  inline-size: 24.0625rem;
}

.text-capitalize {
  text-transform: capitalize;
}

.user-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity));
}
</style>
