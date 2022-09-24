<?php

namespace App\Http\Requests;

class CartPostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:product,id']
        ];
    }

}
