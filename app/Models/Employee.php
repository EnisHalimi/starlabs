<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;
    protected $appends = array('picture');

    protected $fillable = ['name','occupation','bio','email','social_media','company_id','photo'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function getPictureAttribute()
    {
        return  Storage::disk('public')->url($this->photo);

    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('occupation', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('social_media', 'like', '%'.$search.'%')
                    ->orWhere('bio', 'like', '%'.$search.'%');
            });
        });
    }
}
