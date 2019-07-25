import BaseApi from './Api'

function executeBeforeSubmit(componentContext){
    let func = _.get(componentContext, 'beforeSubmit')
    if(!func || !_.isFunction(func)) return false
    func()
}

function executeAfterSubmit(componentContext, response){
    let func = _.get(componentContext, 'afterSubmit')
    if(!func || !_.isFunction(func)) return false
    func(response)
}

function getComponentContext(axiosOptions) {
    let context = _.get(axiosOptions, 'data.component_context', null)
    if(!context) {
        context = _.get(axiosOptions, 'params.component_context', null)
    }
    return context
}

function filterAxiosOptions(axiosOptions) {
    let filteredOptions = axiosOptions
    if (_.get(filteredOptions, 'data.component_context')) {
        filteredOptions.data = _.omit(filteredOptions.data, 'component_context')
    }
    if (_.get(filteredOptions, 'params.component_context')) {
        filteredOptions.params = _.omit(filteredOptions.params, 'component_context')
    }
    return filteredOptions
}

async function callApi(axiosOptions = {}, apiOptions = {}){
    console.log('axiosOptions', axiosOptions)
    console.log('apiOptions', apiOptions)

    let filteredAxiosOptions = filterAxiosOptions(axiosOptions)
    let api = new BaseApi(filteredAxiosOptions, apiOptions)

    let componentContext = getComponentContext(axiosOptions)
    executeBeforeSubmit(componentContext)
    let response = await api.call()
    executeAfterSubmit(componentContext, response)

    return response
}

export default {
    get(endpoint, axiosOptions = {}, apiOptions = {}){
        axiosOptions.method = 'get'
        axiosOptions.url = endpoint
        return callApi(axiosOptions, apiOptions)
    },
    post(endpoint, axiosOptions = {}, apiOptions = {}){
        axiosOptions.method = 'post'
        axiosOptions.url = endpoint
        return callApi(axiosOptions, apiOptions)
    },
    put(endpoint, axiosOptions = {}, apiOptions = {}){
        axiosOptions.method = 'put'
        axiosOptions.url = endpoint
        return callApi(axiosOptions, apiOptions)
    },
    patch(endpoint, axiosOptions = {}, apiOptions = {}){
        axiosOptions.method = 'patch'
        axiosOptions.url = endpoint
        return callApi(axiosOptions, apiOptions)
    },
    delete(endpoint, axiosOptions = {}, apiOptions = {}){
        axiosOptions.method = 'delete'
        axiosOptions.url = endpoint
        return callApi(axiosOptions, apiOptions)
    },
}
