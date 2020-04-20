<?php

namespace App\Http\Requests;

use \Illuminate\Http\Request;

class DocumentUpdateRequest extends ApiRequest
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
     * Проверяем отправленные данные
     * если есть в массиве ключ payload
     * тогда проверяем его средствами laravel
     * если нет payload, то выкидываем ошибку 400
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if(array_key_exists('payload', $request->all())){
            return [
                'payload' => 'required|json'
            ];
        }
        return abort(400);
    }
}
