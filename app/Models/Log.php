<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = ['action', 'description', 'table_id', 'table_name', 'user_name', 'user_id'];


    public function register($log, $action, $description, $table_id, $table_name, $user_name, $user_id)
    {
        /* switch ($action) {
            case 'C':
                $desc = "Crear registro: " . $description;
                break;
            case 'D':
                $desc = "Eliminar registro: " . $description;
                break;
            case 'U':
                $desc = "Actualizar registro: " . $description;
                break;
        } */
        $log->action = $action;
        $log->description = $description;
        $log->table_id = $table_id;
        $log->table_name = $table_name;
        $log->user_name = $user_name;
        $log->user_id = $user_id;
        $log->save();
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

}
