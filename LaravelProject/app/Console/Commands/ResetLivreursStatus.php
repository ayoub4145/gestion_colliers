<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Livreur;

class ResetLivreursStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-livreurs-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Réinitialise le statut des livreurs à Disponible tous les jours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Livreur::where('statut', 'Occupé')->update(['statut' => 'Disponible']);
        $this->info('Statut des livreurs réinitialisé avec succès.');
    }
}
