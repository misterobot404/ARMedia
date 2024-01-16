<template>
  <q-dialog v-model="show_signin" persistent>
    <q-card>
      <form @submit.prevent="signin()">
        <q-card-section class="row items-center">
          <div class="text-h6">Авторизация</div>
          <q-space/>
          <q-btn icon="close" flat round dense v-close-popup/>
        </q-card-section>

        <q-separator/>

        <q-card-section class="q-gutter-y-md">
          <q-input v-model="signin_email" label="Введите электронную почту" filled type="email" required>
            <template v-slot:prepend>
              <q-icon name="email"/>
            </template>
          </q-input>
          <q-input v-model="signin_password" label="Введите пароль" filled type="password" required>
            <template v-slot:prepend>
              <q-icon name="password"/>
            </template>
          </q-input>
        </q-card-section>

        <q-separator/>
        <q-card-section class="flex justify-end q-gutter-x-xs">
          <q-btn @click="showSignupDialog()" flat label="Регистрация" color="primary" v-close-popup/>
          <q-btn label="Подтвердить" color="primary" type="submit" :loading="signin_loading"/>
        </q-card-section>
      </form>
    </q-card>
  </q-dialog>
</template>

<script>
import {useUserStore} from "../stores/user";

export default {
  name: "SigninDialog",
  data() {
    return {
      USER_STORE: useUserStore(),
      signin_email: null,
      signin_password: null,
      signin_loading: false,
    }
  },
  computed: {
    show_signin: {
      get() {
        return this.USER_STORE.show_signin_dialog;
      },
      set(newValue) {
        this.USER_STORE.show_signin_dialog = newValue;
      }
    },
  },
  methods: {
    async signin() {
      this.signin_loading = true;
      return this.USER_STORE.signin(this.signin_email, this.signin_password)
          .then(() => {
            this.$q.notify({type: "positive", message: "Авторизация выполнена"});
            this.USER_STORE.show_signin_dialog = false;
          })
          .catch((response) => {
            if (response.response.status === 403) {
              this.$q.notify({type: "negative", message: "Неверные данные учётной записи"});
            } else if (response.response.status === 451) {
              this.$q.notify({type: "negative", message: "Учетная запись была заблокирована за нарушение правил площадки"});
            } else {
              this.$q.notify({type: "negative", message: "Ошибка сервера"});
            }
          })
          .finally(() => this.signin_loading = false)
    },
    showSignupDialog() {
      this.USER_STORE.show_signup_dialog = true;
    }
  }
}
</script>

<style scoped>

</style>