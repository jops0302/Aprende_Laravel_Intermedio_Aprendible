<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
