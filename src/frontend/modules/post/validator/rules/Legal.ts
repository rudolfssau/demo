import AbstractValidator from "../contracts/AbstractValidator";

export class Legal extends AbstractValidator
{
    /**
     * @description Used to check if a string contains illegal characters
     * @private specialCharRegex
     */
    private specialCharRegex: RegExp = /[ `!@#$%^&*()_+\-=[\]{};':"\\|,<>/?~]/;

    validate(): boolean {
        if (this.specialCharRegex.test(this.value)) {
            this.setError("Field " + this.fieldName.toLowerCase() + " contains illegal characters!");
            return false;
        }
        return true;
    }
}