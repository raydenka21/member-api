<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Awards;

class AwardsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $getAwards = Awards::get('type')->toArray();
        $all[] = 'all';
        foreach ($getAwards as $value){
            $listAwards[]= $value['type'];
        }
        $merge=array_merge($listAwards,$all);

        $inAwards = implode(",",$merge);
        return [
            'type' =>  ["required","in:$inAwards"],
            'start' => ['required', 'numeric'],
            'start_point' => ['nullable', 'numeric'],
            'end_point' => ['nullable', 'numeric'],
            'limit' => ['required', 'numeric','max:100']
        ];
    }
    protected function failedValidation(Validator $validator) : object
    {

        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
