<script setup>
import miscMaskDark from '@images/misc/misc-mask-dark.png';
import miscMaskLight from '@images/misc/misc-mask-light.png';
import { VNodeRenderer } from '@layouts/components/VNodeRenderer';
import { themeConfig } from '@themeConfig';

const authThemeMask = useGenerateImageVariant(miscMaskLight, miscMaskDark)
const router = useRouter()

definePage({ meta: { layout: 'blank' } })

const form = ref({
  email: '',
  password: '',
  remember: false,
})

const isPasswordVisible = ref(false)

const onSubmit = () => {
  router.push('/')
}
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
            {{ themeConfig.app.title }}
          </h1>
        </div>
        <h4 class="text-h4 mb-1">
          Welcome to <span class="text-capitalize">{{ themeConfig.app.title }}!</span> 👋🏻
        </h4>
        <p class="mb-0">
          Please sign-in to your account and start the adventure
        </p>
      </VCardText>

      <VCardText>
        <VForm @submit.prevent="onSubmit">
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
                />
                <RouterLink
                  class="text-primary"
                  :to="{ name: 'pages-authentication-forgot-password-v2' }"
                >
                  Forgot Password?
                </RouterLink>
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
