<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function show()
    {
        $titulo = 'Biotel|Reporte de Log';
        return view('admin.log.show', compact('titulo'));
    }

    public function generate_show(Request $request)
    {
        $date_from = date("Y-m-d", strtotime($request->get('date_from')));
        $date_to = date("Y-m-d", strtotime($request->get('date_to')));
        if ($date_from == $date_to) {
            $logs = Log::where('created_at', '>=', $date_from . ' 00:00:00')->orderBy('created_at', 'desc')->paginate(8);
        } else if ($date_from > $date_to) {
            session()->flash('warning', 'Fecha de final no puede ser mayor a fecha inicio');
            return redirect()->route('log.show');
        } else {
            $logs = Log::where('created_at', '>=', $date_from . ' 00:00:00')
                ->where('created_at', '<=', $date_to . ' 23:59:59')
                ->orderBy('created_at', 'desc')
                ->paginate(8);
        }
        /* $date_from = date("d/m/Y", strtotime($date_from));
        $date_to = date("d/m/Y", strtotime($date_to)); */
        $titulo = "Biotel|Reporte de Log";
        return view('admin.log._show', compact('titulo', 'logs'));
    }
}