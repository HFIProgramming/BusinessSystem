<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTransactionForm extends FormRequest
{
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
        return [
            //
            'resource_id' => 'integer|min:1',
            'seller_amount' => 'integer|min:1',
            'buyer_amount' => 'integer|min:1',
            'buyer_item' => 'integer|min:1',
            'seller_id' => 'bail|required_without:buyer_id|integer|min:1',
            'buyer_id' => 'bail|required_without:seller_id|integer|min:1'
        ];
    }
}
