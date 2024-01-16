<template>
  <q-dialog v-model="show_signup" persistent>
    <q-card style="min-width: 440px">
      <form @submit.prevent="signup()">
        <q-card-section class="row items-center">
          <div class="text-h6">Регистрация</div>
          <q-space/>
          <q-btn icon="close" flat round dense v-close-popup/>
        </q-card-section>

        <q-separator/>

        <q-card-section class="q-gutter-y-md">
          <div class="q-mt-md">
            <q-input v-model="name" label="Введите имя" filled required>
              <template v-slot:append>
                <q-icon name="person"/>
              </template>
            </q-input>
          </div>

          <q-input v-model="email" label="Введите электронную почту" filled class="input-lg-hint" type="email" required>
            <template v-slot:append>
              <q-icon name="mail"/>
            </template>
          </q-input>

          <div>
            <q-input v-model="password" label="Введите пароль" filled type="password" required minlength="6">
              <template v-slot:append>
                <q-icon name="password"/>
              </template>
            </q-input>
            <q-separator/>
            <q-input v-model="confirm_password" label="Повторите пароль" filled type="password" required minlength="6"/>
          </div>
        </q-card-section>

        <q-separator/>
        <q-card-section class="flex justify-end q-gutter-x-xs">
          <q-btn @click="showSigninDialog()" flat label="Авторизация" color="primary" v-close-popup/>
          <q-btn label="Подтвердить" color="primary" type="submit" :loading="signup_loading"/>
        </q-card-section>
      </form>
    </q-card>
  </q-dialog>
</template>

<script>
import {useUserStore} from "../stores/user";

export default {
  name: "SignupDialog",
  data() {
    return {
      USER_STORE: useUserStore(),
      name: null,

      email: null,

      password: null,
      confirm_password: null,

      signup_loading: false
    }
  },
  computed: {
    show_signup: {
      get() {
        return this.USER_STORE.show_signup_dialog;
      },
      set(newValue) {
        this.USER_STORE.show_signup_dialog = newValue;
      }
    }
  },
  methods: {
    clear() {
          this.name = null;
          this.email = null;
          this.password = null;
          this.confirm_password = null;
    },
    signup() {
      if (this.password.length < 5) {
        this.$q.notify({type: "negative", message: "Длина пароля менее 5 символов"});
        return;
      }

      if (this.password !== this.confirm_password) {
        this.$q.notify({type: "negative", message: "Пароли не совпадают"});
        return;
      }

      this.signup_loading = true;
      let payload = {
        name: this.name,
        email: this.email,
        password: this.password
      }

      this.USER_STORE.signup(payload)
          .then(() => {
            this.USER_STORE.signin(this.email, this.password).then(() => {
              this.$q.notify({type: "positive", message: "Регистрация выполнена"});
              this.USER_STORE.show_signup_dialog = false;
              this.clear();
            })
          })
          .catch((response) => {
            if (response.status == 422) {
              this.$q.notify({type: "negative", message: "Такая почта уже зарегистрирована"});
            } else {
              this.$q.notify({type: "negative", message: "Ошибка сервера"});
            }
          })
          .finally(() => this.signup_loading = false)
    },
    showSigninDialog() {
      this.USER_STORE.show_signin_dialog = true;
    }
  }
}
</script>

<style scoped>

</style>
