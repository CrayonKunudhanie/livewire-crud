<?php

namespace App\Livewire;

use App\Models\Employee as ModelsEmployee;
use Livewire\Component;

class Employee extends Component
{
    public $nama;
    public $email;
    public $alamat;

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ];

        $validated = $this->validate($rules);
        ModelsEmployee::create($validated); 
        session()->flash('message', 'Data berhasil dimasukan');
    }

    public function render()
    {
        return view('livewire.employee');
    }
}
