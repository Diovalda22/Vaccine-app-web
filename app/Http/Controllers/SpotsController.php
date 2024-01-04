<?php

namespace App\Http\Controllers;

use App\Models\Regionals;
use App\Models\societies;
use App\Models\Spots;
use App\Models\Vaccinations;
use App\Models\Vaccines;
use Illuminate\Http\Request;

class SpotsController extends Controller
{
    protected $spots, $vaccines;
    public function __construct(Spots $spots, Vaccines $vaccines)
    {
        $this->spots = $spots;
        $this->vaccines = $vaccines;
    }

   

    public function index(Request $request)
    {
        $token = $request->query('token');
        if ($token == null) {
            return Controller::failed('Unauthorized user', 401);
        }
        // $spots = societies::where('login_tokens', $token)->first();
        // $spotsData = Spots::where('regional_id', $spots->regional_id)->get(); 
        // return Controller::success('menampilkan data', $spotsData, 200);

        $spot = $this->spots->all();
        $spotData = [];
        $vaccines = $this->vaccines->all();
        
        foreach ($spot as $key => $value) {
            $temp = collect($this->spots->findOrFail($value->id));
            $newVaccine = collect();
            foreach ($vaccines as $key => $vaccine) {
                // var_dump($vaccine->name);
                $newVaccine->put($vaccine->name, $this->spots->spotVaccines($value->id, $vaccine->name));
            }
            $temp->put('vaccines', $newVaccine);
            $spotData[] = $temp;
        }

        return Controller::success('berhasil menampilkan spot', $spotData);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $token = $request->query('token');
        if ($token == null) {
            return Controller::failed('Unauthorized user', 401);
        }
        
        $tanggal = date('Y-m-d', strtotime($request->query('date')));
        $data = $this->spots->findOrFail($id);
        $data2 = collect();
        $data2->put('date', $tanggal);
        $data2->put('spot', $data);

        $count = Vaccinations::where('date', $tanggal)->where('spot_id', $id)->count();
        $data2->put('vaccination_count', $count);

        if ($tanggal != null) {
            return Controller::success('menampilkan data', $data2, 200);
        }

        $data = $this->spots->findOrFail($id);
        return Controller::success('menampilkan data', $data2, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
