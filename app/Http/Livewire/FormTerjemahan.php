<?php

namespace App\Http\Livewire;

use App\Models\Terjemahan;
use Livewire\Component;

class FormTerjemahan extends Component
{
    public $inputText = '';
    public $terjemahan = '';
    public $image = '';
    public $textTo = 'en'; 
    public $label = 'Terjemah ke Inggris';

    public function mount()
    {
        $this->updateLabel();
    }

    public function textTo($lang)
    {
        $this->textTo = $this->textTo === 'en' ? 'id' : 'en';
        $this->updateLabel();
        $this->translate();
    }

    public function translate()
    {
        $field = $this->textTo == 'en' ? 'ind' : 'en';
        $record = Terjemahan::where($field, $this->inputText)->first();

        $this->terjemahan = $record
            ? $record->{$field == 'ind' ? 'en' : 'ind'}
            : 'Terjemahan tidak ditemukan';

        $this->image = $record ? $record->image : '';
    }

    public function updatedInputText()
    {
        $this->translate();
    }

    public function updateLabel()
    {
        $this->label = $this->textTo == 'en' ? 'Terjemah ke Inggris' : 'Terjemah ke Indonesian';
    }

    public function render()
    {
        return view('livewire.form-terjemahan');
    }
}
