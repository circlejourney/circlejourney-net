<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class TextUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $body = $this->transform($this->request->get("body"));
        $this->request->set("body", $body);
        return [
            'title' => ['string', 'max:255'],
            'body' => ['string']
        ];
    }

    protected function transform($string) {
        $profanity = json_decode(
            File::get(base_path('resources'.DIRECTORY_SEPARATOR.'profanity.json')),
            true
        );
        foreach($profanity as $term) {
            $exceptions = $term["exceptions"] ?? false;
            
            if($exceptions) {
                $exception_strings = array_map(function($i)use($term){
                    return str_replace("*", $term["match"], $i);
                }, $exceptions);
                $string = str_replace(
                    $exception_strings, $exceptions, $string
                );
            }

            $string = preg_replace("/".$term["match"]."/", "[CENSORED]", $string);
            $string = str_replace("*", $term["match"], $string);

        }

        $string = preg_replace(
            ["/<\/?(script|style|link|meta|title|button|form|input)[^>]*>/", "/(<\/?.*)\son[A-Za-z]+\=\".*\"([^>]*>)/"],
            ["", "$1$2"],
            $string);
        return $string;
    }
}
