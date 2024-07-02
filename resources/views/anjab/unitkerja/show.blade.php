                @foreach ($jabatans as $jabatan)
                    <x-table-row :jabatan="$jabatan" :buttons="$buttons"/>    
                @endforeach
                    
            </tbody>
