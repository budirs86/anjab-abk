@props(['jabatan', 'editable','abk','buttons'])

<div>
<tr class="collapseparent0"> 
    
    {{-- <td >
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent{{ $jabatan->id }}">Expand</button>            
        {{-- @if (Request::is('anjab/data-jabatan'))
            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWithDepth{{ $jabatan->depth+1 }}">Expand</button>            
        @else
            <a href="/anjab/analisis-jabatan/create?jabatan={{ $jabatan->id }}" class="btn btn-primary header1">Isi Analisis Jabatan</a>
        @endif 
    </td> --}}
    <td>// K-123 //</td>
    <td class="d-flex justify-content-between">
        <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama }}</p>
        <div class="div">
            @foreach ($buttons as $button)
                @if ($button == 'ubah-informasi-jabatan')
                    <a href="{{ route('anjab.jabatan.edit', ['jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="edit-3"></img> Ubah Informasi Jabatan</a>
                @endif
                @if ($button == 'tambah-jabatan-bawahan')
                    <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan Bawahan</button>
                @endif
                @if ($button == 'lihat-informasi-jabatan')
                    <a href="" class="btn btn-sm btn-primary">Lihat Informasi Jabatan</a>
                @endif
                @if ($button == 'isi-informasi-abk')
                    <a href="{{ route('abk.data-abk') }}" class="btn btn-sm btn-primary add-button"><img width="20px" data-feather="edit-3"></img> Isi Informasi ABK</a>
                @endif
                @if ($button == 'lihat-informasi-abk')
                    <a href="{{ route('abk.jabatan.show',['id' => request()->periode, 'jabatan' => $jabatan->id ]) }}" class="btn btn-sm btn-primary">Lihat Informasi ABK</a>         
                @endif
            @endforeach
        </div>
        
        {{-- @if ($editable && !$abk)
            <p class="" href="/anjab/analisis-jabatan/create" style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama }}</p>
            <div class="">
                <a href="{{ route('create',['nama_jabatan' => $jabatan->nama]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="edit-3"></img> Ubah Informasi Jabatan</a>
                <button class="btn btn-sm btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan Bawahan</button>
            </div>
        @elseif(!$editable && !$abk)
            <p style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama }}</p>
            <a href="" class="btn btn-sm btn-primary">Lihat Informasi Jabatan</a>            
        @elseif($editable && $abk)
            <p style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama }}</p>
            <a href="{{ route('abk.data-abk') }}" class="btn btn-sm btn-primary add-button"><img width="20px" data-feather="edit-3"></img> Isi Informasi ABK</a>
        @else
            <p style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama }}</p>
            <a href="{{ route('abk.jabatan.show',['id' => request()->periode, 'jabatan' => $jabatan->id ]) }}" class="btn btn-sm btn-primary">Lihat Informasi ABK</a>
        @endif --}}
        {{-- <button class="btn btn-success ms-2"> Tambah Jabatan</button> --}}
        {{-- @if ($request->is('anjab/data-jabatan'))
            <button class="btn btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
            @endif --}}
    </td>
</tr>
{{-- 
@foreach ($jabatan->children as $child)
    <x-table-row :jabatan="$child" :buttons="$buttons"/>
@endforeach --}}
</div>  