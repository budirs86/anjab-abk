<?php

use Livewire\Volt\Component;
use App\Models\JabatanDiajukan;

new class extends Component {
    public $search = '';
    public $ajuan = '';
    
    
    public function with() {
        
        if (empty($this->search)) {
            return [
            'jabatans' => JabatanDiajukan::where('ajuan_id', $this->ajuan->id)->with('uraianTugas')->tree()->get()->toTree()
        ];
        }
        return [
            'jabatans' => JabatanDiajukan::where('ajuan_id', $this->ajuan->id)->with('uraianTugas')->where('nama', 'like', '%'.$this->search.'%')->get()
        ];
    }

}; ?>

<div>
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    <table class="table table-striped table-bordered">
        <thead >
            <th class="fw-semibold text-muted">Kode</th>
            <th class="fw-semibold text-muted d-flex">
                Jabatan
            </th>
        </thead>
        <tbody>
            @foreach ($jabatans as $jabatan)
                <x-table-row :jabatan="$jabatan" type="show" wire:key="{{ $jabatan->id }}"/>
            @endforeach
        </tbody>
    </table>
</div>
