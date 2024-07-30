/**
 *
 * This abstract class is used to create a new validation rule in the application.
 *
 * @interface AbstractValidator
 * @description To successfully implement a new validation method you must provide a constructor() inside of the validation rule to set the value of the "value" string.
 *
 */
export default abstract class AbstractValidator
{
    /**
     * @description Errors parsed form validation rules.
     */
    protected error: string;

    /**
     * @description Initial value.
     */
    protected value: string;

    /**
     * @description Used to store the type of field that is being validated. This is later used for the error message.
     */
    protected fieldName: string;

    /**
     * @description Used to store value of "SKU" elements parsed from database.
     */
    protected existingSKU: [];

    /**
     * @description Sets value inside of this.value.
     * @param value
     * @param fieldName
     * @param SKUArray
     */
    protected constructor(value: string, fieldName: string, SKUArray: []) {
        this.value = value;
        this.fieldName = fieldName;
        this.existingSKU = SKUArray;
    }

    /**
     * @description Used to send error messages to frontend, to be processed.
     * @param errorMessage
     */
    public setError(errorMessage: string): void {
        this.error = errorMessage;
    }

    /**
     * @description Used to return string of errors to later get processed.
     */
    public getError(): string
    {
        return this.error;
    }

    /**
     * @description Validation logic goes inside of here.
     */
    public abstract validate(): boolean;
}