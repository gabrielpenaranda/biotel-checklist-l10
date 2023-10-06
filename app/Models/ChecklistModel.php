<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistModel extends Model
{
    use HasFactory;

    protected $table = 'checklist_models';

    protected $fillable = ['name', 'description', 'is_active', 'instructions'];

    public function element_models() {
        return $this->hasMany(ElementModel::class);
    }

}
