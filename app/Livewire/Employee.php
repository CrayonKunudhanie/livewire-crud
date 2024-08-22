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
    public $employee_selected_id = [];
    public $sortColumn = 'nama';
    public $sortDirection = 'asc';

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

    public function update()
    {
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

    public function clear()
    {
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';

        $this->updateData = false;
        $this->employee_id = '';
        $this->employee_selected_id = [];
    }

    public function delete()
    {
        if ($this->employee_id != '') {
            $id = $this->employee_id;
            ModelsEmployee::find($id)->delete();
        }

        if (count($this->employee_selected_id)) {
            for ($x = 0; $x < count($this->employee_selected_id); $x++) {
                ModelsEmployee::find($this->employee_selected_id[$x])->delete();
            }
        }
        session()->flash('message', 'Data berhasil delete');
        $this->clear();
    }

    public function delete_confirmation($id)
    {
        if ($id != '') {
            $this->employee_id = $id;
        }
    }

    public function sort($columnName){
        $this->sortColumn = $columnName;
        $this->sortDirection = $this->sortDirection == 'asc'?'desc':'asc';
    }

    public function render()
    {
        if (!empty($this->katakunci)) {
            $data = ModelsEmployee::where('nama', 'like', '%' . $this->katakunci . '%')
            ->orWhere('email', 'like', '%' . $this->katakunci . '%')
            ->orWhere('alamat', 'like', '%' . $this->katakunci . '%')
            ->orderBy($this->sortColumn, $this->shortDirectio)->paginate(3);
        } else {
            $data = ModelsEmployee::orderBy( $this->sortColumn, $this->sortDirection)->paginate(3);
        }

        return view('livewire.employee', ['dataEmployees' => $data]);
    }
}
