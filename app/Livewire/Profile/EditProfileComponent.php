<?php

namespace App\Livewire\Profile;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\User;
class EditProfileComponent extends Component
{
    use WithFileUploads;

    public $newProfileImage;
    public $name;
    public $localisation;
    public $birth_date;
    public $nationality;
    public $gender;
    public $address;
    public $phone;
    public $id_type;
    public $id_number;

    public $occupation;
    public $number_of_dependents;
    public $marital_status;

    public $currentPassword;
    public $newPassword;
    public $renewPassword;

    //Données de l'entreprise
    public $type_client;
    public $name_company;
    public $ifu_company;
    public $date_create;
    public $address_company;
    public $activity_sector;
    public $number_employed;
    public $tel_company;
    public $mail_company;
    public $capital;
    public $annual_pension;
    public $detail;

    public $profile;
    public function render()
    {
        $userId = auth()->user()->id; // ou tout autre moyen de récupérer l'ID de l'utilisateur connecté
        $this->profile = User::with(['account', 'operation', 'loan', 'profile', 'employeType'])
                            ->find($userId);
        $this->name = $this->profile->name;                     
        $this->nationality = $this->profile->nationality;
        $this->birth_date = $this->profile->birth_date;
        $this->gender = $this->profile->gender; 
        $this->address = $this->profile->address;
        $this->phone = $this->profile->phone; 
        $this->id_type = $this->profile->id_type;
        $this->id_number = $this->profile->id_number;
        $this->localisation = $this->profile->localisation;

        // Info entreprise
        $this->type_client = $this->profile->type_client;
        $this->name_company = $this->profile->name_company; 
        $this->ifu_company = $this->profile->ifu_company;
        $this->date_create = $this->profile->date_create; 
        $this->address_company = $this->profile->address_company;
        $this->activity_sector = $this->profile->activity_sector;
        $this->number_employed = $this->profile->number_employed;
        $this->tel_company = $this->profile->tel_company;
        $this->mail_company = $this->profile->mail_company; 
        $this->capital = $this->profile->capital;
        $this->annual_pension = $this->profile->annual_pension;
        $this->detail = $this->profile->detail;

        $this->occupation = $this->profile->occupation;
        $this->number_of_dependents = $this->profile->number_of_dependents;
        $this->marital_status = $this->profile->marital_status;
        return view('livewire.profile.edit-profile-component');
    }

    public function changePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
            'renewPassword' => 'required|same:newPassword',
        ]);

        // Vérifiez si le mot de passe actuel est correct
        if (Hash::check($this->currentPassword, auth()->user()->password)) {
            // Mettez à jour le mot de passe de l'utilisateur
            auth()->user()->update([
                'password' => Hash::make($this->newPassword),
            ]);

            return redirect('/profile')->with("success", "Mot de passe changé avec succès.");
        } else {
            return redirect('/profile')->with("fail", "Mot de passe actuel incorrect.");
        }

        $this->reset(['currentPassword', 'newPassword', 'renewPassword']);
    }


    public function updateProfile()
    {
        try {
            //code...
            $this->validate([
                'name' => 'required|string',
                'birth_date' => 'required|date',
                'nationality' => 'required|string',
                'gender' => 'required|in:male,female',
                'id_type' => 'required|in:card,passport',
                'address' => 'required|string',
                'localisation' => 'required|string',
                'id_number' => 'required|string',
                'phone' => 'required|string',

                'occupation' => 'required|string',
                'number_of_dependents' => 'required|numeric',
                'marital_status' => 'required|string',
            ]);
    
            // Mise à jour des autres informations du profil
            auth()->user()->update([
                'name' => $this->name,
                'birth_date' => $this->birth_date,
                'nationality' => $this->nationality,
                'gender' => $this->gender,
                'id_type' => $this->id_type,
                'id_number' => $this->id_number,
                'address' => $this->address,
                'localisation' => $this->localisation,
                'phone' => $this->phone,

                'occupation' => $this->occupation,
                'number_of_dependents' => $this->number_of_dependents,
                'marital_status' => $this->marital_status,
            ]);

            return redirect('/profile')->with("success", "Informations mise à jours avec succès !.");
        }catch (ValidationException $e) {
            // Erreurs de validation
            return redirect('/profile')->with("fail", "Remplissez tous les champs !");
        } catch (\Exception $e) {
            //dd($e);
            // Autres erreurs
            return redirect('/profile')->with("fail", " tous les champs !"); 
        }
        
    }


    public function updateProfileCompany()
    {
        try {
    
            // Mise à jour des informations entreprise
            auth()->user()->update([
            'type_client' => $this->type_client,
            'name_company'=> $this->name_company,
            'ifu_company'=> $this->ifu_company,
            'date_create'=> $this->date_create,
            'address_company'=> $this->address_company,
            'activity_sector'=> $this->activity_sector,
            'number_employed'=> $this->number_employed,
            'tel_company'=> $this->tel_company,
            'mail_company'=> $this->mail_company,
            'capital'=> $this->capital,
            'annual_pension'=> $this->annual_pension,
            'detail'=> $this->detail,
            ]);

            return redirect('/profile')->with("success", "Informations de l'entreprise mise à jours avec succès !.");
        }catch (ValidationException $e) {
            // Erreurs de validation
            return redirect('/profile')->with("fail", "Remplissez tous les champs !");
        } catch (\Exception $e) {
            //dd($e);
            // Autres erreurs
            return redirect('/profile')->with("fail", " tous les champs !"); 
        }
        
    }

    public function updateProfileImage()
    {
        $this->validate([
            'newProfileImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        ]);
        
        // Stockage de la nouvelle image
        $path = $this->newProfileImage->store('profile-images', 'public');

        // Mettez à jour l'URL de l'image de profil dans la base de données
        auth()->user()->update([
            'profile_picture' => $path,
        ]);

        return redirect('/profile');

        // Émettre un événement pour informer que la photo a été mise à jour
        //$this->dispatch('photoUpdated');
    }



}
