<?php

namespace App\Http\Controllers\Web\Admin\Users\Requests;


use Auth;
use App\Http\Requests\FormRequest;

/**
 * Class UpdateUserRequest
 * @package App\Http\Controllers\Web\Admin\Users\Requests
 */
class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // ToDo: добавить проверку остальных полей + сравнение пароля и подтверждения
        return [
            // @ToDo: узнать, откуда сдесь взялся user. Похоже на магию.
            'email' => 'required|unique:users,email,' . $this->user->id . '|max:100',
            'phone' => 'required|unique:users,phone,' . $this->user->id . '|max:30',
            'name' => 'required:users,name',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFormData();
        $data['updated_user_id'] = Auth::id(); //@ToDo добавить поле updated_user_id в миграцию

        if ($this->hasFile('avatar')) {
            $data['avatar_uploaded_file'] = $this->file('avatar');
        }

        return $data;
    }
}
