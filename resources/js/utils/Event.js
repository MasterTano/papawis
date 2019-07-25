import Vue from 'vue'

export default class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        this.vue.$emit(event, data)
    }

    listen(event, callback = function(){}) {
        this.vue.$on(event, callback)
    }

    destroy(event, callback = function(){}){
        this.vue.$off(event, callback)
    }
}
