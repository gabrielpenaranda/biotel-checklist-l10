<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementModel extends Model
{
    use HasFactory;

    protected $table = 'element_models';

    protected $fillable = ['description', 'element_number', 'checklist_model_id'];

    public function checklist_model() {
        return $this->belongsTo(ChecklistModel::class);
    }
}
