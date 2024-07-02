<div class="modal fade" tabindex="-1" id="modalJabatan">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambahkan Jabatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/anjab/data-jabatan" method="POST" id="jabatanForm">
                @csrf
                <input type="hidden" name="parent_id" id="parent_id" value="{{ old('parent_id',$jabatan->id) }}">
                <input type="hidden" name="analisisjabatan_id" id="analisisjabatan_id" value="">
                <div class="mb-3">
                    <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
                    <select class="form-select" name="jenis_jabatan_id" id="jenis_jabatan">
                        @foreach ($jenisJabatan as $jenis)
                            <option value="{{ $jenis->id }}" @if ($jenis->id == old('jenis_jabatan_id')) selected @endif>{{ $jenis->jenis_jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="eselon_id" class="form-label">Eselon</label>
                    <select class="form-select" name="eselon_id" id="eselon_id">
                        @foreach ($eselon as $esel)
                            <option value="{{ $esel->id }}" @if ($esel->id == old('eselon_id')) selected @endif>{{ $esel->eselon }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="golongan_id" class="form-label">Golongan</label>
                    <select class="form-select" name="golongan_id" id="golongan_id">
                        @foreach ($golongan as $gol)
                            <option value="{{ $gol->id }}" @if ($gol->id == old('golongan_id')) selected @endif>{{ $gol->golongan . " - " . $gol->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" placeholder="Diisi Secara Otomatis" value="contoh">
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="unit_kerja" class="form-label">Unit Kerja</label>
                        <select class="form-select @error('unit_kerja') is-invalid @enderror" id="unit_kerja"
                            name="unit_kerja_id">
                            @foreach ($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->id }}">{{ $unitKerja->nama }}</option>
                            @endforeach
                        </select>
                    @error('unit_kerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
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
                    <button class="btn btn-primary header1" type="submit" id="submitJabatan">Tambah Jabatan</button>
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