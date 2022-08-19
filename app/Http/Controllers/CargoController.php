<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Imports\CargosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    /**
     * Display a welcome page.
     */
    public function swagger(Request $request) {
        
        return response()->json([
            'name' => $request->input('name'),
        ]);
    }

    /**
     * Display a welcome page.
     */
    public function welcome() {
        // $cargos = Cargo::all();
        $cargos = DB::select(
            'CALL get_cargos()'
         );
        // dd($cargos);
        return view('welcome', compact('cargos'));
    }

    /**
     * Get cardos to a welcome page.
     */
    public function get_cargos() {
        // $cargos = Cargo::all();
        $cargos = DB::select(
            'CALL get_cargos()'
         );

        $output="";
        foreach($cargos as $cargo){
            $output.=
                '<tr>
                <td>'.$cargo->number.'</td>
                <td>'.$cargo->type.'</td>
                <td>'.$cargo->size.'</td>
                <td>'.$cargo->weight.'</td>
                <td>'.$cargo->remarks.'</td>
                <td>'.$cargo->wharfage.'</td>
                <td>'.$cargo->penalty.'</td>
                <td>'.$cargo->storage.'</td>
                <td>'.$cargo->electricity.'</td>
                <td>'.$cargo->destuffing.'</td>
                <td>'.$cargo->lifting.'</td>

                </tr>';
        }

        return response($output);
    }

    /**
     * Import excel files for cargos
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) {

        try {
            Excel::import(new CargosImport, $request->file('cargos_file'));
        }
        catch (\Exception $e) {
            return back()->with('error', 'Something Wrong'); 
        }

        // session()->flash("success", "This is success message");

        return back()->with('success', 'Data Loaded Success'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();

        if($cargos){
            return response()->json([
                'message' => 'Successful',
                'data' => $cargos
            ],200
            );
        }else {
            return response()->json([
                'message' => 'No Data Found',
                'data' => $cargos
            ],200
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargo = new Cargo();
        $cargo->number = $request->number;
        $cargo->type = $request->type;
        $cargo->size = $request->size;
        $cargo->weight = $request->weight;
        $cargo->remarks = $request->remarks;
        $cargo->wharfage = $request->wharfage;
        $cargo->penalty = $request->penalty;
        $cargo->storage = $request->storage;
        $cargo->electricity = $request->electricity;
        $cargo->destuffing = $request->destuffing;
        $cargo->lifting = $request->lifting;

        if($cargo->save()){
            return response()->json([
                'message' => 'Successful',
                'data' => $cargo
            ],200
            );
        }else {
            return response()->json([
                'message' => 'Failed to Insert Data',
                'data' => []
            ],200
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $cargo = Cargo::find($id);
        $cargo = DB::select(
            'CALL get_cargo('.$id.')'
        );

        if(!is_null($cargo)){
            return response()->json([
                'message' => 'Successful',
                'data' => $cargo
            ],200
            );
        }else {
            return response()->json([
                'message' => 'Data Not Found',
                'data' => $cargo
            ],200
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->number = $request->number;
        $cargo->type = $request->type;
        $cargo->size = $request->size;
        $cargo->weight = $request->weight;
        $cargo->remarks = $request->remarks;
        $cargo->wharfage = $request->wharfage;
        $cargo->penalty = $request->penalty;
        $cargo->storage = $request->storage;
        $cargo->electricity = $request->electricity;
        $cargo->destuffing = $request->destuffing;
        $cargo->lifting = $request->lifting;

        if($cargo->save()){
            return response()->json([
                'message' => 'Successful',
                'data' => $cargo
            ],200
            );
        }else {
            return response()->json([
                'message' => 'Failed to Update Data',
                'data' => []
            ],200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);

        if($cargo->delete()){
            return response()->json([
                'message' => 'Successful',
                'data' => $cargo
            ],200
            );
        }else {
            return response()->json([
                'message' => 'Failed to Delete Data',
                'data' => []
            ],200
            );
        }
    }
}
