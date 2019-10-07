/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attacAddWarehouseAddWarehouseAddWarehouseAddWarehouseh it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import CompWarehouses from './components/Warehouses.vue';
import CompCreateWarehouse from './components/AddWarehouse.vue';
import CompEditWarehouse from './components/EditWarehouse.vue';

import CompAddRoom from './components/AddRoom.vue';

const routes = [
    {
        path: '/',
        components: {
            CompWarehouses: CompWarehouses
        }
    },
    {path: '/addwarehouse', component: CompCreateWarehouse, name: 'AddWarehouse'},
    {path: '/editwarehouse/:id', component: CompEditWarehouse, name: 'EditWarehouse'},
    {path: '/editwarehouse/:id/addroom', component: CompAddRoom, name: 'AddRoom'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')