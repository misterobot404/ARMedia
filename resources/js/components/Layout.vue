<template>
  <div class="column" style="min-height: 100vh">
    <!-- Header -->
    <header>
      <!-- Top -->
      <div class="flex justify-between items-center page-padding no-wrap border-radius-lg" style="padding-top: 14px; padding-bottom: 10px">
        <!-- Logo -->
        <div>
          <router-link to="/">
            <q-img src="/assets/images/logo-header.svg" height="42px" width="114px" fit="fill" no-spinner/>
          </router-link>
        </div>
        <!-- Search -->
        <div class="flex-grow-1 flex justify-center">
          <q-input outlined v-model="search" placeholder="Найдите площадку мечты" dense style="max-width: 500px"
                   class="flex-grow-1">
            <template v-slot:prepend>
              <q-icon name="search"/>
            </template>
          </q-input>
        </div>
        <!-- User panel -->
        <div class="flex">
          <q-btn label="Сдать в аренду" flat no-caps class="self-center btn-p-sm"
                 style="height: 40px; margin-right: 12px;" to="/object_constructor_previout"/>
          <div>
            <template v-if="USER_STORE.user">
              <div class="user-panel">
                <q-icon name="menu" size="24px"/>
                <q-icon name="o_account_circle" size="24px" class="q-ml-sm q-mr-xs"/>
                <span>{{ USER_STORE.user.name }}</span>
              </div>
              <q-menu auto-close fit :offset="[0, 4]">
                <q-list>
                  <!-- Дополнительный функционал (страница) для администраторов сайта -->
                  <template v-if="USER_STORE.user.is_admin">
                    <q-item clickable @click="$router.push('/admin_panel')">
                      <q-item-section class="text-size-sm">Панель администратора</q-item-section>
                    </q-item>
                  </template>
                  <!--  Ссылки на страницы -->
                  <template v-for="link in user_panel_links" >
                    <q-item :to="link.to" clickable>
                      <q-item-section class="text-size-sm" v-text="link.title"/>
                    </q-item>
                    <q-separator v-if="link.separator"/>
                  </template>
                  <!-- Выход из аккаунта -->
                  <q-item clickable @click="logout()">
                    <q-item-section class="text-size-sm">Выйти</q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </template>
            <template v-else>
              <div class="user-panel" @click="USER_STORE.show_signin_dialog = true">
                <q-icon name="menu" size="24px" class="q-mr-sm"/>
                <q-icon name="o_account_circle" size="24px"/>
              </div>
            </template>
          </div>
        </div>
      </div>
      <q-separator/>
    </header>
    <!-- Page -->
    <main class="flex justify-center flex-grow-1">
      <div :class="$route.meta.fullWidth ? 'full-width' : 'page-default-width'">
        <slot/>
      </div>
    </main>
    <!-- Global components -->
    <SigninDialog/>
    <SignupDialog/>
  </div>
</template>

<script>
import {useUserStore} from "../stores/user";
import SigninDialog from "./SigninDialog.vue";
import SignupDialog from "./SignupDialog.vue";

export default {
  name: "Layout",
  components: {SignupDialog, SigninDialog},
  data() {
    return {
      USER_STORE: useUserStore(),
      active: 'guide',
      search: "",
      user_panel_links: [
        {
          title: "Аккаунт",
          to: "/account",
          separator: true
        },
        {
          title: "История аренды",
          to: "/lease_history"
        },
        {
          title: "Избранное",
          to: "/favorite_objects"
        },
        {
          title: "Мои площадки",
          to: "/my_objects",
          separator: true
        },
        {
          title: "Помощь",
          to: "/help"
        },
      ]
    }
  },
  methods: {
    logout() {
      this.USER_STORE.logout()
          .then(() => {
            this.$q.notify({type: "positive", message: "Вы вышли из своей учётной записи"});
            if (this.$route.meta.requiresAuth) {
              this.$router.push("/");
            }
          });
    },
  },
}
</script>

<style scoped>
.user-panel {
  display: flex;
  align-items: center;
  padding: 7px 10px;
  border-radius: 8px;
  border: 1px solid #0000001f;
  cursor: pointer;
  transition: box-shadow 0.2s ease;
}

.user-panel:hover {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.18);
}

.border-radius-lg :deep(.q-field__control),
.border-radius-lg :deep(.q-btn--rectangle) {
  border-radius: 8px;
}
</style>
