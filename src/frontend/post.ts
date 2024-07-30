import * as Vue from "vue";
import App from "./modules/post/post.vue";
import { Validator } from './modules/post/validator/Validator';

const app = Vue.createApp(App);
app.provide('validator', new Validator());
app.mount("#root");