<?php

namespace App\Http\Controllers\Api\v1;

use App\Document;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

/**
 * Class DocumentController
 * @package App\Http\Controllers\Api\v1
 */
class DocumentController extends Controller
{
    /**
     * Получить все документы отсортированные по новизне с пагинацией в 20 на одной странице
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Document::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Создать документ только из прошедших валидацию данных
     * и вернуть этот документ
     *
     * @param DocumentStoreRequest $request
     * @return JsonResponse
     */
    public function store(DocumentStoreRequest $request): JsonResponse
    {
        $document = Document::create($request->validated());

        return response()->json($document);
    }

    /**
     * Показать документ по его uuid
     * если документ не найден, выкидываем ошибку 404
     *
     * @param Document $document
     * @return JsonResponse
     */
    public function show(Document $document): JsonResponse
    {
        if ($document instanceof Document) {
            return response()->json($document);
        }
        return abort(404);
    }

    /**
     * Обновить документ только из прошедших валидацию данных
     * и если документ уже не опубликован, иначе выкидываем 400
     *
     * @param DocumentUpdateRequest $request
     * @param Document $document
     * @return JsonResponse
     */
    public function update(DocumentUpdateRequest $request, Document $document): JsonResponse
    {
        Gate::denies('publish', $document);

        $document->update($request->validated());
        return response()->json($document);
    }

    /**
     * Удалить документ по его uuid
     * если успешно, вернуть true
     * иначе false
     *
     * @param Document $document
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Document $document): JsonResponse
    {
        return response()->json($document->delete());
    }

    /**
     * Документ публикуется если уже не опубликован, иначе выкидывает 200
     * возвращает объект опубликованного документа
     *
     * @param Document $document
     * @return JsonResponse
     */
    public function publish(Document $document): JsonResponse
    {
        Gate::denies('publish', $document);
        $document->update(['status' => 'published']);
        return response()->json($document);
    }
}
