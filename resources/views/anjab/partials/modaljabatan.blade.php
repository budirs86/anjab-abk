<div class="modal fade" tabindex="-1" id="modalExample">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambahkan Jabatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/anjab/data-jabatan" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" name="nama_jabatan" placeholder="Masukkan Nama Jabatan" value="{{ old('nama_jabatan') }}">
                    @error('nama_jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="unit_kerja" class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"  id="unit_kerja" name="unit_kerja" placeholder="Masukkan Unit Kerja">
                    @error('unit_kerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary header1" type="submit">Tambah Jabatan</button>
                </div>
                
            
            </form>
        </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>