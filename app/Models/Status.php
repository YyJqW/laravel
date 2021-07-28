<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=['content'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
