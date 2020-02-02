/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.swal = require("sweetalert2");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue")
);

Vue.component("modal", require("./components/Modal.vue"));
Vue.component("t-head", require("./components/user-layout/Thead.vue"));
Vue.component("header-component", require("./components/Header.vue"));
Vue.component("footer-content", require("./components/Footer.vue"));
Vue.component("t-head", require("./components/user-layout/Thead.vue"));
Vue.component("register-component", require("./components/Register.vue"));
Vue.component("judge-component", require("./components/Judge.vue"));
Vue.component("judgeshome", require("./components/home/Judges.vue"));
Vue.component("sponsorhome", require("./components/home/Sponsor.vue"));
Vue.component("prizehome", require("./components/home/Prize.vue"));
Vue.component("contacthome", require("./components/home/Contact.vue"));
Vue.component("pembayaran-component", require("./components/Pembayaran.vue"));
Vue.component("rules-component", require("./components/Rules.vue"));

const app = new Vue({
  el: "#app"
});
