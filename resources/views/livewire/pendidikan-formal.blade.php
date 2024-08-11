<?php

use Livewire\Volt\Component;
use App\Models\PendidikanFormalDiajukan;

new class extends Component {
    public $jabatan;
    public $id;
    public $jenjang = '';
    public $jurusan = '';

    public function mount($jabatan)
    {
        $this->jabatan = $jabatan;
        $this->id = $this->jabatan->id;
    }

    public function addPendidikanFormal()
    {
        $validated = $this->validate([
            'jenjang' => 'required',
            'jurusan' => 'required',
        ]);

        $this->jabatan->pendidikanFormal()->create($validated);
        $this->reset(['jenjang', 'jurusan']);
    }

    public function deletePendidikan(PendidikanFormalDiajukan $pendidikan)
    {
        $pendidikan->delete();
    }
}; ?>

<div>
    <table class="table 
                    table-bordered w-75" id="pendidikan_formal">
        <caption class="caption-top fs-6">Kualifikasi Jabatan | Pendidikan Formal</caption>
        <thead class="table-primary">
            <th>No</th>
            <th>Jenjang</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($jabatan->pendidikanFormal as $pendidikan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pendidikan->jenjang }}</td>
                    <td>{{ $pendidikan->jurusan }}</td>
                    <td class="d-flex gap-1">
                        <button type="submit" class="btn btn-danger" wire:click="deletePendidikan({{ $pendidikan->id }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <form action="" wire:submit="addPendidikanFormal">
                    <td>
                        <select name="jenjang" class="form-select" id="" wire:model="jenjang">
                            <option value="" selected>Pilih Jenjang Pendidikan</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D-3</option>
                            <option value="D4">D-4</option>
                            <option value="S1">S-1</option>
                            <option value="S2">S-2</option>
                            <option value="S3">S-3</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan"
                            wire:model="jurusan">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Tambah
                        </button>
                    </td>
                </form>
                </form>
            </tr>
        </tbody>
    </table>
</div>
