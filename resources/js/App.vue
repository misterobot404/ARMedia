<template>
    <router-view/>
</template>

<script>
import axios from "axios";
import {useUserStore} from "./stores/user";

export default {
  name: "App",
  beforeMount() {
    if (useUserStore().token) {
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + useUserStore().token;
    }
  }
}
</script>

<style>

</style>
