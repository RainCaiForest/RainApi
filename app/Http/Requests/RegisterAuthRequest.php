<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterAuthRequest extends FormRequest
{
    /**
     * 确定是否授权用户发出此请求
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取应用于请求的验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $error= $validator->errors()->all();
        throw new HttpResponseException($this->fail(400, $error));
    }

    protected function fail(int $code, array $errors) : JsonResponse
    {
        return response()->json(
            [
                'code' => $code,
                'errors' => $errors,
            ]
        );
    }

}
