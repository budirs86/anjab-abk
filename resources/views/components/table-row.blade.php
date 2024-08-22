@props(['jabatan','type'])

<div class="">
    <tr wire:key="{{ $jabatan->id }}">
        <td>{{ $jabatan->kode == null ? 'N/A' : $jabatan->kode }}</td>
        <td class="d-flex justify-content-between">
            <div class="d-flex gap-1" style="margin-left: {{ 25 * $jabatan->depth }}px">
                @if ($jabatan->depth > 0)
                    <i class="fa-solid fa-chevron-right mt-1"></i>
                @endif
                <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama}}</p>
            </div>
            @if ($type == 'create')
                <div class="div">
                    <span class="badge text-bg-warning">Informasi Jabatan Belum Lengkap</span>
                    <a href="{{ route('anjab.jabatan.edit.1', ['jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button "><i class="fa-solid fa-edit"></i> Ubah Informasi Jabatan</a>
                    <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><i class="fa-solid fa-plus"></i> Tambah Jabatan Bawahan</button>
                    <button data-bs-target="#deleteJabatanModal" data-bs-toggle="modal" class="btn btn-danger btn-sm" wire:click="deleteJabatan({{ $jabatan }})"><i class="fa-solid fa-trash"></i> Hapus Jabatan</button>
                </div>
            @elseif ($type == 'show')
                <div class="div">
                    <a href="{{ route('anjab.ajuan.jabatan.show', ['ajuan' => $this->ajuan,'jabatan'=> $jabatan->id, 'id' => '']) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="eye"></img> Lihat Informasi Jabatan</a>
                </div>
            @endif
        </td>
    </tr>

    @if (empty($this->search))
        {{-- @dd($jabatan->children()) --}}
        @foreach ($jabatan->children as $child)
            {{-- @dd('sanity check') --}}
            <x-table-row :jabatan="$child" wire:key="{{ $child->id }}" :type="$type"></x-table-row>
        @endforeach
    @endif  
</div>