<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Imports\CargosImport;
use Maatwebsite\Excel\Facades\Excel;

class CargoController extends Controller
{
    public function index() {
        $cargos = Cargo::all();

        return view('welcome', compact('cargos'));
    }

    public function import(Request $request) {
        Excel::import(new CargosImport, $request->file('cargos_file'));

        return back(); 
    }
}
