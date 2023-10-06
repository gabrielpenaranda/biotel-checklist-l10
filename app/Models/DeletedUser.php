<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;

    protected $table = 'deleted_users';

    protected $fillable = ['name', 'email', 'identification', 'position', 'old_id', 'date_since', 'date_to'];
}
