<?php

namespace App\Livewire;

use App\Models\Employee as ModelsEmployee;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama;
    public $email;
    public $alamat;
    public $updateData = false;
    public $employee_id;
    public $katakunci;

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ];

        $validated = $this->validate($rules);
        ModelsEmployee::create($validated);
        session()->flash('message', 'Data berhasil dimasukkan');

    }

    public function edit($id)
    {
        $data = ModelsEmployee::find($id);

        $this->nama = optional($data)->nama;
        $this->email = optional($data)->email;
        $this->alamat = optional($data)->alamat;

        $this->updateData = true;
        $this->employee_id = $id;
    }

    public function update() {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ];

        $validated = $this->validate($rules);
        $data = ModelsEmployee::find($this->employee_id);
        $data->update($validated);
        session()->flash('message', 'Data berhasil update');

        $this->clear();
    }

    public function clear(){
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';

        $this->updateData = false;
        $this->employee_id = '';
    }

    public function delete(){
        $id = $this->employee_id;
        ModelsEmployee::find($id)->delete();
        session()->flash('message', 'Data berhasil delete');
        $this->clear();
    }

    public function delete_confirmation($id){
        $this->employee_id = $id;
    }
    

    public function render()
    {
        if (!empty($this->katakunci)) {
            $data = ModelsEmployee::where('nama', 'like', '%' . $this->katakunci . '%')->
            orWhere('alamat', 'like', '%' . $this->katakunci . '%')->
            orderBy('nama', 'asc')->paginate(3);
        } else {
            $data = ModelsEmployee::orderBy('nama', 'asc')->paginate(3);
        }
        
        return view('livewire.employee', ['dataEmployees' => $data]);
    }
    
}
