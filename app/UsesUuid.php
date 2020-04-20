<?php

namespace App;

use Illuminate\Support\Str;

/**
 * Trait UsesUuid
 * @package App
 */
trait UsesUuid
{
    /**
     * При каждом создании модели, если есть первичный ключ - то
     * получаем имя первичного ключа этой модели и записываем в него
     * сгенерированный uuid приведённый к строковому типу
     */
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });
    }

    /**
     * Убираем авто инкремент
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Устанавливаем тип ключа как строку
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';

    }
}
