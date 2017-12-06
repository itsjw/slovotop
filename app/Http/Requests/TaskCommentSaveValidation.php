<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TaskCommentSaveValidation
 * @package App\Http\Requests
 */
class TaskCommentSaveValidation extends FormRequest
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
            'task'    => 'required|integer|not_in:0',
            'comment' => 'required',
            'user'    => 'required|integer|not_in:0',
        ];
    }
}
