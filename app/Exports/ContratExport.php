<?php

namespace App\Exports;

use App\Models\Contrat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContratExport implements FromView
{
    
    protected $contrat;

    
    public function __construct(Contrat $contrat)
    {
        $this->contrat = $contrat;
    }

    // Retourne la vue avec les données
    public function view(): View
    {
        return view('exports.contrat', [
            'contrat' => $this->contrat,
        ]);
    }
}

