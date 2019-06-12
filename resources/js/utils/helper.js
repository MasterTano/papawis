import _ from 'lodash'

export default {

    showLoader(message) {
        if (!$_event) return
        $_event.fire(Type.event_type.show_loader, message)
    },

    hideLoader() {
        if (!$_event) return
        $_event.fire(Type.event_type.hide_loader)
    },

    //Convert Path to Pascal Case
    pascalize(path) {
        if (path.constructor.name !== 'String') throw new Error('pascalize function expects a string parameter.')
        return _.upperFirst(
            _.camelCase(
                // Strip the leading `'./` and extension from the filename
                path.replace(/^\.\/(.*)\.\w+$/, '$1')
            )
        )
    },

    isRegexSearchFound(string, regex) {
        return string.search(regex) !== -1
    },

	/**
	 * Require all components inside views folder per module
	 * @param module|String
	 */
    getViewComponent(module = '') {
        if (!module || module.constructor.name !== 'String') {
            throw new Error('getViewComponent function expects a string parameter!')
        }

        let regex = new RegExp(`${module}.*views`, 'g')

        return this.filterFilePathToRequire(regex, (require_files, filtered_path) => {
            // get filename here which will be used as component name
            let arr_component_name = []
            let components = {}

            filtered_path.forEach(file_path => {
                let componentName = this.getFilename(file_path)

                if (_.includes(arr_component_name, componentName)) {
                    throw new Error(`Duplicate component name! Please choose a unique filename for ${file_path}`)
                }
                arr_component_name.push(componentName)
            })

            // register components
            filtered_path.forEach(file_path => {
                let component_name = this.getFilename(file_path)
                let component_config = require_files(file_path)
                components[component_name] = component_config.default || component_config
            })

            return components
        })

    },

    getFilename(file_path, with_file_extension = false) {
        if (!file_path) throw new Error('getFilename function requires string file_path parameter.')
        let arr_file_path = file_path.split('/')
        let file_name = arr_file_path[arr_file_path.length - 1]
        if (with_file_extension) {
            return file_name
        }
        return file_name.replace(/\.\w+$/, '')
    },

	/**
	 * Require files from modules folder only
	 * Can't dynamically pass folder due to webpack require.context limitation
	 * @param filter_path_regex
	 * @param cb
	 * @returns {*}
	 */
    filterFilePathToRequire(filter_path_regex, cb) {
        const require_files = require.context('@', true, /\.(js|vue)$/)
        const paths = require_files.keys()

        const filtered_paths = _.filter(paths, (path) => {
            return this.isRegexSearchFound(path, filter_path_regex)
        })

        return cb(require_files, filtered_paths)
    },

	/**
	 * Require base files from base folder only
	 * Can't dynamically pass folder due to webpack require.context limitation
	 * @param filter_path_regex
	 * @param cb
	 * @returns {*}
	 */
    requireBaseFiles(filter_path_regex, cb) {
        const require_files = require.context('@', true, /\.(js|vue)$/)
        const paths = require_files.keys()

        const filtered_paths = _.filter(paths, (path) => {
            return this.isRegexSearchFound(path, filter_path_regex)
        })

        return cb(require_files, filtered_paths)
    },

    generatePassword() {
        let password = Math.random().toString(36).slice(-8)
        return password.padStart(8, '0')
    },

    /**
     * Search string by converting both searchString and value to search in to lower case
     * @param {String} searchString 
     * @param {String} value 
     * @return {Boolean}
     */
    isSearchStringFound(searchString, value) {
        return (value.toLowerCase().indexOf(searchString.toLowerCase())) !== -1
    },

	/**
	 * Build datatable's query parameter
	 * @param tableParams
	 * @param search
	 * @returns { start, length, order, search }
	 */
    buildDataTableQuery(tableParams, search = {}) {
        const OMIT_KEYS = ['is_advance_search']
        let paging = this.buildPagingQuery(tableParams)
        let order = this.buildOrderQuery(tableParams)
        let searchParams = this.buildSearchParams(search, OMIT_KEYS)
        let params = Object.assign({}, searchParams, paging, { order })

        this.buildDataExactQuery(params);//pass by reference

        return params;
    },

	/**
	 * Build datatable's exact query parameter. 
	 * @param params 	NOTE!!! Pass by reference
	 * @returns void
	 */
    buildDataExactQuery(params) {
        let exact_search = [];

        if (params.search.exact_search) {
            exact_search = typeof params.search.exact_search == 'object' ? params.search.exact_search : JSON.parse(params.search.exact_search);
            delete params.search.exact_search;

            params.exact_search = exact_search;
        }
    },

	/**
	 * Build datatables sorting query
	 * @param tableParams
	 * @returns {{column: *, dir: *}}
	 */
    buildOrderQuery(tableParams) {
        return {
            column: tableParams.sortBy,
            dir: this.getSortDirection(tableParams)
        }
    },

	/**
	 * Build datatables paging query
	 * @param tableParams
	 */
    buildPagingQuery(tableParams) {
        let page = tableParams.page
        let length = tableParams.rowsPerPage

        let retVal = {}
        // let total = this.total_items
        retVal.length = length
        //logic for paging
        if (page > 1) {
            retVal.start = ((page - 1) * length)
            return retVal
        }
        retVal.start = 0
        return retVal
    },

	/**
	 * Get datatable's sorting direction
	 * @param tableParams
	 * @returns {string}
	 */
    getSortDirection(tableParams) {
        return (tableParams.descending) ? 'desc' : 'asc'
    },

	/**
	 *  Build search params and omit keys from search params
	 * @param {*} searchParams 
	 * @param {*} keys 
	 */
    buildSearchParams(searchParams, keys) {
        let search = _.omit(searchParams, keys)
        let otherParams = {}
        if (_.get(searchParams, 'is_advance_search')) {
            otherParams.is_advance_search = true
        }
        return Object.assign({}, { search }, otherParams)
    },

	/**
	 * Concatenate url to avoid double slash
	 * @param first
	 * @param last
	 * @returns {string}
	 */
    concatUrl(first = '', last = '') {
        first = `${first}`.replace(/\/+$/i, "");
        last = `${last}`.replace(/^[/]+/i, "");
        return `${first}/${last}`
    },

    /**
     * Checker if the object is empty
     * @param obj
     * @returns {boolean}
     */
    isEmptyObject(obj) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key))
                return false;
        }
        return true;
    },

	/**
	 * Remove falsy values in an object
	 * @param {Object} obj 
	 */
    removeFalsy(obj) {
        let newObj = {};
        Object.keys(obj).forEach((prop) => {
            if (obj[prop]) { newObj[prop] = obj[prop]; }
        });
        return newObj;
    },

	/**
	 * Generate numbers as string starting from to maxNumber
	 * @param {Number} maxNumber 
	 * @param {Boolean} isZeroPadded 
	 */
    generateTimeNumberArray(maxNumber = 12, isZeroPadded = true) {
        let arr = []
        let padding = (isZeroPadded) ? '0' : ''
        for (let x = 0; x <= maxNumber; x++) {
            arr.push(`${x}`.padStart(2, padding))
        }
        return arr
    }
}
