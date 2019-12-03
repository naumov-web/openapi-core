<?php

namespace App\Http\Requests\Core\Account;

use App\Http\Requests\Core\Account\BaseAccountRequest;

/**
 * Class ListRequest
 * @package App\Http\Requests\Core\Account
 */
class ListRequest extends BaseAccountRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'sort_by' => 'string',
            'sort_direction' => 'string|in:asc,desc',
        ];
    }
}
