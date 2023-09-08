<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TextUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $this->request->set(
            "body",
            preg_replace(["/<\/?(a\s|script|style|link|meta|title)[^>]*>/"], "", $this->request->get("body")
            )
        );
        return [
            'title' => ['string', 'max:255'],
            'body' => ['string']
        ];
    }
}
