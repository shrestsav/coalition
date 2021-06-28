/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';


import example from './components/ExampleComponent.vue';
Vue.component('example', example);

import task from './components/task.vue';
Vue.component('task', task);
// import {Grid} from 'ag-grid-community';

const app = new Vue({
    el: '#app',
    methods: {
        
    },
});