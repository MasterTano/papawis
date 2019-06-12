import Errors from './FormErrors'
import Type from './static_types'

const MODE_ADD = Type.form_mode.add
const MODE_EDIT = Type.form_mode.edit

class Form {


    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.original_data = data
        for (let field in data) {
            this[field] = data[field]
        }
        this.mode = MODE_ADD
        this.loading = false
        this.errors = new Errors()
    }

    /**
     * Set data for the form.
     */
    set(data) {
        for (let property in this.original_data) {
            if (data[property]) {
                this[property] = data[property]
            } else {
                this[property] = ''
            }
        }
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {}

        for (let property in this.original_data) {
            data[property] = this[property]
        }

        return data
    }

    /**
     * Reset the form as if it is newly created
     */
    reset(){
        this.setToAddMode()
        this.clear()
    }

    /**
     * clear the form fields and error messages.
     */
    clear() {
        for (let field in this.original_data) {
            this[field] = this.original_data[field]
        }
        this.errors.clear()
    }

    /**
     * Fill the form fields.
     */
    fill(data) {
        for (let field in this.original_data) {
            this[field] = $_.get(data, field, '')
        }
        this.setToEditMode()
        this.errors.clear()
    }

    /**
     * Set loading status
     */
    setLoading(status = false) {
        this.loading = status
    }

    toggleLoading() {
        this.loading = !this.loading
    }

    /**
     * Set mode to add
     */
    setToAddMode(){
        this.mode = MODE_ADD
    }

    /**
     * Set mode to edit
     */
    setToEditMode(){
        this.mode = MODE_EDIT
    }

}

export default Form
