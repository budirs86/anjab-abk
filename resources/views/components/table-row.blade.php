@props(['jabatan', 'editable'])

<div>
<tr class="collapse fade collapseparent0
    @if ($jabatan->ancestors->count())
        @foreach ($jabatan->ancestors as $ancestor)  
            collapseparent{{ $ancestor->id }}
        @endforeach
    @endif"> 
    
    <td >
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target=".collapseparent{{ $jabatan->id }}">Expand</button>            
        {{-- @if (Request::is('anjab/data-jabatan'))
            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWithDepth{{ $jabatan->depth+1 }}">Expand</button>            
        @else
            <a href="/anjab/analisis-jabatan/create?jabatan={{ $jabatan->id }}" class="btn btn-primary header1">Isi Analisis Jabatan</a>
        @endif --}}
    </td>
    <td>// K-123 //</td>
    <td class="d-flex justify-content-between">
        @if ($editable)
            <a class="text-decoration-underline" href="/anjab/analisis-jabatan/create" style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama_jabatan }}</a>
            <button class="btn btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
        @else
            <p style="margin-left: {{ $jabatan->depth * 25 }}px;"><img width="20px" data-feather="corner-down-right"></img> {{ $jabatan->nama_jabatan }}</p>

        @endif
        {{-- <button class="btn btn-success ms-2"> Tambah Jabatan</button> --}}
        {{-- @if ($request->is('anjab/data-jabatan'))
            <button class="btn btn-success ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modalJabatan" id="addButton" data-bs-atasan="{{ $jabatan->id }}"><img width="20px" data-feather="plus"></img> Tambah Jabatan</button>
            @endif --}}
    </td>
</tr>

@foreach ($jabatan->children as $child)
    @if ($editable)
        <x-table-row :jabatan="$child" :editable="true"/>
    @else
        <x-table-row :jabatan="$child"/>    
    @endif
@endforeach
</div>  