<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\Request as BaseRequest;

final class Request extends BaseRequest
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
        return [];
    }
}
