import AbstractValidator from "../contracts/AbstractValidator";

export class NotEmpty extends AbstractValidator
{
    validate(): boolean {
        if (this.value.length == 0) {
            this.setError("Please fill out the field " + this.fieldName.toLowerCase() + "!");
            return false;
        }
        return true;
    }
}