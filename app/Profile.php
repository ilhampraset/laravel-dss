<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profile';
    public static function getProfileDetail($id)
    {
        $profile_detail = DB::table('profile_detail')
                ->select('kriteria.nama AS kriteria', 'kriteria.faktor', 'sub_kriteria.nama AS nama_sub_kriteria', 'kriteria.id AS id_kriteria', 'sub_kriteria.id as id_sub_kriteria', 'sub_kriteria.nilai', 'profile_detail.profile_id')
                ->join('sub_kriteria', 'sub_kriteria.id', '=', 'profile_detail.sub_kriteria_id')
                ->join('kriteria', 'kriteria.id', '=', 'profile_detail.kriteria_id')
                ->where('profile_id', $id)
                ->get();

        return $profile_detail;
    }

    public function scopeProfileStatus($query, $value)
    {
        return  $profile = $query->where('status', $value);
    }
}
