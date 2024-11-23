<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Personnel;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index(){
        $personne = Personnel::all();
        $finances = Finance::select('type', 'amount')->get();

        $data = [['types', 'montant']];
        foreach ($finances as $finances) {
            $data[] = [$finances->type, $finances->amount];
        }
    
        return view('test', compact('data'));
    }
}
