<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['stage_id', 'priority', 'description'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
