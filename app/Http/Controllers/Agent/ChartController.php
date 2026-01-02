<?php

namespace App\Http\Controllers\Agent;
use App\Models\Finance;
use App\Models\Personnel;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index(){
        $marketId = session('current_market_id');
        $personne = Personnel::where('market_id', $marketId)->get();
        $finances = Finance::select('type')
            ->selectRaw('SUM(amount) as amount')
            ->where('market_id', $marketId)
            ->groupBy('type')
            ->get();

        $data = [['types', 'montant']];
        foreach ($finances as $finances) {
            $data[] = [$finances->type, $finances->amount];
        }
    
        return view('test', compact('data'));
    }
}
