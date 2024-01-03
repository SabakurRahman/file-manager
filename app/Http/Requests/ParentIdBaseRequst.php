<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ParentIdBaseRequst extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public ?File $parent = null;
    public function authorize(): bool
    {
        $this->parent =File::query()->where('id','=',$this->parent_id)->first();
        if($this->parent && !$this->parent->isOwnedBy(Auth::id()))
        {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'parent_id' => [
                Rule::exists('files', 'id')->where(function ( Builder $query)
                {
                   return $query->where('is_folder','=','1')->
                    where('created_by','=',Auth::id());
                })
            ]
        ];
    }
}
