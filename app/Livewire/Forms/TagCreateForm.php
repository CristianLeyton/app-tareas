<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;



class TagCreateForm extends Form
{
    public $open = false;
    public $user_id;
    #[Rule('required|min:3',as: 'nombre')]
    public $tagName; 
    #[Rule('required',message:"Selecciona un color para la etiqueta.")]
    public $tagColor;


    public function save(){
        $this->validate();
        $tag = Tag::create([
            'user_id' => $this->user_id,
            'name' => $this->tagName,
            'color' => $this->tagColor
        ]);
        $this->reset('tagName','tagColor','open');
    }
}
