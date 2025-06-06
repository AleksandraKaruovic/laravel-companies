<?php
namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {
  use HasFactory;
  protected $fillable = [
        'name', 'description', 'address', 'city', 'country', 'phone','logo'
    ];
    protected $table = 'companies';

     public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }

    public function jobs()
    {
    return $this->hasMany(Job::class);
    }

    public function comments()
    {
    return $this->hasMany(\App\Models\UserComment::class)->withTrashed();
    }

    public function interestedUsers()
    {
    return $this->belongsToMany(User::class)->withTimestamps();
    }   

}