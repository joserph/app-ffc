<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMasterInvoiceItemRequest extends FormRequest
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
            'id_invoiceh'       => 'required',
            'id_client'         => 'required',
            'id_farm'           => 'required',
            'id_load'           => 'required',
            'variety_id'        => 'required',
            'hawb'              => 'required|alpha_num',
            'pieces'            => 'required',
            'hb'                => '',
            'qb'                => '',
            'eb'                => '' ,
            'stems'             => 'required',
            'price'             => 'required|numeric',
            'bunches'           => 'required',
            'fulls'             => 'required',    
            'total'             => 'required|numeric',
            'id_user'           => 'required',
            'update_user'       => 'required',
            'stems_p_bunches'   => 'required'
        ];
    }
}
