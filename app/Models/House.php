<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "user_id",
        "file_path",
        "created_at",
        "updated_at"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
