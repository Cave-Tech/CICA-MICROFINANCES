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
    public $fullName;
    public $birthDate;
    public $nationality;
    public $gender;
    public $address;
    public $phone;

    public $currentPassword;
    public $newPassword;
    public $renewPassword;

    public $customer;
    public function render()
    {
        $userId = auth()->user()->id; // ou tout autre moyen de récupérer l'ID de l'utilisateur connecté
        $this->customer = User::with(['account', 'operation', 'loan', 'profile', 'employeType'])
                            ->find($userId);
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
        $this->validate([
            'fullName' => 'required|string',
            'birthDate' => 'required|date',
            'nationality' => 'required|string',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Mise à jour des autres informations du profil
        auth()->user()->update([
            'name' => $this->fullName,
            'birth_date' => $this->birthDate,
            'nationality' => $this->nationality,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        return redirect('/profile')->with("success", "Informations mise à jours avec succès !.");
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

        return redirect('/profile')->with("success", "Photo mise à jours avec succès !.");

        // Réinitialisez la propriété pour effacer la nouvelle image après la mise à jour
        $this->reset('newProfileImage');
    }



}
