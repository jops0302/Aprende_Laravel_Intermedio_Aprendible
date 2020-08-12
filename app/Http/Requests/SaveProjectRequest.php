<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProjectRequest extends FormRequest
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

       
        return [
            'title' => 'required',
            'url' => ['required', 

            Rule::unique('projects')->ignore( $this->route('project') )
        ],

            'category_id' => ['required',
            'exists:categories,id'
        ],
            'image' => [ $this->route('project') ? 'nullable' : 'required', 
            'mimes:jpeg,png'],
            // 'dimensions:min_width=400,min_height=200' o puede ser el ratio=16/4  tambien max], //si utilizamos 'image' nos dejara ingresar todo tipo de imagenes pero si ponemos mimes y despues dos puntos colocamos los tipos de images que queremos que suba sera un poco mas claro
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El proyecto necesita un titulo'
        ];
    }
}
