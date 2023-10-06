<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $fillable = [
        'name',
        'description',
        'checklist_number',
        'notes',
        'instructions',
        'status',
        'verificacion',
        'employee_id',
        'supervisor_id',
        'first_date',
        'second_date',
        'name_first',
        'name_second',
        'priority',
        'expiration',
        'days',
        'hours',
        'minutes',
        'expired',
        'enabled',
     ];

    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class);
    }

   /*  public function checklist_employee()
    {
        return $this->hasOne(ChecklistEmployee::class);
    }

    public function checklist_supervisor()
    {
        return $this->hasOne(ChecklistSupervisor::class);
    } */
}
