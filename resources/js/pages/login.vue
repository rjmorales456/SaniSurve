<script setup>

import miscMaskDark from '@images/misc/misc-mask-dark.png';
import miscMaskLight from '@images/misc/misc-mask-light.png';
import { VNodeRenderer } from '@layouts/components/VNodeRenderer';
import { themeConfig } from '@themeConfig';
import axios from 'axios';
import { useRouter } from 'vue-router';

const authThemeMask = useGenerateImageVariant(miscMaskLight, miscMaskDark)
const router = useRouter()

definePage({ meta: { layout: 'blank' } })

const form = ref({
  email: '',
  password: '',
  remember: false,
})

const isPasswordVisible = ref(false)

const isLoggingIn = ref(false); // Flag to track login state

const login = async () => {

  if (isLoggingIn.value) 
    {

      console.log('A login attempt is already in progress.');
      return; // Exit the function to prevent concurrent login attempts
    
    } 
  else
  {
    try {

      isLoggingIn.value = true; // Set logging in flag
      
      const res = await axios.post('/api/auth/login', form.value);
      console.log(form.value);

      if (res.status === 200) {

        // Extract user data from the response
        
        const userData = res.data.user;
        const accessToken = res.data.accessToken;
        const rememberToken = res.data.rememberToken;

        
        // DEBUGGING 
        console.log('Extracted Data: ');
        console.log(userData);
        console.log(accessToken);
        console.log(rememberToken);
        //
        
        // Store user data and access token in cookies or local storage
        // For example, if using cookies:

        useCookie('userData').value = userData;
        useCookie('accessToken').value = accessToken;

        if (res.data.rememberToken){
          useCookie('rememberToken').value = rememberToken;
        }
        

        // Handle successful login
        console.log('Login Successful');
        
        router.push('/dashboard')
      } else {
        // Handle error response
        console.error('Login Failed:', res.data);
      }
    }

    catch (error) 
    {
      console.error('Login Failed:', error);
    } 

    finally
    {
      isLoggingIn.value = false; // Reset logging in flag
    }
  }
};

</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard
      class="auth-card pa-sm-4 pa-md-7 pa-0"
      max-width="448"
    >
      <VCardText>
        <div class="d-flex align-center gap-x-3 justify-center mb-6">
          <VNodeRenderer :nodes="themeConfig.app.logo" />

          <h1 class="auth-title">
            LOGIN
          </h1>
        </div>
        <h4 class="text-h4 mb-1">
          Welcome to <span class="text-capitalize">{{ themeConfig.app.title }}!</span>
        </h4>
        <p class="mb-0">
          Please sign-in to your account
        </p>
      </VCardText>

      <VCardText>
        <VForm @submit.prevent="login">
          <VRow>
            <!-- email -->
            <VCol cols="12">
              <VTextField
                v-model="form.email"
                autofocus
                label="Email"
                type="email"
                placeholder="johndoe@email.com"
              />
            </VCol>

            <!-- password -->
            <VCol cols="12">
              <VTextField
                v-model="form.password"
                label="Password"
                placeholder="············"
                :type="isPasswordVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordVisible ? 'ri-eye-off-line' : 'ri-eye-line'"
                @click:append-inner="isPasswordVisible = !isPasswordVisible"
              />
              
              <div class="d-flex align-center flex-wrap justify-space-between my-5 gap-4">
                <VCheckbox
                  v-model="form.remember"
                  label="Remember me"
                  @change="updateRemember"
                />

              </div>

              <VBtn
                block
                type="submit"
              >
                Login
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>

    <!-- bg img -->
    <img
      class="auth-footer-mask d-none d-md-block"
      :src="authThemeMask"
      height="172"
    >
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
