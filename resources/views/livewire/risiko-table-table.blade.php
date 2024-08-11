<?php

use Livewire\Volt\Component;
use App\Models\RisikoBahayaDiajukan;

new class extends Component {
    public $jabatan;
    public $bahaya_fisik;
    public $penyebab;

    
    public function mount($jabatan) {
        $this->jabatan = $jabatan;
        $this->bahaya_fisik = '';
        $this->penyebab = '';
    }

    public function addRisikoBahaya() {
        $validated = $this->validate([
            'bahaya_fisik' => 'required|string',
            'penyebab' => 'required|string',
        ]);

        $this->jabatan->RisikoBahaya()->create($validated);

        $this->reset('bahaya_fisik', 'penyebab');
    }

    public function deleteRisikoBahaya(RisikoBahayaDiajukan $RisikoBahaya) {
        $RisikoBahaya->delete();
    
    }
}; ?>

<div class="mb-3">
    <label for="risiko_bahaya" class="form-label">Risiko Bahaya</label>
    <table class="table 
                table-bordered w-75" id="risiko_bahaya">
        <thead class="table-danger">
            <th>No</th>
            <th>Risiko bahaya</th>
            <th>Penyebab</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->risikoBahaya as $risikoBahaya)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $risikoBahaya->bahaya_fisik }}</td>
                    <td>{{ $risikoBahaya->penyebab }}</td>
                    <td class="d-flex gap-1">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <form wire:submit="addRisikoBahaya()" method="POST">
                    @csrf
                    <td></td>
                    <td>
                        <input name="bahaya_fisik" type="text" class="form-control"
                            placeholder="Masukkan Risiko Bahaya" wire:model="bahaya_fisik">
                    </td>
                    <td>
                        <input name="penyebab" type="text" class="form-control" placeholder="Masukkan Penyebab" wire:model="penyebab">
                    </td>
                    <td><button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                        Tambah</button></td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
