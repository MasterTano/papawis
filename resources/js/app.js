// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.

import Vue from 'vue'
import App from './App'
import {router} from './routes/router'
import {store} from './store/index'
// import './plugins/'

require('./init/index');


//initialize app dependency

/* eslint-disable no-new */
new Vue({
	store,
	router,
	components: { App },
	template: '<App/>'
}).$mount('#app');
