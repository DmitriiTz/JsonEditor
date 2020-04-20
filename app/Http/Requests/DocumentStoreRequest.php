<?php

namespace App\Http\Requests;

class DocumentStoreRequest extends ApiRequest
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
     * Проверяем тип payload отправленного в Request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payload' => 'nullable|json'
        ];
    }
}
