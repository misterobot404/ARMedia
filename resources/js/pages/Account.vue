<template>
  <AccountContainer>
    <div class="row q-mt-md">
      <div class="col-lg-2 col-md-12 col-xs-12 flex column items-center q-mt-md q-mr-auto">
        <q-img :src="user.avatar_url" alt="Аватарка" no-spinner width="220px" class="border-radius-lg"/>
        <q-btn @click="$refs.avatar.pickFiles()" class="self-center secondary link q-mt-sm" label="Загрузить фото" unelevated no-caps/>
        <q-file ref="avatar" v-model="new_avatar" @update:model-value="(new_avatar) => updateAvatar(new_avatar)" accept="image/*" class="hidden"/>
      </div>
      <div class="col-lg-5 col-md-12 col-xs-12 q-mt-md q-mr-auto">
        <div class="column">
          <span class="text-m-b text-01">Фамилия</span>
          <span class="text-xs text-02">Фамилия здесь должна совпадать с фамилией в вашем паспорте</span>
          <q-input v-model="user.surname" outlined readonly class="base-03 q-mt-xs"/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Имя</span>
          <span class="text-xs text-02">Имя здесь должно совпадать с именем в вашем паспорте</span>
          <q-input v-model="user.name" outlined readonly class="base-03 q-mt-xs"/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Отчество</span>
          <span class="text-xs text-02">Отчество здесь должно совпадать с отчеством в вашем паспорте</span>
          <q-input v-model="user.patronymic" outlined readonly class="base-03 q-mt-xs"/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Документ подтверждающий личность</span>
          <span class="text-xs text-02">Удостоверение личности государственного образца</span>
          <q-btn label="Загрузить документ" class="link q-mt-sm" style="width: fit-content" outline unelevated
                 no-caps/>
        </div>
        <template v-if="user.is_entity">
          <div class="column q-mt-lg">
            <span class="text-m-b text-01">Название организации</span>
            <q-input outlined v-model="user.organization_name" class="q-mt-xs"/>
          </div>
          <div class="column q-mt-lg">
            <span class="text-m-b text-01">ИНН организации</span>
            <q-input outlined v-model="user.organization_inn" class="q-mt-xs"/>
          </div>
          <div class="column q-mt-lg">
            <span class="text-m-b text-01">Ваша должность</span>
            <q-input outlined v-model="user.employer_position" class="q-mt-xs"/>
          </div>
        </template>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Дата рождения</span>
          <span class="text-xs text-02">Пользоваться сервисом могут лица, старше 18 лет</span>
          <q-input outlined v-model="user.birthday" class="q-mt-xs"/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Номер телефона</span>
          <span class="text-xs text-02">Для связи с CreativeHub и гостями по подтверждённымбронированиям</span>
          <q-input mask="+7(###)###-##-##" fill-mask="_" outlined v-model="user.phonenumber" class="q-mt-xs"/>
          <q-btn label="Добавить другой номер" class="link text-s-b" style="width: fit-content" flat no-caps/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Электронная почта</span>
          <span class="text-xs text-02">Для связи с CreativeHub и гостями по подтверждённым
                        бронированиям</span>
          <q-input outlined v-model="user.email" class="q-mt-xs"/>
        </div>
        <div class="column q-mt-lg">
          <span class="text-m-b text-01">Информация о себе</span>
          <span class="text-xs text-02">Расскажите своим гостям и арендодателям о себе</span>
          <q-input outlined v-model="about" type="textarea" class="q-mt-xs"/>
        </div>


      </div>
      <div class="col-lg-4 col-md-12 col-xs-12 q-mt-md flex column">
        <div class="info-card">
          <q-img src="/assets/images/site-amico-1.svg" height="180px" fit="contain" no-spinner/>
          <span class="text-m-b text-01">Зачем вносить ваши данные?</span>
          <span class="text-s text-01">Для заключения договоров на площадке CreativeHub необходимо подтвердить
                        вашу личность. Мы храним все персональные данные в соответствии с ФЗ-152 “О персональных
                        данных”.</span>
        </div>
        <div class="info-card q-mt-lg">
          <q-img src="/assets/images/analysis-amico-1.svg" height="180px" fit="contain" no-spinner/>
          <span class="text-m-b text-01">Какие данные увидят другие?</span>
          <span class="text-s text-01">CreativeHub сообщает гостям и хозяевам контактную информацию друг друга
                        только после подтверждения бронирования.</span>
        </div>
      </div>
    </div>
  </AccountContainer>
</template>

<script>
import {ref} from 'vue';
import AccountContainer from '../components/AccountContainer.vue';
import {mapState} from "pinia";
import {useUserStore} from "@/stores/user";
import axios from "axios";

export default {
  components: {AccountContainer},
  data() {
    return {
      new_avatar: null,

      date: "",
      phone: "+7",
      mail: "",
      about: ""
    };
  },
  computed: {
    ...mapState(useUserStore, ["user"])
  },
  methods: {
    updateAvatar(file) {
      if (!file) {
        return
      }

      const formData = new FormData();
      formData.append(`avatar`, file);

      axios.post(`/api/users/${this.user.id}/avatar`, formData, {headers: {'Content-Type': 'multipart/form-data'}})
          .then((response) => {
            useUserStore().user.avatar_url = response.data.avatar_url;
            window.localStorage.setItem('user', JSON.stringify(this.user));
          });
    }
  }
}

</script>

<style scoped></style>
