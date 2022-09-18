<?php

namespace App\Http\Requests;

class StoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name.en' => ['required', 'string'],
            'name.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'description.ar' => ['required', 'string'],
            'category_id' => ['required', 'alpha_num', 'exists:category,id']
        ];
    }

    public function withValidator($validator)
    {
        // No Need to prevent user from creating a shop if the action is update!.
        if ($this->route()->getActionMethod() == 'update') return;

        $validator->after(function ($validator) {
            // If user have a shop already.
            if (!empty(auth()->user()->store)) {
                $validator->errors()->add('Error', "User can't create more than one store!");
            }
        });
    }
}
