<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProjectSaveValidation
 * @package App\Http\Requests
 */
class ProjectSaveValidation extends FormRequest
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
            'name'    => 'required',
            'user_id' => [
                'required',
                Rule::unique('user_roles')->where(function ($query) {
                    return $query->where('role_id', 1);
                }),
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.unique' => trans('data.projNoAdmin'),
        ];
    }
}
