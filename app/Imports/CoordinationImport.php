<?php

namespace App\Imports;

use App\Coordination;
use Maatwebsite\Excel\Concerns\ToModel;

class CoordinationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Coordination([
            'hawb'  => $row['hawb'],
            'pieces' => $row['pieces'],
            'hb'    => $row['hb'],
            'qb'  => $row['qb'],
            'qb' => $row['qb'],
            'fulls'    => $row['fulls'],
            'hb_r'  => $row['hb_r'],
            'qb_r' => $row['qb_r'],
            'eb_r'    => $row['eb_r'],
            'pieces_r'  => $row['pieces_r'],
            'fulls_r' => $row['fulls_r'],
            'missing'    => $row['missing'],
            'returns'  => $row['returns'],
            'id_client' => $row['id_client'],
            'id_farm'    => $row['id_farm'],
            'id_load'  => $row['id_load'],
            'variety_id' => $row['variety_id'],
            'id_user'    => $row['id_user'],
            'update_user'  => $row['update_user'],
            'created_at' => $row['created_at'],
            'created_at'    => $row['created_at'],
            'id_marketer'  => $row['id_marketer'],
            'observation' => $row['observation'],
        ]);
    }
}
