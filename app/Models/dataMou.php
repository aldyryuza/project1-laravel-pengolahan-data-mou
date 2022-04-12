<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class dataMou extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',

    ];

    public function getCreateAtAttribute()
    {
        return Carbon::parse($this->fi['tgl_mulai'])->translatedFormat('l,d F Y');
    }
}
