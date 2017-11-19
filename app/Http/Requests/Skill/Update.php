<?php

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'slug' => 'required|string|max:15|unique:skills,slug,'.$this->skill->id,
            'description' => 'string|max:255',
        ];
    }
}
