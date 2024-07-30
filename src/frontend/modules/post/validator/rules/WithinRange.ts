import AbstractValidator from "../contracts/AbstractValidator";

export class WithinRange extends AbstractValidator
{
    validate(): boolean {
        if (this.value.length > 255) {
            this.setError(this.fieldName + " contains too many symbols.")
            return false;
        }
        return true;
    }
}