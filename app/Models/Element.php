<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $table = 'elements';

    protected $fillable = [
        'checklist_id',
        'column_one',
        'column_two',
        'column_three',
        'column_four',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

}
