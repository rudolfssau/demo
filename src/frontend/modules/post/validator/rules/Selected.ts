import AbstractValidator from "../contracts/AbstractValidator";

export class Selected extends AbstractValidator
{
    validate(): boolean {
        if (this.value == "none") {
            this.setError("Please make sure that a value is selected from the dropdown!")
            return false;
        }
        return true;
    }
}