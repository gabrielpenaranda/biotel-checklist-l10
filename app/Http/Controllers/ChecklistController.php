<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistModel;
use App\Models\Element;
use App\Models\ElementModel;
use App\Models\User;
use App\Models\DeletedUser;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {/*
        $checklists = Checklist::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10); */

        //return view('admin.checklist.index', compact('checklists'));
        return view('admin.checklist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ChecklistModel $checklist_model)
    {
        $checklist = new Checklist;
        $titulo = 'Biotel|Generar Checklist';
        $elements = false;
        $element_models = ElementModel::where('checklist_model_id', $checklist_model->id)->first();
        if ($element_models) {
            $elements = true;
        }
        return view('admin.checklist.form', compact('checklist', 'checklist_model', 'titulo', 'elements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklist = new Checklist;
        $checklist_model_id = (int)$request->get('checklist_model_id');
        $checklist_model = ChecklistModel::find($checklist_model_id);
        $checklist->name = $checklist_model->name;
        $checklist->description = $checklist_model->description;
        $checklist->instructions = $checklist_model->instructions;
        $checklist->notes = '';
        $checklist->status ='0';
        $checklist->verificacion = '0';
        $checklist->employee_id = 1;
        $checklist->supervisor_id = 1;
        $checklist->first_date = Carbon::now();
        $checklist->second_date = Carbon::now();
        $checklist->name_first = '';
        $checklist->name_second = '';
        $checklist->priority = $request->get('priority');
        /* $checklist->expiration = Carbon::now()
                                    ->addDays((int)$request->get('days'))
                                    ->addHours((int)$request->get('hours'))
                                    ->addMinutes((int)$request->get('minutes')); */
        $checklist->expiration = Carbon::now();
        $checklist->days = (int)$request->get('days');
        $checklist->hours = (int)$request->get('hours');
        $checklist->minutes = (int)$request->get('minutes');
        $checklist->expired = false;
        $checklist->enabled = true;
        $checklist->save();
        $elements = ElementModel::where('checklist_model_id', $checklist_model->id)
            ->orderBy('element_number', 'asc')
            ->get();
        foreach($elements as $e) {
            $element = new Element;
            $element->description = $e->description;
            $element->element_number = $e->element_number;
            $element->level = $e->level;
            $element->checklist_id = $checklist->id;
            $element->column_one = false;
            $element->column_two = '';
            $element->column_three = false;
            $element->column_four = '';
            $element->save();
        }
        $log = new Log;
        $log->register($log, 'C', 'Checklist Nº '.$checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Checklist creado');
        return redirect()->route('checklist-model.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        $elements = Element::where('checklist_id', $checklist->id)
            ->orderBy('element_number', 'asc')
            ->get();
        $titulo = 'Biotel|Listado de Checklist';
        return view('admin.checklist.show', compact('checklist','elements','titulo'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function first_edit(Checklist $checklist)
    {
        $titulo = 'Biotel|Reasignar usuario a checklist';
        $users = User::where('deleted', false)->orderBy('name', 'asc')->get();
        return view('admin.checklist.first_form', compact('checklist', 'users', 'titulo'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function first_update(Request $request, Checklist $checklist)
    {
        if($checklist->employee_id == 1) {
            $checklist->expiration = Carbon::now()
                                        ->addDays($checklist->days)
                                        ->addHours($checklist->hours)
                                        ->addMinutes($checklist->minutes);
        }
        $checklist->employee_id = (int)$request->get('user_id');
        if ($checklist->status == '0') {
            $checklist->status = '1';
        }
        $checklist->first_date = Carbon::now();
        $checklist->update();
        $checklist->name_first = $checklist->employee->name;
        $checklist->update();
        $log = new Log;
        $log->register($log, 'C', 'Empleado 1V a Checklist Nº '.$checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Empleado asignado a 1ra verificación');
        return redirect()->route('checklist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function second_edit(Checklist $checklist)
    {
        $titulo = 'Biotel|Asignar supervisor a checklist';
        $users = User::where('deleted', false)->orderBy('name', 'asc')->get();
        return view('admin.checklist.second_form', compact('checklist', 'users', 'titulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function second_update(Request$request, Checklist $checklist)
    {
        $checklist->supervisor_id = (int)$request->get('user_id');
        if ($checklist->status == '0') {
            $checklist->status = '1';
        }
        $checklist->second_date = Carbon::now();
        $checklist->update();
        $checklist->name_second = $checklist->supervisor->name;
        $checklist->update();
        $log = new Log;
        $log->register($log, 'C', 'Supervisor 2V a Checklist Nº '.$checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Supervidor asignado a 2da verificación');
        return redirect()->route('checklist.index');
    }

    public function first_verify_edit(Checklist $checklist)
    {
        $titulo = "Biotel|Checklist 1ra verificación";
        $elements = Element::where('checklist_id', $checklist->id)
        ->orderBy('element_number', 'asc')
        ->get();
        return view('admin.checklist.first_verify', compact('checklist', 'elements', 'titulo'));
    }


    public function first_verify_update(Request $request, Checklist $checklist)
    {
        $elements = Element::where('checklist_id', $checklist->id)
        ->orderBy('element_number', 'asc')
        ->get();
        foreach($elements as $e) {
            $num = (string)$e->element_number;
            $e->column_one = (bool)$request->get('e'.$num);
            $e->column_two = $request->get('column_two' . $num);
            $ct = $e->column_two;
            if (!isset($ct)) {
                $e->column_two = ' ';
            }
            $e->update();
        }
        $checklist->verificacion = '1';
        $checklist->update();
        $user = User::where('id', $checklist->employee_id)->first();
        $first = $user->first;
        $first += 1;
        $user->first = $first;
        $user->update();
        $log = new Log;
        $log->register($log, 'U', 'Primera Verificación Checklist Nº '.$checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', '1ra verificación completa');
        return redirect()->route('checklist.index');
    }


    public function second_verify_edit(Checklist $checklist)
    {
        $titulo = "Biotel|Checklist 2da verificación";
        $elements = Element::where('checklist_id', $checklist->id)
            ->orderBy('element_number', 'asc')
            ->get();
        return view('admin.checklist.second_verify', compact('checklist', 'elements', 'titulo'));
    }


    public function second_verify_update(Request $request, Checklist $checklist)
    {
        $elements = Element::where('checklist_id', $checklist->id)
            ->orderBy('element_number', 'asc')
            ->get();
        foreach ($elements as $e) {
            $num = (string)$e->element_number;
            $e->column_three = (bool)$request->get('e' . $num);
            $e->column_four = $request->get('column_four' . $num);
            $ct = $e->column_four;
            if (!isset($ct)){
                $e->column_four = ' ';
            }
            $e->update();
            //echo $num." ".$e->column_three."   ".(bool)isset($e->column_three)."<br>";
        }
        $checklist->verificacion = '2';
        $checklist->status = '2';
        $checklist->update();
        $user = User::where('id', $checklist->supervisor_id)->first();
        $second = $user->second;
        $second += 1;
        $user->second = $second;
        $user->update();
        $log = new Log;
        $log->register($log, 'U', 'Segunda Verificación Checklist Nº ' . $checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', '2da verificación completa');
        return redirect()->route('checklist.index');
    }

    public function interchange(Checklist $checklist)
    {
        if ($checklist->verificacion == '0') {
            if ($checklist->status == '1') {
                if ($checklist->employee_id != 1 && $checklist->supervisor_id != 1) {
                    $interchange_id = $checklist->employee_id;
                    $interchange_name = $checklist->name_first;
                    $checklist->employee_id = $checklist->supervisor_id;
                    $checklist->name_first = $checklist->name_second;
                    $checklist->supervisor_id = $interchange_id;
                    $checklist->name_second = $interchange_name;
                    $checklist->update();
                    session()->flash('message', 'Usuarios intercambiados');
                    return redirect()->route('checklist.index');
                    $log = new Log;
                    $log->register($log, 'U', 'Intercambio de usuarios Checklist Nº'.$checklist->id, $checklist->id, "checklists", auth()->user()->name, auth()->user()->identification);
                } else {
                    session()->flash('warning', 'Los usuarios no han sido asignados');
                    return redirect()->route('checklist.index');
                }
            }
        } else {
            session()->flash('error', 'No es posible intercambiar usuarios');
            return redirect()->route('checklist.index');
        }
    }

    public function checklist_by_users()
    {
        /* $users = User::orderBy('name', 'asc')->paginate(8);
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklist_by_users', compact('titulo', 'users')); */
        return view('admin.checklist.checklist_by_users');
    }

    public function checklists_by_user(User $user)
    {
        $checklists = Checklist::where('employee_id', $user->id)
            ->orWhere('supervisor_id', $user->id)
            ->paginate(8);
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklists_by_user', compact('titulo', 'checklists', 'user'));
    }

    public function checklist_by_user(Checklist $checklist, User $user)
    {
        $elements = Element::where('checklist_id', $checklist->id)->get();
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklist_by_user', compact('titulo', 'checklist', 'elements', 'user'));
    }

    public function generate_pdf(Checklist $checklist)
    {
        $elements = Element::where('checklist_id', $checklist->id)
            ->orderBy('element_number', 'asc')
            ->get();
        $data['elements'] = $elements;
        $data['checklist'] = $checklist;
        $data['checklist_id'] = $checklist->id;
        $data['checklist_name'] = $checklist->name;
        $data['checklist_description'] = $checklist->description;
        switch ($checklist->status) {
            case '0':
                $data['checklist_status'] = 'No asignado';
                break;
            case '1':
                $data['checklist_status'] = 'En proceso';
                break;
            case '2':
                $data['checklist_status'] = 'Verificado';
                break;
        }
        $data['checklist_created_at'] = date_format($checklist->created_at, 'd/m/Y');
        if ($checklist->employee_id == 1) {
            $data['checklist_employee'] = 'No asignado';
        } else {
            $data['checklist_employee'] = $checklist->name_first.' C.I. '.$checklist->employee->identification;
        }
        if ($checklist->supervisor_id == 1) {
            $data['checklist_supervisor'] = 'No asignado';
        } else {
            $data['checklist_supervisor'] = $checklist->name_second.' C.I. '.$checklist->supervisor->identification;
        }
        $data['checklist_first_date'] = Carbon::parse($checklist->first_date)->format('d-m-y g:i A');
        $data['checklist_second_date'] = Carbon::parse($checklist->second_date)->format('d-m-y g:i A');
        view()->share('admin.checklist.checklist_pdf', compact('data', 'elements'));
        $pdf = PDF::loadView('admin.checklist.checklist_pdf', compact('data', 'elements'));
        $file_name = 'Checklist '.$checklist->id;
        return $pdf->download($file_name);
        //return $pdf->stream();
    }

    public function checklist_by_deleted_users()
    {
        /* $users = User::orderBy('name', 'asc')->paginate(8);
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklist_by_users', compact('titulo', 'users')); */
        return view('admin.checklist.checklist_by_deleted_users');
    }

    public function checklists_by_deleted_user(DeletedUser $deleted_user)
    {
        $checklists = Checklist::where('employee_id', $deleted_user->old_id)
            ->orWhere('supervisor_id', $deleted_user->old_id)
            ->paginate(8);
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklists_by_deleted_user', compact('titulo', 'checklists', 'deleted_user'));
    }

    public function checklist_by_deleted_user(Checklist $checklist, User $deleted_user)
    {
        $elements = Element::where('checklist_id', $checklist->id)->get();
        $titulo = 'Biotel|Checklists por usuario';
        return view('admin.checklist.checklist_by_deleted_user', compact('titulo', 'checklist', 'elements', 'deleted_user'));
    }

    public function checklist_expired()
    {
        //
    }
}
