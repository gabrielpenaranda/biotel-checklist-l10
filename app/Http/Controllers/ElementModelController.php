<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\ElementModel;
use App\Models\ChecklistModel;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Requests\ElementModelStoreRequest;
use App\Http\Requests\ElementModelUpdateRequest;

class ElementModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChecklistModel $checklist_model, $element_num)
    {
        /* $element_models = DB::table('element_models')
            ->where('checklist_model_id', '=', $checklist_model->id)
            ->orderBy('element_number', 'asc')
            ->paginate(7); */
        $element_models = ElementModel::where('checklist_model_id', '=', $checklist_model->id)
            ->orderBy('element_number', 'asc')
            ->get();
        if ($element_models == null || $element_models->isEmpty() || !isset($element_models)) {
            $element_num = 0;
        } else {
            $e = $element_models->last();
            $element_num = $e->element_number;
        }
        return view('admin.element_model.index', compact('element_models', 'checklist_model', 'element_num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ChecklistModel $checklist_model)
    {
        $element_model = new ElementModel;
        $titulo = 'Biotel|Crear Elemento Modelo';
        return view('admin.element_model.form', compact('element_model', 'checklist_model', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElementModelStoreRequest $request)
    {
        $element_model = new ElementModel;
        $element_model->description = $request->get('description');
        $element_model->element_number = $request->get('element_number');
        if ($request->get('level') == null) {
            $element_model->level = 0;
        } else {
            $element_model->level = $request->get('level');
        }
        $element_model->checklist_model_id = $request->get('checklist_model_id');

        $element = ElementModel::where('checklist_model_id', $element_model->checklist_model_id)
            ->where('element_number', $element_model->element_number)
            ->get();
        if (!$element->isEmpty()) {

            $elements = ElementModel::where('checklist_model_id', $element_model->checklist_model_id)
                ->where('element_number', '>=', $element_model->element_number)
                ->orderBy('element_number', 'asc')
                ->get();

            foreach ($elements as $e) {
                $e->element_number += 1;
                $e->update();
            }
            $element_model->save();
        } else {
            $element_model->save();
        }

        $log = new Log;
        $log->register($log, 'C', $element_model->description, $element_model->id, 'element_models', auth()->user()->name, auth()->user()->identification);
        // session()->flash('message', 'Elemento creado');
        return redirect()->route('element-model.index', ['checklist_model' => $element_model->checklist_model_id, 'element_num' => $element_model->element_number]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ElementModel  $element_model
     * @return \Illuminate\Http\Response
     */
    public function edit(ElementModel $element_model, ChecklistModel $checklist_model, $element_num)
    {
        $titulo = 'Biotel|Editar Elemento de Modelo de Checklist';
        return view('admin.element_model.form', compact('element_model', 'checklist_model', 'titulo', 'element_num'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ElementModel  $element_model
     * @return \Illuminate\Http\Response
     */
    public function update(ElementModelUpdateRequest $request, ElementModel $element_model, $element_num)
    {
        $checklist_model_id = $element_model->checklist_model_id;
        $actual_number = $element_model->element_number;
        $element_model->description = $request->get('description');
        $element_model->element_number = $request->get('element_number');
        $element_model->level = $request->get('level');

        if ($actual_number > $element_model->element_number) {
            $elements = ElementModel::where('checklist_model_id', $checklist_model_id)
                ->where('element_number', '>=', $element_model->element_number)
                ->orderBy('element_number', 'asc')
                ->get();
            foreach ($elements as $e) {
                $e->element_number += 1;
                $e->update();
            }
        } else if ($actual_number < $element_model->element_number) {
            $elements = ElementModel::where('checklist_model_id', $checklist_model_id)
                ->where('element_number', '!=', $actual_number)
                ->where('element_number', '<=', $element_model->element_number)
                ->orderBy('element_number', 'asc')
                ->get();
            foreach ($elements as $e) {
                $e->element_number -= 1;
                $e->update();
            }
        }

        $element_model->update();

        $elements = ElementModel::where('checklist_model_id', $checklist_model_id)
            ->orderBy('element_number', 'asc')
            ->get();

        $i = 1;
        foreach ($elements as $e) {
            $e->element_number = $i;
            $e->update();
            $i++;
        }


        $log = new Log;
        $log->register($log, 'U', 'Actualizar elemento modelo ' . $element_model->description, $element_model->id, 'element_models', auth()->user()->name, auth()->user()->identification);
        // session()->flash('message', 'Elemento actualizado');
        return redirect()->route('element-model.index', ['checklist_model' => $checklist_model_id, 'element_num' => $element_num]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ElementModel  $element_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(ElementModel $element_model)
    {
        try {
            $checklist_model_id = $element_model->checklist_model_id;
            $element_number = $element_model->element_number;
            $element_model->delete();
            $log = new Log;
            $log->register($log, 'D', $element_model->description, $element_model->id, 'element_models', auth()->user()->name, auth()->user()->identification);
            $elements = ElementModel::where('checklist_model_id', $checklist_model_id)
                ->orderBy('element_number', 'asc')
                ->get();
            if (!$elements->isEmpty()) {
                $i = 1;
                foreach ($elements as $e) {
                    $e->element_number = $i;
                    $e->update();
                    $i++;
                }
            }
            session()->flash('message', 'Elemento eliminado');
            return redirect()->route('element-model.index', ['checklist_model' => $checklist_model_id, 'element_num' => $element_number]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar elemento, posee información relacionada');
                return redirect()->route('element-model.index', ['checklist_model' => $checklist_model_id]);
            }
        }
    }
}