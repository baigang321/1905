<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreAdminPost extends FormRequest
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
        return 
    [
        'admin_account' => 
        [
            'required',Rule::unique('admin')->ignore(request()->id,'admin_id')
        ],
            'admin_pwd'=>'required',
     ];
    }

        public function messages(){
            return [
                'admin_account.required' => '管理员必填',
                'admin_account.unique' => '管理员已存在',
                'admin_pwd.required' => '密码必填',
            ];
        }
}
