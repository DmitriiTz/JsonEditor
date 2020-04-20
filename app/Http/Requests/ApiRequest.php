<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiRequest
 * @package App\Http\Requests\Api
 */
class ApiRequest extends FormRequest
{
    /**
     * Получаем объект ошибок валидатора и создаём
     * Http ошибку с данными ошибок Validator со статусом 422
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse($validator->errors(), 422));
    }
}