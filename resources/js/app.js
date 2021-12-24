/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vuetify from "vuetify"
import VueChatScroll from "vue-chat-scroll"
window.Vue = require('vue');
window.Vue.use(Vuetify)
window.Vue.use(VueChatScroll)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Login from "./components/Login.vue"
import Register from "./components/Register.vue"
import Navbar from "./components/Navbar.vue"
import Map from "./components/Map.vue"
import Profile from "./components/Profile.vue"
import Chat from "./components/Chat.vue"
import BreadCrumb from "./components/BreadCrumb.vue"
import Message from "./components/Message.vue"
import Distance from "./components/Distance.vue"

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    components: {
        "login-app": Login,
        "register-app": Register,
        "navbar-app": Navbar,
        "map-app": Map,
        "profile-app": Profile,
        "chat-app": Chat,
        "message-app": Message,
        "distance-app": Distance,
        "bread-crumb": BreadCrumb,
    }
});
