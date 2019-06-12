import {createNamespacedHelpers} from 'vuex'
import {createHelpers} from 'vuex-map-fields'

// export let {
//     mapState: mapEndpointState,
//     mapActions: mapEndpointActions,
//     mapMutations: mapEndpointMutations,
//     mapGetters: mapEndpointGetters,
// } = createNamespacedHelpers('endpoint')

let vuex_mapper = {};

function buildVuexMapper(vuex_mapper, module){
    let map_types = ['State', 'Getters', 'Actions', 'Mutations']
    let mapHelper = createNamespacedHelpers(module.namespace)

    for (let type of map_types) {
        let map_orig_name = `map${type}`
        let map_namespaced_name = `map${module.name}${type}`
        vuex_mapper[map_namespaced_name] = mapHelper[map_orig_name]
    }
}

//for vuex-map-fiels two way binding
function buildMapFieldsHelper(vuex_mapper, module){
    let mapFieldsHelper = createHelpers({
        getterType: `${module.namespace}/getField`,
        mutationType: `${module.namespace}/updateField`
    })
    vuex_mapper[`map${module.name}Fields`] = mapFieldsHelper['mapFields']
}

//createMapper function will dynamically create namespacedHelper for mapping vuex properties
(function () {
    let modules = [
        {name: 'Account', namespace: 'account_management/accounts'},
    ]

    for (let module of modules) {
        //for vuex-map-fields
        buildMapFieldsHelper(vuex_mapper, module)
        //for vuex properties (state, getters, actions, mutations
        buildVuexMapper(vuex_mapper, module)
    }
}())

export default vuex_mapper
