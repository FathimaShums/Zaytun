<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{

    use WithFileUploads;

    public $image;
    public $progress = 0;

    public function updatedImage(){
        //Reset progress bar

        $this->progress = 0;
    }
    public function Save(){
        //To validate the upload to only an imge of 1024px
        $this->validate([
            'image' => 'required|image|max:1024',
        ]);

        //Save the image to public storage
        $path = $this->image->store('images','public');

        $this->progress = 100;

        session()->flash('message', 'Image uploaded to: '. $path);
    }


    public function render()
    {
        return view('livewire.image-upload');
    }
}
