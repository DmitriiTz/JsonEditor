<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App
 */
class Document extends Model
{
    /**
     * Трейт добавляющий генерацию uuid поля к модели
     */
    use UsesUuid;

    /**
     * Поля в которые можно сохранять в базу данных через модель
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Поля в которые нельзя сохранять в базу данных через модель
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Приведение типов, которые даёт модель на выходе
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'payload' => 'json'
    ];
}
