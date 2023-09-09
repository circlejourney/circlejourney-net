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
            $exceptions = $term["exceptions"] ?? [];
            $eachexception = [];

            foreach($exceptions as $i=>$exception) {
                $exceptpattern = "/" . str_replace( "*", "(?:".$term["match"].")", $exception ) . "/";
                preg_match_all($exceptpattern, $string, $eachexception[$i], PREG_OFFSET_CAPTURE);
                if(!isset($eachexception[$i][0])) continue;

                foreach( $eachexception[$i] as $excepttriggers ) {
                    foreach($excepttriggers as $except) {
                        $mask = str_repeat("%", strlen($except[0]));
                        $string = substr_replace($string, $mask, $except[1], strlen($except[0]));
                    }
                }
            }
            
            preg_match_all("/".$term["match"]."/" , $string, $triggerlist, PREG_OFFSET_CAPTURE);
            foreach($triggerlist as $triggers) {
                foreach($triggers as $trigger) {
                    $replacement = str_repeat("*", strlen($trigger[0]));
                    $string = substr_replace($string, $replacement, $trigger[1], strlen($trigger[0]));
                }
            }
            
            foreach($eachexception as $exceptiongroup) {
                foreach($exceptiongroup as $excepttriggers) {
                    foreach($excepttriggers as $except) {
                        $string = substr_replace($string, $except[0], $except[1], strlen($except[0]));
                    }
                }
            }

        }

        $string = preg_replace(
            ["/<\/?(script|style|link|meta|title|button|form|input)[^>]*>/", "/(<\/?.*)\son[A-Za-z]+\=\".*\"([^>]*>)/"],
            ["", "$1$2"],
            $string);
        return $string;
    }
}
