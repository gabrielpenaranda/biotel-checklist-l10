<?php

namespace App\Http\Controllers;

use App\Models\ChecklistModel;
use App\Models\ElementModel;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Requests\ChecklistModelStoreRequest;
use App\Http\Requests\ChecklistModelUpdateRequest;
use App\Http\Requests\ChecklistModelCloneRequest;

class ChecklistModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $checklist_models = ChecklistModel::orderBy('name', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.checklist_model.index', compact('checklist_models'));
    */
        return view('admin.checklist_model.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checklist_model = new ChecklistModel;
        $titulo = 'Biotel|Crear Modelo de Checklist';
        return view('admin.checklist_model.form', compact('checklist_model','titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChecklistModelStoreRequest $request)
    {
        $checklist_model = new ChecklistModel;
        $checklist_model->name = $request->get('name');
        $checklist_model->description = $request->get('description');
        $checklist_model->is_active = (bool)$request->get('is_active');
        $checklist_model->instructions = $request->get('instructions');
        $checklist_model->save();
        $log = new Log;
        $log->register($log, 'C',  $checklist_model->name, $checklist_model->id,"checklist_models", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Modelo de checklist creado');
        return redirect()->route('checklist-model.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(ChecklistModel $checklist_model)
    {
        $element_models = ElementModel::where('checklist_model_id', $checklist_model->id)
                            ->orderBy('element_number', 'asc')
                            ->get();
        return view('admin.checklist_model.show', compact('checklist_model', 'element_models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(ChecklistModel $checklist_model)
    {
        $titulo = 'Biotel|Editar Modelo de Checklist';
        return view('admin.checklist_model.form', compact('checklist_model', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(ChecklistModelUpdateRequest $request, ChecklistModel $checklist_model)
    {
        $checklist_model->name = $request->get('name');
        $checklist_model->description = $request->get('description');
        $checklist_model->is_active = (bool)$request->get('is_active');
        $checklist_model->instructions = $request->get('instructions');
        $checklist_model->update();
        $log = new Log;
        $log->register($log, 'U', $checklist_model->name, $checklist_model->id,"checklist_models", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Modelo de checklist actualizado');
        return redirect()->route('checklist-model.index');
    }

    public function show_destroy(ChecklistModel $checklist_model)
    {
        $titulo = 'Biotel|Eliminar Modelo de Checklist';
        $element_models = ElementModel::where('checklist_model_id', $checklist_model->id)->get();
        return view('admin.checklist_model.show_destroy', compact('checklist_model', 'element_models', 'titulo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistModel $checklist_model)
    {
        try {
            $checklist_model->delete();
            $log = new Log;
            $log->register($log, 'D', $checklist_model->name, $checklist_model->id,'checklist_model', auth()->user()->name, auth()->user()->identification);
            session()->flash('message', 'Modelo de checklist eliminado');
            return redirect()->route('checklist-model.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el modelo de checklist, posee información relacionada');
                return redirect()->route('checklist-model.index');
            }
        }
    }

    public function show_clone(ChecklistModel $checklist_model)
    {
        $titulo = 'Biotel|Clonar Modelo de Checklist';
        $element_models = ElementModel::where('checklist_model_id', $checklist_model->id)->get();
        return view('admin.checklist_model.show_clone', compact('checklist_model', 'element_models', 'titulo'));
    }

    public function clone(ChecklistModelCloneRequest $request, ChecklistModel $checklist_model)
    {
        $new_checklist_model = new ChecklistModel;
        $new_checklist_model->name = $request->get('new_name');
        $new_checklist_model->description = $checklist_model->description;
        $new_checklist_model->is_active = $checklist_model->is_active;
        $new_checklist_model->instructions = $checklist_model->instructions;
        $new_checklist_model->save();
        $element_models = ElementModel::where('checklist_model_id', $checklist_model->id)->get();
        foreach($element_models as $em) {
            $element_model = new ElementModel;
            $element_model->description = $em->description;
            $element_model->element_number = $em->element_number;
            $element_model->level = $em->level;
            $element_model->checklist_model_id = $new_checklist_model->id;
            $element_model->save();
        }
        $log = new Log;
        $log->register($log, 'C',  'Clone Modelo de Checklist: '.$new_checklist_model->name, $new_checklist_model->id, "checklist_models", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Modelo de checklist clonado');
        return redirect()->route('checklist-model.index');
    }

}
