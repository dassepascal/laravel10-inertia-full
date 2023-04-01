<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id'];

    protected $appends = ['update'];

    protected static function booted()
    {
        static::creating(function ($course) {
            $course->user_id = auth()->id();
        });
    }
    // Definition du getter respecter la nomenclature

    public function getUpdateAttribute()
    {
        //
        return $this->user_id === auth()->id();
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
