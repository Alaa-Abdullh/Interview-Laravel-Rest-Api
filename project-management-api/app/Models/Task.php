<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;



class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory,softDeletes;
    protected $fillable=['project_id','title','details','priority','is_completed'];
    
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
     public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    
}
