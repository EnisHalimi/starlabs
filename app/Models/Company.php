<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $appends = array('picture');

    protected $fillable = ['name','banner','website','quality1','quality2','quality3','logo','user_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPictureAttribute()
    {
        return  Storage::disk('public')->url($this->logo);

    }
}
