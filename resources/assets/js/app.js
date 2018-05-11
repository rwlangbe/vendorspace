
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import Router from './routes.js'
import VueResource from 'vue-resource'
import VeeValidate from 'vee-validate'


window.Vue = require('vue');
require('./bootstrap');

Vue.use(VueResource);
Vue.use(VeeValidate);

Vue.http.options.root = "http://localhost:8000"

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.http.interceptors.push((request, next) => {
	next(response => {
		if (response.status == 404)
			swal(response.status.toString(), response.body.error, "error")
		else if (response.status == 500)
			swal(response.status.toString(), "There was a server problem sending you the article.", "error")
	})
})

const app = new Vue({
    el: '#app',
    router: Router,  
});