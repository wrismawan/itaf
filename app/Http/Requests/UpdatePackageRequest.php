<?php

namespace App\Http\Requests;

use App\Models\Package;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePackageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('package_edit');
    }

    public function rules()
    {
        return [
            'name'      => [
                'string',
                'required',
                'unique:packages,name,' . request()->route('package')->id,
            ],
            'url'       => [
                'required',
            ],
            'passcode'  => [
                'string',
                'required',
                'unique:packages,passcode,' . request()->route('package')->id,
            ],
            'author_id' => [
                'required',
                'integer',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
