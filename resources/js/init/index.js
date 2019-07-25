import Vue from 'vue'
import Vuetify from 'vuetify'
import _ from 'lodash'
import * as Axios from './axios'
// import helper from '../utils/helper'

// import {registerGlobalComponents} from './auto_register'

Vue.config.productionTip = false

Vue.use(Vuetify)

// Mixins.init(Vue)

window.$_ = _

window.$_axios = Axios.init()

// window.$_helper = helper

// window.$_http = Http

// window.$_event = new Event()

// //Register base/global components
// registerGlobalComponents()

// Vue.component('Can', Can)

// Vue.use(abilitiesPlugin, initAbility())

// /**
//  * Echo exposes an expressive API for subscribing to channels and listening
//  * for events that are broadcast by Laravel. Echo and event broadcasting
//  * allows your team to easily build robust real-time web applications.
//  */

// // window.Pusher = require('pusher-js');
// //
// // window.Echo = new Echo({
// //     broadcaster: 'pusher',
// //     key: process.env.MIX_PUSHER_APP_KEY,
// //     encrypted: false,
// //     wsHost: window.location.hostname,
// //     wsPort: 6001,
// //     disableStats: true,
// // });
