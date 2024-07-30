<script>
import axios from 'axios'

export default {
  data() {
    return {
      dvd: '',
      furniture: '',
      book: '',
      users: [],
      attributeIndex: [],
      attributeValue: [],
      itemsToDelete: [],
    }
  },
  methods: {
    getAllUsers: function () {
      axios.get('/get/returnJson')
          .then((response) => {
                if (response.data) {
                  response.data.forEach((element) => this.users.push(element));
                }
              }
          );
    },
    showElements: function (value) {
      let json_object = JSON.parse(value.attributes);
      let elementSelect = {
        dvd: () => `Size: ${json_object.sizemb} MB`,
        furniture: () => `Dimensions: ${json_object.heightcm} X ${json_object.widthcm} X ${json_object.lengthcm}`,
        book: () => `Weight: ${json_object.weightkg} KG`,
      };
      return elementSelect[value.product_type]();
    },
    deleteUser: function () {
      if (this.itemsToDelete.length) {
        axios.post('/home/delete', {
          id: JSON.parse(JSON.stringify(this.itemsToDelete))
        }).then((response) => {
          window.location.href = "/";
        });
      }
    }
  },
  mounted() {
    this.getAllUsers()
  }
}
</script>

<!--Template-->

<template>
  <header class="header">
    <h1 class="header__title">Product Add</h1>
    <ul class="header__container">
      <li class="header__container--add-inner">
        <button class="header__button header__button--add" name="add" onclick="location.href = '/add-product';">
          ADD
        </button>
      </li>
      <li class="header__container--delete-inner">
        <button class="header__button header__button--delete" name="mass-delete" @click="deleteUser">
          MASS DELETE
        </button>
      </li>
    </ul>
  </header>
  <section class="content">
    <div class="content__container">
      <div class="content__container--inner" id="table-row" v-for="user in users" :key="user.product_id">
        <div class="content__element--delete-checkbox">
            <input id="delete" class="delete-checkbox" :value="user.product_id" :name="user.product_id" v-model="itemsToDelete" type="checkbox">
        </div>
        <div class="content__element content__element--sku">{{ user.product_sku }}</div>
        <div class="content__element content__element--name">{{ user.product_name }}</div>
        <div class="content__element content__element--price">{{ user.product_price }} $</div>
        <div class="content__element content__element--mixed">{{ this.showElements(user) }}</div>
      </div>
    </div>
  </section>
</template>