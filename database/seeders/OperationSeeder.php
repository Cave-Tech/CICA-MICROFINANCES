<?php

namespace Database\Seeders;

use App\Models\Operation;
use App\Models\OperationType;
use App\Models\User;
use App\Models\EmployeeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operationTypes = OperationType::all();
        $users = User::where('profile_id', 3)->get(); // On prend seulement les utilisateurs avec le profil "client"
        $statuses = ['completed', 'pending']; // Statuts possibles

        $beneficiaires = ['Alice Martin', 'Louis Bernard', 'Paul Simon', 'Julie Dupont', 'Marie Dubois', 'Jean Blanc', 'Sophie Leclerc', 'Lucas Petit', 'Anna Durand', 'Nicolas Leroy'];

        // Récupérer l'ID du type d'employé "caissier"
        $caissierTypeId = EmployeeType::where('designation', 'caissier')->first()->id;
        $caissierUsers = User::where('employee_type_id', $caissierTypeId)->get();

        foreach ($users as $user) {
            foreach ($operationTypes as $operationType) {
                for ($i = 0; $i < 10; $i++) { // Création de 10 opérations pour chaque type d'opération pour chaque utilisateur
                    Operation::create([
                        'user_id' => $user->id,
                        'operation_type_id' => $operationType->id,
                        'withdrawal_amount' => rand(50, 1000), // Un montant aléatoire entre 50 et 1000 pour l'exemple
                        'withdrawal_method' => Str::random(10),
                        'transaction_key' => Str::random(16),
                        'status' => $statuses[array_rand($statuses)], // Choisir un statut aléatoire
                        'id_employe' => $caissierUsers->random()->id, // Prend un employé caissier aléatoirement
                        'beneficiaire' => $beneficiaires[array_rand($beneficiaires)], // Choisir un bénéficiaire aléatoire
                        'compte_destination' => Str::random(10), // Pour l'exemple, un compte aléatoire est généré
                        'motif' => Str::random(20), // Un motif aléatoire pour l'exemple
                        'withdrawal_date' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
