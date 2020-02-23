<?php

namespace App\Http\Requests\Articlees;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleeRequest extends FormRequest
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
                'title' => 'required|unique:articlees',
                'content' => 'required',
                 'published_at' => 'required'
            ];
    }
}
