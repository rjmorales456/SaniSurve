<script setup>

import axios from 'axios';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar';

const props = defineProps({
  isDrawerOpen: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDrawerOpen',
  'userData',
])

const isFormValid = ref(false)

const refForm = ref() 
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const password = ref('')
const contact = ref('')

const isPasswordVisible = ref(false)

// 👉 drawer close
const closeNavigationDrawer = () => {
  emit('update:isDrawerOpen', false)
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = () => {
  refForm.value?.validate().then(({ valid }) => {
    if (valid) {
      const userData = {
        email: email.value,
        password: password.value,
        first_name: firstName.value,
        last_name: lastName.value,
        contact_number: contact.value
        // Add other necessary user data fields
      };

      axios.post('/api/users', userData)
        .then(response => {
          // Handle success response
          console.log('User created successfully', response.data);
          emit('update:isDrawerOpen', false);
          // Reset form fields and validation
          nextTick(() => {
            refForm.value?.reset();
            refForm.value?.resetValidation();
          });
        })
        .catch(error => {
          // Handle error response
          console.error('Error creating user:', error.response.data.message);
          // Optionally, show an error message to the user
        });
    } else {
      // Log validation errors if form validation fails
      console.error('Form validation failed');
    }
  }).catch(error => {
    // Log any unexpected errors during form validation
    console.error('Error during form validation:', error);
  });
};


</script>

<template>
  <VNavigationDrawer
    temporary
    :width="400"
    location="end"
    class="scrollable-content"
    :model-value="props.isDrawerOpen"
    @update:model-value="handleDrawerModelValueUpdate"
  >
    <!-- 👉 Title -->
    <AppDrawerHeaderSection
      title="Add User"
      @cancel="closeNavigationDrawer"
    />

    <VDivider />

    <PerfectScrollbar :options="{ wheelPropagation: false }">
      <VCard flat>
        <VCardText>
          <!-- 👉 Form -->
          <VForm
            ref="refForm"
            v-model="isFormValid"
            @submit.prevent="onSubmit"
          >
            <VRow>
              <!-- First name -->
              <VCol cols="12">
                <VTextField
                  v-model="firstName"
                  :rules="[requiredValidator]"
                  label="First Name"
                />
              </VCol>

              <!-- Last name -->
              <VCol cols="12">
                <VTextField
                  v-model="lastName"
                  :rules="[requiredValidator]"
                  label="Last Name"
                />
              </VCol>

              <!-- Email -->
              <VCol cols="12">
                <VTextField
                  v-model="email"
                  :rules="[requiredValidator, emailValidator]"
                  label="Email"
                  placeholder="johndoe@email.com"
                />
              </VCol>

              <!-- Contact Number -->
              <VCol cols="12">
                <VTextField
                  v-model="contact"
                  :rules="[requiredValidator]"
                  label="Contact Number"
                  placeholder="09********"
                />
              </VCol>

              <VCol cols="12">
                <VTextField
                  v-model="password"
                  label="Password"
                  placeholder="············"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'ri-eye-off-line' : 'ri-eye-line'"
                  :rules="[requiredValidator]"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                />
              </VCol>

              

              <!-- 👉 Submit and Cancel -->
              <VCol cols="12">
                <VBtn
                  type="submit"
                  class="me-4"
                >
                  Submit
                </VBtn>
                <VBtn
                  type="reset"
                  variant="outlined"
                  color="error"
                  @click="closeNavigationDrawer"
                >
                  Cancel
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </PerfectScrollbar>
  </VNavigationDrawer>
</template>
