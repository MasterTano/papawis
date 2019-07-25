let defaultAxiosOptions = {
    method: 'get',
}

let defaultApiOptions = {
    data_path: '',
}

export default class Api {
    constructor(axiosOptions = defaultAxiosOptions, apiOptions = defaultApiOptions) {
        this.axiosOptions = axiosOptions
        this.apiOptions = apiOptions
    }

    async call() {
        try {
            let response = await $_axios(this.axiosOptions)
            return this.successBuilder(response)
        } catch (error) {
            return this.errorBuilder(error)
        }
    }

    successBuilder(response) {
        console.log('tano successBuilder response :', response)

        //default dataPath
        let dataPath = 'data'

        //if data_path is set, use dataPath
        if (_.get(this.apiOptions, 'data_path')) {
            dataPath = _.get(this.apiOptions, 'data_path')
        }

        let responseData = _.get(response, dataPath, null)
        if (!responseData) {
            responseData = response
        }

        return  {
            success: true,
            data: responseData
        }
    }

    errorBuilder(error) {
        console.log('tano errorBuilder error :', error.response)
        let response = error.response
        return {
            success: false,
            code: _.get(response, 'status'),
            message: _.get(response, 'data.message') || _.get(response, 'statusText'),
            field_errors: _.get(response, 'data.errors') || []
        }
    }
}
