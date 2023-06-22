<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'jenre' => 'required|unique:jenres'
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'jenre.required' => 'ジャンル名は入力必須です。',
            'jenre.unique' => 'ジャンル名が重複しています。'
        ];
    }
}
