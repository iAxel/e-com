<?php

namespace App\Http\Requests\Main;

use App\Http\Requests\Request as BaseRequest;

final class UserRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'int'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],

            'created_at' => ['nullable', 'array:from,to', 'size:2'],
            'created_at.from' => ['required_with:created_at', 'date', 'before:created_at.to'],
            'created_at.to' => ['required_with:created_at', 'date', 'after:created_at.from'],

            'updated_at' => ['nullable', 'array:from,to', 'size:2'],
            'updated_at.from' => ['required_with:updated_at', 'date', 'before:updated_at.to'],
            'updated_at.to' => ['required_with:updated_at', 'date', 'after:updated_at.from'],

            'sort' => ['nullable', 'array:by,type', 'size:2'],
            'sort.by' => ['required_with:sort', 'string', 'max:255', 'in:id,name,email,created_at,updated_at'],
            'sort.type' => ['required_with:sort', 'string', 'max:255', 'in:asc,desc'],
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->only([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
            'sort',
        ]);
    }
}
