<script setup>
import { useAuth } from "@/stores/auth";
import { storeToRefs } from "pinia";
import { reactive, ref } from "vue";

const auth = useAuth();
const { errors } = storeToRefs(auth);

const form = reactive({
  phone: "",
  password: "",
});

const onSubmit = async () => {
  await auth.login(form);
};

const toggleShow = () => {
  showPassword.value = !showPassword.value;
};
const showPassword = ref(false);

</script>

<template>
  <div>
    <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-6">
            <div class="user-form-card">
              <div class="user-form-title">
                <h2>Customer Login</h2>
                <p>Use your credentials to access</p>
              </div>
              <div class="user-form-group" id="axiosForm">
                <form class="user-form" @submit.prevent="onSubmit">
                  <!--v-if-->
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="phone"
                      v-model="form.phone"
                      :class="{'is-invalid': errors.phone}"
                    /><!--v-if-->
                    <span class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</span>
                  </div>
                  <div class="form-group">
                    <input
                      :type="showPassword ? 'text' : 'password'"
                      class="form-control"
                      placeholder="password"
                      v-model="form.password"
                      :class="{'is-invalid': errors.password}"
                    /><span class="view-password" @click="toggleShow"
                      ><i
                        class="fas text-success"
                        :class="{
                          'fa-eye-slash': showPassword,
                          'fa-eye': !showPassword,
                        }"
                      ></i></span
                    ><!--v-if-->
                    <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                  </div>
                  <div class="form-check mb-3">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="check"
                      value=""
                    /><label class="form-check-label" for="check"
                      >Remember Me</label
                    >
                  </div>
                  <div class="form-button">
                    <button type="submit">login</button>
                    <p>
                      Forgot your password?<a
                        href="reset-password.html"
                        class=""
                        >reset here</a
                      >
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>
                Don't have any account?<router-link
                  :to="{ name: 'user.register' }"
                  class=""
                  >Register Here</router-link
                >
              </p>
            </div>
            <div class="user-form-footer"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>



<style>
@import "@/assets/css/user-auth.css";
</style>
