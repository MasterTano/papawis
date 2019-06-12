// import store from '@/base/store'
// import Type from './static_types'
// import {initAbility} from '../permissions/ability'
// import {ability} from '../permissions/type'

// const Ability = initAbility()

// export const ifNotAuthenticated = (to, from, next) => {
//     if (to.name !== 'auth' && !store.getters['auth/isAuthenticated']) {
//         if (to.matched.length)
//             store.commit('auth/loginRedirectTo', to.path)

//         if (to.name == "forgot_password"){
//             store.commit('auth/loginRedirectTo', '')
//             next()
//             return
//         }

//         next({name: 'auth'})
//         return
//     }
//     next()
// }

// export const ifAuthenticated = (to, from, next) => {
//     if ((to.name == 'auth' || to.name == 'forgot_password') && store.getters['auth/isAuthenticated']) {
//         next('/account-management/basic-information')
//         return
//     }
//     if (!to.matched.length) {
//         next('/pagenotfound')
//         return
//     }
//     next()
// }

// export const accountsRestriction = (to, from, next) => {
//     let user = $_helper.getLoggedInUser();

//     if (user.type === 'SUPER_ADMIN') {
//         if (['sub_master', 'agent', 'player'].includes(to.name)) {
//             store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//             next({name: 'admin'});
//             return;
//         }
//     } else if (user.type === 'ADMIN') {
//         if (['super_admin', 'admin', 'agent', 'player'].includes(to.name)) {
//             store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//             next({name: 'master'})
//             return;
//         }
//     } else if (user.type === 'MASTER') {
//         if (['super_admin', 'admin'].includes(to.name)) {
//             store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//             next({name: 'sub_master'})
//             return;
//         }
//     } else if (user.type === 'SUB_MASTER') {
//         if (['super_admin', 'admin', 'master'].includes(to.name)) {
//             store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//             next({name: 'agent'})
//             return;
//         }
//     } else if (user.type === 'AGENT') {
//         if (['super_admin', 'admin', 'master', 'sub_master'].includes(to.name)) {
//             store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//             next({name: 'player'})
//             return;
//         }
//     }
//     next()
// }
// /*
//  * ROLES and PERMISSIONS REDIRECTION
//  * Dynamic routes for viewing/opening roles pages
// **/
// export const permissionsRedirect = (to, from, next) => {
//     let user = $_helper.getLoggedInUser();
//     if(to.name === 'permission') {
//         if(user.type === 'SUPER_ADMIN') {
//             next({name: 'admin_account'})
//         }
//         else if(user.type === 'ADMIN') {
//             next({name: ''})
//         }
//         else if(user.type === 'MASTER') {
//             next({name: 'sub_master_account'})
//         }
//         else if(user.type === 'SUB_MASTER') {
//             next({name: 'agent_account'})
//         }
//         else if(user.type === 'AGENT') {
//             next({name: ''})
//         }
//     }
//     next()
// }

// export const permissionGuard = (to, from, next) => {
//     let user = $_helper.getLoggedInUser()

//     if($_.isEmpty(user)) return

//     let canNavigate = to.matched.some(route => {
//         let permission = $_.get(route, 'meta.permission')
//         if(!permission) return false
//         return Ability.can(permission.action || 'read', permission.code) || permission.code === ability.all
//     })
//     // console.log('permission to', to)
//     // console.log('permission Ability', Ability)
//     // console.log('permission canNavigate', canNavigate)

//     if(!canNavigate){
//         console.error(`Cannot navigate to ${to.fullPath}. Check your permission`)
//         // next({name:from.name})
//         // return
//     }
//     next()
// }




// //This should be last dont put guard below this
// //This should be last dont put guard below this
// export const accountsRedirect = (to, from, next) => {
//     let adminSideAccountTypes = [Type.account_type.super_admin, Type.account_type.admin]
//     let user = $_helper.getLoggedInUser()

//     if(to.name === 'accounts'){
//         if(adminSideAccountTypes.includes(user.type)){
//             next({name: 'admin'})
//             return
//         } else {
//             next({name: 'agent'})
//             return
//         }
//     }

//     //set selected value on accounts dropdown only
//     if($_.values(Type.route_name).includes(to.name)){
//         store.commit('account_management/accounts/setAccountRouteDropdown', to.name)
//     }

//     next()
// }
