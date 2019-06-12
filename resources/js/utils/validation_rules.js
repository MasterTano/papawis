//DEFINE CONSTANTS HERE
const DEFAULT_FIELD_NAME = `This field`
const EMAIL_REGEX =  /^[a-zA-Z0-9\.\_]+@[a-zA-Z0-9]+(\-)?[a-zA-Z0-9]+(\.)?[a-zA-Z0-9]{2,6}?\.[a-zA-Z]{2,6}$/
const PASSWORD_REGEX = /^(?=.*\d)(?=.*[a-zA-Z])([^\s]){8,50}$/
const USERNAME_MIN_VALUE = 6
const NAME_REGEX = /^[\u4e00-\u9effA-Za-z\.\_\-\ \'\ñ\Ñ]+$/
const USERNAME_REGEX = /^[A-Za-z0-9\.\_]+$/

export default {
    required(v, fieldName = DEFAULT_FIELD_NAME){
        return !!v || `${fieldName} is required.`
    },
    email(v, fieldName = DEFAULT_FIELD_NAME){
        return EMAIL_REGEX.test(v) || `${fieldName} must be a valid email.`
    },
    password(v, fieldName = DEFAULT_FIELD_NAME){
        return PASSWORD_REGEX.test(v) || `${fieldName} must be 8 or more alphanumeric or special characters.`
    },

    name(v, fieldName = DEFAULT_FIELD_NAME){
        return NAME_REGEX.test(v) || `${fieldName} may contain letters, apostrophes, dashes, spaces and periods only.`
    },

    username(v, fieldName = DEFAULT_FIELD_NAME){
        return USERNAME_REGEX.test(v) || `${fieldName} may contain letters, numbers, underscores and periods only.`
    },
    // numeric(v, fieldName = DEFAULT_FIELD_NAME){
    //     return PASSWORD_REGEX.test(v) || `${fieldName} must be 8 alphanumeric or special characters.`
    // },

    //checks minimum string characters
    minLength(v, minLength = 0, fieldName = DEFAULT_FIELD_NAME){
        return String(v).length >= minLength || `${fieldName} must be minimum of ${minLength} characters.`
    },
    //checks maximum string characters
    maxLength(v, maxLength = 200, fieldName = DEFAULT_FIELD_NAME){
        return String(v).length <= maxLength || `${fieldName} must be maximum of ${maxLength} characters.`
    },

}
