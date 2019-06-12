class FormErrors {
    /**
     * Create a new Errors instance.
     */
    constructor() {

    }


    /**
     * Determine if an error exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        return this.hasOwnProperty(field);
    }


    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field) {
        if (this[field]) {
            return this[field][0];
        }
    }


    /**
     * Record the new errors.
     *
     * @param {object} list
     */
    record(errors) {
        this.original_data = errors;
        for (let field in errors) {
            this[field] = errors[field];
        }
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this[field];
            return;
        }

        for (let field in this.original_data) {
            delete this[field];
        }
    }
}

export default FormErrors;
