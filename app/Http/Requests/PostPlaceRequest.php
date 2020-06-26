<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostPlaceRequest extends FormRequest
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
            'name' => ['required', 'max:20'],
            'image' => [
            'file', // ファイルがアップロードされている
            'image', // 画像ファイルである
            'mimes:jpeg,png', // 形式はjpegかpng
            'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000', // 50*50 ~ 1000*1000 まで
            ],
            'information' => ['nullable', 'max:200'],
            'lat' => ['required'],
            'lng' => ['required'],
        ];
    }
}
