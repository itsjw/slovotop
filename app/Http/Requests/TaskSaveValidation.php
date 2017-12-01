<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'        => 'required',
            'user'        => 'required',
            'author'      => 'required',
            'dateEnd'     => 'required',
            'desc'        => 'required',
            'editor'      => 'required',
            'moreData'    => 'required',
            'price'       => 'required',
            'project'     => 'required',
            'subject'     => 'required',
            'task'        => 'required',
            'textBody'    => 'required',
            'textMax'     => 'required',
            'textMin'     => 'required',
            'textPreview' => 'required',
            'textUnique'  => 'required',
            'textUrl'     => 'required',
            'title'       => 'required',
            'words'       => 'required',
        ];
    }
}
