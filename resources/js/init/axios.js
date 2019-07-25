import axios from 'axios'
// import cookie from 'vue-cookies'
import Qs from 'qs'

// import {
//     request_success_interceptor,
//     request_error_interceptor,
//     response_error_interceptor,
//     response_success_interceptor
// } from './response_interceptor';

export function init() {
    let headers = {}
    let token = ''//cookie.get('token')

    if (token) {
        headers = {'Authorization': `Bearer ${token}`}
    }
    let instance = axios.create({
        baseURL: process.env.MIX_API_BASE_URL,
        // `paramsSerializer` is an optional function in charge of serializing `params`
        // (e.g. https://www.npmjs.com/package/qs, http://api.jquery.com/jquery.param/)
        paramsSerializer: function (params) {
            return Qs.stringify(params, {arrayFormat: 'brackets', encode: true })
        },
        headers
    });

    // instance.interceptors.request.use(request_success_interceptor, request_error_interceptor)
    // instance.interceptors.response.use(response_success_interceptor, response_error_interceptor)

    return instance
}
