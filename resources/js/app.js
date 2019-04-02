// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './components/App'
import './plugins/'
// import router from '@/base/router'
// import store from '@/base/store'


//initialize app dependency

/* eslint-disable no-new */
new Vue({
	// store,
	// router,
	components: { App },
	template: '<App/>'
}).$mount('#app');
