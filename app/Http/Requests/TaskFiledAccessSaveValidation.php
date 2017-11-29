<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaskFiledAccessSaveValidation
 * @package App\Http\Requests
 */
class TaskFiledAccessSaveValidation extends FormRequest
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
            'access' => 'required',
            'stage'  => 'required|not_in:0',
            'field'  => 'required',
        ];
    }
}
