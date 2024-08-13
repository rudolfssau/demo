<script>
import { defineComponent } from 'vue';
import axios from "axios";
import { Validator } from "./validator/Validator";
import { NotEmpty } from "./validator/rules/NotEmpty";
import { NumChar } from "./validator/rules/NumChar";
import { Numeric } from "./validator/rules/Numeric";
import { Selected } from "./validator/rules/Selected";
import { WithinRange } from "./validator/rules/WithinRange";
import { UniqueSKU } from "./validator/rules/UniqueSKU";
import { Legal } from "./validator/rules/Legal";

export default defineComponent({
  data() {
    return {
      insertValues: [],
      attributeValues: [],
      skuArray: [],
      errorMsg: '',
      sku: '',
      name: '',
      price: '',
      select: 'none',
      fields: {
        none: {
          show: 'none'
        },
        dvd: {
          show: 'none',
          input: '',
        },
        furniture: {
          show: 'none',
          input_first: '',
          input_second: '',
          input_third: ''
        },
        book: {
          show: 'none',
          input: '',
        }
      },
    };
  },
  methods: {
    dropdown: function () {
      for(let field in this.$data.fields) {
        this.$data.fields[field].show = 'none';
      }
      this.$data.fields[this.select].show = 'block';
    },
    fetchSKUFromDB: async function() {
       await axios.post('/check/check', this.sku)
          .then((response) => {
            this.skuArray = (response.data);
          });
    },
    fetchExistingSKU: function() {
      let skuValueArray = [];
      if (this.skuArray) {
        this.skuArray.forEach(function (value) {
          skuValueArray.push(value.product_sku);
        });
      }
      return skuValueArray;
    },
    validate: function (validateInstance) {
      let validate = validateInstance;
      validate.handle("Dropdown", this.select, [Selected]);
      validate.handle("Price", this.price, [NotEmpty, Numeric, Legal, WithinRange]);
      validate.handle("Name", this.name, [NotEmpty, NumChar, Legal, WithinRange]);
      validate.handle("Sku", this.sku, [NotEmpty, WithinRange, Legal, UniqueSKU]);
      let dropdownSelect = {
        dvd: () => {
          validate.handle("Size (MB)", this.fields.dvd.input, [NotEmpty, Numeric, Legal, WithinRange]);
        },
        furniture: () => {
          validate.handle("Length (CM)", this.fields.furniture.input_third, [NotEmpty, Numeric, Legal, WithinRange]);
          validate.handle("Width (CM)", this.fields.furniture.input_second, [NotEmpty, Numeric, Legal, WithinRange]);
          validate.handle("Height (CM)", this.fields.furniture.input_first, [NotEmpty, Numeric, Legal, WithinRange]);
        },
        book: () => {
          validate.handle("Weight (KG)", this.fields.book.input, [NotEmpty, Numeric, Legal, WithinRange]);
        }
      }
      dropdownSelect.hasOwnProperty(this.select) && dropdownSelect[this.select]();
    },
    insert: function () {
      let insertSelect = {
        dvd: () => {
          this.attributeValues = ({
            attributes: {
              'sizemb': this.fields.dvd.input
            }
          });
        },
        furniture: () => {
          this.attributeValues = ({
            attributes: {
              'heightcm': this.fields.furniture.input_first,
              'widthcm': this.fields.furniture.input_second,
              'lengthcm': this.fields.furniture.input_third
            }
          });
        },
        book: () => {
          this.attributeValues = ({
            attributes: {
              'weightkg': this.fields.book.input
            }
          });
        }
      }
      insertSelect.hasOwnProperty(this.select) && insertSelect[this.select]();
    },
    submitForm: async function (e) {
      const validator = new Validator();
      await this.fetchSKUFromDB();
      let skuValues = this.fetchExistingSKU();
      validator.fetchSKU(skuValues)
      this.validate(validator);
      if (!validator.isValid()) {
        this.errorMsg = validator.getErrors();
        return;
      }
      this.insert();
      try {
        this.insertValues = {
          sku: this.sku,
          name: this.name,
          price: this.price,
          product_type: this.select,
          attributes: this.attributeValues
        };
        await axios.post('/posts/insert', this.insertValues);
        window.location = '/';
      } catch (error) {
        e.preventDefault();
        alert("An error has occurred, please reload the page!");
      }
    }
  },
})
</script>

<!--Template-->

<template>
  <header class="header">
    <h1 class="header__title">Product Add</h1>
    <ul class="header__container">
      <li class="header__container--add-inner">
        <button name="save_add" value="submit" type="submit" form="products_form" @click="submitForm" class="header__button header__button--add">
          Save
        </button>
      </li>
      <li class="header__container--cancel-inner">
        <button name="mass-delete" onclick="location.href = '/'" class="header__button header__button--cancel">
          Cancel
        </button>
      </li>
    </ul>
  </header>
  <form id="product_form" name="products_form" method="post" class="product_form">
    <div class="product_form__main-field"><span>SKU</span><input class="product_form__input product_form__input--sku" id="sku" type="text" name="sku" v-model="sku"></div>
    <div class="product_form__main-field"><span>Name</span><input class="product_form__input product_form__input--name" id="name" type="text" name="name" v-model="name"></div>
    <div class="product_form__main-field"><span>Price ($)</span><input class="product_form__input product_form__input--price" id="price" type="text" name="price" v-model="price"></div>
    <section class="dropdown">
      <label for="type-switcher" class="dropdown__title">Type Switcher</label>
      <select id="productType" name="product_type" v-model="select" v-on:change="dropdown(select)" class="dropdown__select">
        <option value="none" name="one"></option>
        <option value="dvd" name="dvd">DVD</option>
        <option value="furniture">Furniture</option>
        <option value="book" name="book">Book</option>
      </select>
    </section>
    <section class="dropdown_input">
      <div v-bind:style="{display: this.fields.dvd.show}">
        <div class="dropdown_input__element">
          <span>Size (MB)</span>
          <input id="size" class="dropdown_input__input dropdown_input__input--dvd-0" type="text" name="sizemb" v-model="fields.dvd.input">
        </div>
        <span>Please provide disc space in MB.</span>
      </div>
      <div v-bind:style="{display: this.fields.furniture.show}">
        <div class="dropdown_input__element">
          <span>Height (CM)</span>
          <input id="height" class="dropdown_input__input dropdown_input__input--furniture-0" type="text" name="heightcm" v-model="fields.furniture.input_first" v-on:input="checkForNum">
        </div>
        <div class="dropdown_input__element">
          <span>Width (CM)</span>
          <input id="width" class="dropdown_input__input dropdown_input__input--furniture-1" type="text" name="widthcm" v-model="fields.furniture.input_second" v-on:input="checkForNum">
        </div>
        <div class="dropdown_input__element">
          <span>Length (CM)</span>
          <input id="lenght" class="dropdown_input__input dropdown_input__input--furniture-2" type="text" name="lengthcm" v-model="fields.furniture.input_third" v-on:input="checkForNum">
        </div>
        <span>Please provide the height, width and length of the furniture piece in centimeters.</span>
      </div>
      <div v-bind:style="{display: this.fields.book.show}">
        <div class="dropdown_input__element">
          <span>Weight (KG)</span>
          <input id="weight" class="dropdown_input__input dropdown_input__input--book-0" type="text" name="weightkg" v-model="fields.book.input" v-on:input="checkForNum">
        </div>
        <span>Please provide the weight of the book in KG.</span>
      </div>
    </section>
  </form>
  <span class="error_message">
    {{this.errorMsg}}
  </span>
</template>