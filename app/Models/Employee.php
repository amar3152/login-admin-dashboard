<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $fillable=['name','position','email','mobileno','image','gender','password'];
    use HasFactory;

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url('employee/images/' . $this->image);
        }

        return null; // or path to a default image
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
