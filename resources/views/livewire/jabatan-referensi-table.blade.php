<?php

use function Livewire\Volt\{state,with};
use App\Models\Unsur;
use App\Models\Jabatan;

state([
    'unsurs' => Unsur::all(),
    'selectedUnsurId' => null,
    
]);

with([
    'selectedUnsur' => fn() => $this->unsurs->find($this->selectedUnsurId), 
    // 'jabatans' => fn() => Jabatan::where('unit_kerja', $this->selectedUnsur->id)->get(),
])

?>

<div>
    <label for="unsur" class="form-label">Pilih unsur yang ingin diubah Berdasarkan Unsur</label>
    <select name="unsur" id="unsur" wire:model.change="selectedUnsurId" class="form-select">
        <option value="">Pilih Jabatan</option>
        @foreach ($unsurs as $unsur)
            <option value={{ $unsur->id }}>{{ $unsur->nama }}</option>
        @endforeach 
    </select>
    @if ($selectedUnsurId)
        <p>{{ $selectedUnsur }}</p>
    @endif
</div>
