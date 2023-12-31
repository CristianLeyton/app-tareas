<?php

namespace App\Livewire;

use App\Livewire\Forms\TagCreateForm;
use App\Livewire\Forms\TagEditForm;
use App\Models\Tag;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Etiquetas extends Component
{
    use WithPagination;

    public TagCreateForm $tagCreate;
    public TagEditForm $tagEdit;

    public $destroyOpen = false;
    public $tagIdDestroy;

    public function saveTag()
    {
        $this->tagCreate->save();
    }

    public function editTag($tagId)
    {
        $this->tagEdit->edit($tagId);
    }

    public function updateTag()
    {
        $this->tagEdit->update();
    }

    //Confirmar para eliminar una tarea de la BD
    public function confirmDestroy($tagId)
    {
        $this->destroyOpen = true;
        $this->tagIdDestroy = $tagId;
    }

    //Elimina una tarea de la BD
    public function destroyTag()
    {
        $tagId = $this->tagIdDestroy;
        $tag = Tag::find($tagId);
        $tag->delete();
        $this->reset('tagIdDestroy', 'destroyOpen');
    }

    public function mount()
    {
        $this->tagCreate->user_id = Auth::id();
    }

    public function render()
    {
        $tags = Tag::where(function ($query) {
            $query->where('user_id', $this->tagCreate->user_id)
                ->orWhereNull('user_id');
        })->orderBy('name')->paginate(8);

        return view('livewire.etiquetas', compact('tags'));
    }
}
