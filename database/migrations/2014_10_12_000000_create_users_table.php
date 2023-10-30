<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Champs communs aux employés et clients
            
            $table->id();  // Identifiant unique pour chaque utilisateur
            $table->unsignedBigInteger('agent_id')->nullable();  // Clé étrangère pour identifier l'agent de cet utilisateur, peut être nulle
            $table->unsignedBigInteger('profile_id');  // Clé étrangère pour le profil de l'utilisateur (ex. client, employé)
            $table->string('name');  // Nom complet de l'utilisateur
            $table->enum('gender', ['male', 'female', 'other']);  // Genre de l'utilisateur
            $table->date('birth_date');  // Date de naissance de l'utilisateur
            $table->string('nationality');  // Nationalité de l'utilisateur
            $table->string('email')->unique();  // Adresse email unique de l'utilisateur
            $table->string('phone');  // Numéro de téléphone de l'utilisateur
            $table->text('address');  // Adresse résidentielle de l'utilisateur
            $table->enum('id_type', ['card', 'passport']);  // Type de pièce d'identité de l'utilisateur (carte d'identité ou passeport)
            $table->string('id_number');  // Numéro de la pièce d'identité
            $table->string('profile_picture')->default('default-profile-icon.png');  // Image de profil de l'utilisateur
            $table->string('status');  // Statut actuel de l'utilisateur (ex. actif, inactif)
            $table->timestamp('email_verified_at')->nullable();  // Date et heure de la vérification de l'email
            $table->string('password');  // Mot de passe (haché) de l'utilisateur
            $table->rememberToken();  // Token pour la fonction "Se souvenir de moi"
            $table->timestamps();  // Dates de création et de mise à jour de l'enregistrement

            // Champs spécifiques aux employés

            $table->unsignedBigInteger('employee_type_id')->nullable();  // Clé étrangère pour le type d'employé (ex. gestionnaire, caissier)
            $table->date('hiring_date')->nullable();  // Date d'embauche de l'employé
            $table->string('position')->nullable();  // Poste occupé par l'employé
            $table->string('department')->nullable();  // Département de l'employé
            $table->enum('contract_type', ['full-time', 'part-time', 'temporary'])->nullable();  // Type de contrat de l'employé
            $table->decimal('salary', 10, 2)->nullable();  // Salaire de l'employé
            $table->string('education_level')->nullable();  // Niveau d'éducation de l'employé
            $table->text('specific_training')->nullable();  // Formations spécifiques suivies par l'employé
            $table->text('certifications')->nullable();  // Certifications obtenues par l'employé
            $table->string('social_security_number')->nullable();  // Numéro de sécurité sociale de l'employé
            $table->string('bank_name')->nullable();  // Nom de la banque de l'employé
            $table->string('bank_account_number')->nullable();  // Numéro de compte bancaire de l'employé
            $table->string('emergency_contact_name')->nullable();  // Nom du contact d'urgence de l'employé
            $table->string('emergency_contact_relation')->nullable();  // Relation avec le contact d'urgence
            $table->string('emergency_contact_phone')->nullable();  // Numéro de téléphone du contact d'urgence

            // Champs spécifiques aux clients

            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();  // Statut matrimonial du client: indique la situation matrimoniale actuelle du client
            $table->string('occupation')->nullable();  // Profession du client: le travail ou l'occupation principale du client, par exemple "agriculteur", "commerçant", etc.
            $table->text('financial_information')->nullable();  // Informations financières du client: des détails concernant les revenus, les dépenses, les dettes, les investissements, etc.
            $table->integer('number_of_dependents')->nullable();  // Nombre de personnes à charge: combien de personnes dépendent financièrement du client
            $table->text('source_of_income')->nullable();  // Source de revenu: d'où provient l'essentiel des revenus du client (par exemple, salaire, affaires, rentes, etc.)
            $table->string('referral')->nullable();  // Référence: comment le client a-t-il entendu parler de la microfinance ou qui l'a recommandé
            $table->date('client_since')->nullable();  // Client depuis: la date à laquelle le client a rejoint la microfinance
            $table->string('previous_loan_details')->nullable();  // Détails des prêts précédents: si le client avait précédemment un prêt avec la microfinance ou avec d'autres institutions
            $table->enum('client_type', ['individual', 'group'])->nullable();  // Type de client: si le client est un individu ou fait partie d'un groupe (par exemple, dans le cas d'un prêt de groupe)
            $table->decimal('average_monthly_income', 10, 2)->nullable();  // Revenu mensuel moyen: le revenu mensuel approximatif du client

            // Clés étrangères
            
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');  // Lien vers la table des profils
            $table->foreign('employee_type_id')->references('id')->on('employee_types')->onDelete('cascade');  // Lien vers la table des types d'employés
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');  // Relation auto-référencée pour l'agent
        





            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');  // Supprime la table des utilisateurs lors de l'annulation de la migration
    }
};
