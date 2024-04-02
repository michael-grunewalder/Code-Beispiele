<?php

namespace Modules\Warengruppen\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarengruppenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nummer' => 'required:string',
            'bezeichnung' => 'required:string',
            'type' => 'required|integer|min:1|max:3',
            'dk_main_cat' =>'nullable|integer',
            'dk_sub_cat' =>'nullable|integer',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
