<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\User;
use App\Company;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class Profile extends Component
{
    public $image;
    public $profile;

    public function mount($myprof)
    {
        $this->profile = $myprof;
    }
    
    //importation de l'image
    protected $listeners = ['fileUpload' => 'handleFileUpload'];
    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

     //Enregistré dans la base de donnée
     public function AddImage()
     {
        //dd($this->image);
        $image = $this->storeImage();
        $company=Company::first();
        $prof=User::findOrFail($this->profile->id);
        $prof->update([
            'image' => $image,
        ]);
        
        //message flache
        session()->flash('message','La photo à été mise à jour');
     }

    //fonction sauvegarde l'image
    public function storeImage()
    {
       if(!$this->image)
       {
        return null;
       }
       //utilisation de intervention librairie pour avoir l'image
       $img = ImageManagerStatic::make($this->image)->encode('png');
       //crée un nom pour l'image
       $name = str::random(). '.png';
       //enregistré l'image avec le nom et l'image
       storage::disk('public')->put($name, $img); 
       return $name;
    }      

    //fonction qui genere l'url de l'image dans public storage
    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
