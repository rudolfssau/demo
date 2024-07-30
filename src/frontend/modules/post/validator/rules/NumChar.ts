import AbstractValidator from "../contracts/AbstractValidator";

export class NumChar extends AbstractValidator
{
    /**
     * @description Used to check if a string contains only characters
     * @protected
     */
    protected charRegex: RegExp = /^[A-Za-z0-9\s]*$/;

    validate(): boolean {
        if (!this.charRegex.test(this.value)) {
            this.setError("The field " + this.fieldName.toLowerCase() + " can only consist from characters and numeric values!");
            return false;
        }
        return true;
    }
}