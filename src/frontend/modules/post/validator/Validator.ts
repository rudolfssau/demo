import AbstractValidator from "./contracts/AbstractValidator";

export class Validator
{
    /**
     * @description Used to store existing SKU values from the database.
     * @protected
     */
    protected existingSKU: [];

    /**
     * @description Storage for errors present in any of defined rules.
     */
    private errorMessages: string;

    /**
     * @description Gets SKU values from the frontend, later to be assigned in this context.
     * @param skuArray
     */
    public fetchSKU(skuArray: []): void
    {
        this.existingSKU = skuArray;
    }

    /**
     *
     * @description Used to handle validation for array of specified rules. This function takes in three parameters:
     * fieldType - defines the field name for use later in displaying errors, value - defined the value which will be validated, and
     * rules - which take an array of validation rules which later get applied to the "value" element.
     *
     * @param fieldType
     * @param value
     * @param rules
     */
    public handle(fieldType: string, value: string, rules: any[]): void|boolean
    {
        for (const object of rules) {
            const newInstance = new object(value, fieldType, this.existingSKU);
            if (newInstance instanceof AbstractValidator) {
                if (!newInstance.validate()) {
                    this.errorMessages = newInstance.getError();
                    break;
                }
            } else {
                alert("An error has occurred, please reload the page!");
                break;
            }
        }
    }

    /**
     * @description Used to get error information from each validation rule
     * @description stored inside of "errorMessages".
     */
    public getErrors(): string
    {
        return this.errorMessages;
    }

    /**
     * @description Checks if there are no error present in the "errorMessages" variable.
     */
    public isValid(): boolean
    {
        return !this.errorMessages;
    }
}