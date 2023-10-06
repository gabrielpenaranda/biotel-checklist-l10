<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistSupervisor extends Model
{
    use HasFactory;

    protected $table = 'checklist_supervisors';

    protected $fillable = ['checklist_id', 'user_id'];

   /*  public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } */
}
