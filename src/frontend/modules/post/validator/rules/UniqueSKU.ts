import AbstractValidator from "../contracts/AbstractValidator";

export class UniqueSKU extends AbstractValidator
{
    validate(): boolean {
        const isUnique = this.existingSKU.every((skuValue) => {
            return this.value !== skuValue;
        });
        if (!isUnique) {
            this.setError("Field " + this.fieldName.toLowerCase() + " must be unique.");
        }
        return isUnique;
    }
}