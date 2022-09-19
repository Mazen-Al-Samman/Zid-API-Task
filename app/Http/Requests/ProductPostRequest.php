<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductPostRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title.en' => ['required', 'string'],
            'title.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'description.ar' => ['required', 'string'],
            'vat_type' => [Rule::in([Product::VAT_FIXED, Product::VAT_PERCENTAGE])],
            'vat_value' => [Rule::requiredIf(function () {
                return !empty($this->vat_type);
            })]
        ];
    }
}
