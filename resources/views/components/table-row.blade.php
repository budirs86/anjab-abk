@props(['jabatan'])

<tr class="collapse fade collapse-depth-{{ $jabatan->depth }} collapse-depth-{{ $jabatan->depth+1 }} " id="collapseWithDepth{{ $jabatan->depth }}">
    <td>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWithDepth{{ $jabatan->depth+1 }}">Expand</button>            
        {{-- @if (Request::is('anjab/data-jabatan'))
            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWithDepth{{ $jabatan->depth+1 }}">Expand</button>            
        @else
            <a href="/anjab/analisis-jabatan/create?jabatan={{ $jabatan->id }}" class="btn btn-primary header1">Isi Analisis Jabatan</a>
        @endif --}}
    </td>
    <td>// K-123 //</td>
    <td class="d-flex justify-content-between">
        <p style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama_jabatan }}</p>
        {{-- <button class="btn btn-success ms-2"> Tambah Jabatan</button> --}}
        {{-- @if ($request->is('anjab/data-jabatan'))
            <button class="btn btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
            @endif --}}
        <button class="btn btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
        </td>
</tr>

@foreach ($jabatan->children as $child)
    <x-table-row :jabatan="$child"/>
@endforeach
