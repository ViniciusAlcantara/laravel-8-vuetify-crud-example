/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('autocomplete-estacionamentos',require('./components/estacionamento/AutocompleteEstacionamentos.vue').default);
Vue.component('form-unidade',require('./components/unidades/UnidadesForm.vue').default);
Vue.component('form-estacionamento',require('./components/estacionamento/EstacionamentoForm.vue').default);
Vue.component('drawer-menu',require('./components/Drawer.vue').default);
Vue.component('table-component',require('./components/TableComponent.vue').default);
Vue.component('form-usuario',require('./components/users/UsuarioForm').default);
Vue.component('form-alterar-senha',require('./components/users/AlterarSenhaForm').default);
Vue.component('base-material-stats-card',require('./components/base/MaterialStatsCard').default);
Vue.component('base-material-card',require('./components/base/MaterialCard').default);
Vue.component('base-material-chart-card',require('./components/base/MaterialChartCard').default);

import vuetify from './vuetify';

import VueResource from 'vue-resource'
Vue.use(VueResource)

const app = new Vue({
    el: '#app',
    vuetify
});
