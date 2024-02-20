<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_katilimci extends Model
{
    use HasFactory;

    public function firma()
    {
		return $this->hasOne(\App\Models\tbl_firma::class, 'id','db_firma_id');
    }
}
