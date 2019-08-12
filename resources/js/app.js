/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

const store = new Vuex.Store(
  storeData
)



// ckeditor

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

//


// ckfinder



// editor support

import 'v-markdown-editor/dist/index.css';
import Editor from 'v-markdown-editor'
Vue.use(Editor);
//

import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';

window.Swal = Swal;


let Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)



import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'

let options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

Vue.use(VueProgressBar, options)

Vue.use(VueRouter)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/product-list', component: require('./components/admin/products/List.vue').default },
    { path: '/add-product', component: require('./components/admin/products/New.vue').default },
    { path: '/edit-product/:productid', component: require('./components/admin/products/Edit.vue').default },
    { path: '/category-list', component: require('./components/admin/categories/List.vue').default },
    { path: '/home', component: require('./components/admin/AdminHome.vue').default }
  ]

  let router = new VueRouter({
    mode: 'hash',
    routes // short for `routes: routes`
  })

  Vue.filter('upText' , function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
  });

  Vue.filter('myDate', function(created){
    return moment(created).subtract(10, 'days').calendar();
  });

  Vue.filter('sortlength', function(text,length,suffix){
    return text.substring(0,length)+suffix;
  });




  window.Fire = new Vue(); 
  


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('products', require('./components/Products.vue').default);
Vue.component('admin-mian', require('./components/admin/AdminMaster.vue').default);
Vue.component('category-list', require('./components/admin/categories/List.vue').default);
Vue.component('product-list', require('./components/admin/products/List.vue').default);
Vue.component('add-product', require('./components/admin/products/New.vue').default);
Vue.component('edit-product', require('./components/admin/products/Edit.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
});
