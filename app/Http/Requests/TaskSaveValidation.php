<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class TaskSaveValidation
 * @package App\Http\Requests
 */
class TaskSaveValidation extends FormRequest
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
            'name'            => 'required',
            'user_id' => [
                'required',
                Rule::unique('user_roles')->where(function ($query) {
                    return $query->where('role_id', 1);
                }),],
            //'author'      => 'required',
            'dateEnd'         => 'required',
            //'desc'        => 'required',
            //'editor'      => 'required',
            //'moreData'    => 'required',
            //'price'       => 'required',
            'project'         => 'required',
            'subject'         => 'required',
            'task'            => 'required|min:10',
            //'textBody'    => 'required',
            //'textMax'     => 'required',
            //'textMin'     => 'required',
            //'textPreview' => 'required',
            //'textUnique'  => 'required',
            //'textUrl'     => 'required',
            //'title'       => 'required',
            'words'           => 'required|min:10',
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
