<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FinalizeOrderRequest extends Request
{

    protected $dontFlash = ['quantity'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach($this->input('quantity') as $key => $value) {
            $rules['quantity.' . $key] = 'enoughProducts';
        }
        return $rules;
    }

    /**
     * Set custom messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'enough_products' => 'Not enough products'
        ];
    }
}
