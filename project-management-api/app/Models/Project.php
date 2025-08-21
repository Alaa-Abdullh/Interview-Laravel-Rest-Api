<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory,softDeletes;
    protected $fillable=['name','description','status','due_date'];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
