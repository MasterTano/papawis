import Vue from 'vue'
import helper from '@/helpers/helper'

const _require_file = function (require_context, filtered_paths) {
    let ret_val = {}
    filtered_paths.forEach((path) => {
        let store = require_context(path)
        for (let module_name in store) {
            ret_val[module_name] = store[module_name]
        }
    })
    return ret_val;
}

export const registerGlobalComponents = () => {
    const requireComponent = require.context('@/base/components', true, /\.(vue)$/)

    requireComponent.keys().forEach(fileName => {
        // Get component config
        const componentConfig = requireComponent(fileName)
        // Get PascalCase name of component
        const componentName = helper.pascalize(fileName)
        // Register component globally
        Vue.component(componentName, componentConfig.default || componentConfig)
    })
}

export const getModuleRoutes = () => {
    return helper.filterFilePathToRequire(/(router\/index.js)/g, (require_context, filtered_paths) => {
        const routes = []
        filtered_paths.forEach((path, key) => {
            const route = require_context(filtered_paths[key])
            routes.push(route.default[0])
        })
        return routes
    })
}

export const getModuleStores = () => {
    return helper.filterFilePathToRequire(/(store\/index.js)/g, function (require_context, filtered_paths) {
        return _require_file(require_context, filtered_paths)
    })
}

export const getBaseStores = () => {
    return helper.requireBaseFiles(/(store\/.*.js)/g, function (require_context, filtered_paths) {
        return _require_file(require_context, filtered_paths)
    })
}



