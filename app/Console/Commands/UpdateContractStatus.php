<?php

namespace App\Console\Commands;

use App\Models\Contrat;
use Illuminate\Console\Command;

class UpdateContractStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-contract-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $contrats = Contrat::all();

        foreach ($contrats as $contrat) {
            $contrat->updateStatus();
        }

        $this->info('Statuts des contrats mis à jour avec succès.');
    
    }
}
