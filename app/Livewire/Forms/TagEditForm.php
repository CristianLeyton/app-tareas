<?php

namespace App\Livewire\Forms;

use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TagEditForm extends Form
{
    public $open = false;
    public $tagEditId;
    #[Rule('required|min:3',as: 'nombre')]
    public $tagName; 
    #[Rule('required|starts_with:#|min:7|max:7',as: 'color',message:"Selecciona un color para la etiqueta.")]
    public $tagColor;


    public function edit($tagId){
        $this->open = true;
        $this->tagEditId = $tagId;
        $tag = Tag::find($tagId);
        $this->tagName = $tag->name;
        $this->tagColor = $tag->color;
    }

    public function update() {
        $this->validate();
        $tag = Tag::find($this->tagEditId);
        $tag->update([
            'name' => $this->tagName,
            'color' => $this->tagColor
        ]);
        $this->reset(); //Resetea todas las variables de esta clase
    }
}
