@extends('layouts.main')

@section('container')
    {{-- <p>{{ $jabatans->first()->nama_jabatan }}</p> --}}
    <div style="width:100%; height:700px;" id="tree"></div>
        
    {{-- @dd($jabatans) --}}

    
        
                

<script>
    let nodes = @json($jabatans);
    console.
    nodes = nodes.map(node => ({
            id: node.id,
            pid: node.parent_id, // Adjust if your parent id field is different
            name: node.nama_jabatan // Adjust if your name field is different
        }));

    
    let chart = new OrgChart(document.getElementById("tree"), {
        nodeBinding: {
            field_0: "name"
        },
        nodes: nodes
    });
    
</script> 
 
                
            
 
                
            
@endsection