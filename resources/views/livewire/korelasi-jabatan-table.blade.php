<?php

use Livewire\Volt\Component;
use App\Models\UnitKerja;
use App\Models\JabatanDiajukan;
use App\Models\KorelasiJabatan;

new class extends Component {
    public $jabatan;
    public $jabatanKorelasi;
    public $jabatan_relasi_id;
    public $dalam_hal;

    public function mount($jabatan)
    {
        $this->jabatan = $jabatan;
        $this->nama = '';
        $this->jabatanKorelasi = JabatanDiajukan::all();
        $this->jabatan_relasi_id = null;
        $this->dalam_hal = '';
    }

    public function addKorelasiJabatan()
    {
        $validated = $this->validate([
            'jabatan_relasi_id' => 'required|string',
            'dalam_hal' => 'required|string',
        ]);

        $this->jabatan->korelasiJabatan()->create($validated);

        $this->reset('jabatan_relasi_id', 'dalam_hal');
    }

    public function deleteKorelasiJabatan(KorelasiJabatan $korelasiJabatan)
    {
        $korelasiJabatan->delete();
    }
}; ?>

<div class="mb-3">
    <label for="korelasi_jabatan" class="form-label">Korelasi Jabatan</label>
    <table class="table table-bordered" id="korelasi_jabatan">
        <thead class="table-info">
            <th>No</th>
            <th>Jabatan</th>
            <th>Dalam Hal</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            {{-- @foreach ($jabatan->korelasiJabatan as $korelasiJabatan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $perangkatKerja->nama }}</td>
                    <td class="d-flex gap-1">
                        <form
                            action="{{ route('anjab.jabatan.perangkatKerja.delete', ['jabatan' => $jabatan->id, 'perangkatKerja' => $perangkatKerja->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="jabatan_id" value="{{ $jabatan->id }}">
                            <button type="submit" class="btn btn-danger">
                                <img width="20px" data-feather="trash"></img>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
            @foreach ($jabatan->korelasiJabatan as $korelasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $korelasi->jabatanRelasi->nama }}</td>
                    <td>{{ $korelasi->dalam_hal }}</td>
                    <td>
                        <button class="btn btn-danger" wire:click="deleteKorelasiJabatan({{ $korelasi }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <form wire:submit="addKorelasiJabatan">
                    @csrf
                    <td>
                        <select name="" id="" class="form-select" wire:model="jabatan_relasi_id">
                            <option value="">Pilih Jabatan Korelasi</option>
                            @foreach ($jabatanKorelasi as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Masukkan Korelasi Jabatan"
                            wire:model="dalam_hal">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>
