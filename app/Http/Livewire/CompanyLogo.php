<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Company;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class CompanyLogo extends Component
{

    public $image;
    public $company;

    public function mount($mycomp)
    {
        $this->company = $mycomp;
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
        $comp=Company::findOrFail($this->company->id);
        $comp->update([
            'logo' => $image,
        ]);
        session()->flash('message','Le logo à été mis à jour');
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
        return view('livewire.company-logo');
    }
}
