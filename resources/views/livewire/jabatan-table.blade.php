<?php

use Livewire\Volt\Component;
use App\Models\JabatanDiajukan;

new class extends Component {
    
    public $search = '';
    public $selectedJabatan; 

    // RENDER JABATAN
    // renders jabatan based on search query
    // if search query is empty, renders all jabatan as tree
    // if search query is not empty, renders jabatan that matches the search query
    public function with() {
        if (empty($this->search)) {
            return [
            'jabatans' => JabatanDiajukan::where('ajuan_id', null)->with('uraianTugas')->tree()->get()->toTree()
        ];
        }
        else {
            return [
                'jabatans' => JabatanDiajukan::where('ajuan_id', null)->with('uraianTugas')->where('nama', 'like', '%'.$this->search.'%')->get()
            ];
        }
    }

    // DELETE JABATAN
    // assigns jabatan to be deleted to $selectedJabatan
    public function deleteJabatan (JabatanDiajukan $jabatan) {
        $this->selectedJabatan = $jabatan;  
        // dd($this->selectedJabatan->nama);      
    }

    // DESTROY JABATAN
    // deletes selected jabatan in $selectedJabatan from database
    public function destroyJabatan() {
        $this->selectedJabatan->delete();
    }

}; ?>

<div>
    <div class="" wire:ignore>
        <div class="modal fade" tabindex="-1" id="deleteJabatanModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Jabatan?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin menghapus jabatan {{ $this->selectedJabatan }} ? Jabatan yang sudah dihapus tidak bisa dikembalikan lagi.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click="destroyJabatan" data-bs-dismiss="modal" >Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3 w-25 ">
        <input type="email" wire:model.live="search" class="form-control" id="search" placeholder="Cari Jabatan">
        <label for="search">Cari Nama Jabatan</label>
    </div>
    <table class="table table-striped table-bordered">
        <thead >
            <th class="fw-semibold text-muted">Kode</th>
            <th class="fw-semibold text-muted d-flex">Jabatan
                <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan=""><i class="fa-solid fa-plus"></i> Tambah Jabatan</button>

            </th>
        </thead>
        <tbody>
            @foreach ($jabatans as $jabatan)
                <x-table-row type="create" :jabatan="$jabatan" wire:key="{{ $jabatan->id }}"></x-table-row>
            @endforeach
        </tbody>
    </table>
</div>
