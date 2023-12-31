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

    public function saveTag(){
        $this->tagCreate->save();
    }

    public function mount(){
        $this->tagCreate->user_id = Auth::id();
    }

    public function render()
    {
        $tags = Tag::where(function ($query) {
            $query->where('user_id', $this->tagCreate->user_id)
                ->orWhereNull('user_id');
        })->orderBy('name')->paginate(10);

        return view('livewire.etiquetas', compact('tags'));
    }
}
