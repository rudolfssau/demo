import AbstractValidator from "../contracts/AbstractValidator";

export class Numeric extends AbstractValidator
{
    /**
     * @description Used to check if a string contains only numeric characters
     * @private numRegex
     */
    protected numRegex: RegExp = /^[+-]?\d+(\.\d+)?$/;

    validate(): boolean {
        if (!this.numRegex.test(this.value)) {
            this.setError(this.fieldName + " must be numeric and, in case of delimiter use - only use dot separator!");
            return false;
        }
        return true;
    }
}