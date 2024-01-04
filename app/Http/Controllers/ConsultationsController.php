<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use App\Models\societies;
use App\Models\Medicals;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    protected $Consultations;
    public function __construct(Consultations $consultations)
    {
        $this->Consultations = $consultations;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $societies = null;
        if ($request->token != null) {
            $societies = societies::where('login_tokens', $request->token)->limit(1)->get();
            if (count($societies) == 0)
                return Controller::failed('Unauthorized user', 401);
        }
        $consultations = new Consultations();
        $consultations->society_id = $societies[0]->id;
        $consultations->disease_history = $request->disease_history;
        $consultations->current_symptoms = $request->current_symptoms;
        $consultations->save();

        return Controller::success('Request consultation sent successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
       $token = $request->query('token');
       if($token == null) {
        return Controller::failed('Unauthorized user', 401);
       }

       $societies = societies::where('login_tokens', $token)->first();
       $consultationData = Consultations::where('society_id', $societies->id)->get();
       return Controller::success('Succes',$consultationData, 200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultations $consultations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultations $consultations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultations $consultations)
    {
        //
    }
}
