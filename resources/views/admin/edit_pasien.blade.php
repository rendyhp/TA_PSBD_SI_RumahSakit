@extends('layout.layout')

@section('title', 'Edit Pasien')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Edit Pasien</h4>
						<nav aria-label="breadcrumb">
						</nav>
					</div>


				</div>
				<!-- breadcrumb -->

				
				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
					    @if($errors->any())
					        <div class="alert alert-danger my-3">
					            <ul>
					                @foreach($errors->all() as $e)
					                <li>{{$e}}</li>
					                @endforeach
					            </ul>
					        </div>
					    @endif
                        <form method="post" action="/update_pasien">
                            @csrf
                            <input type="hidden" value="{{$data->id_pasien}}" name="id_pasien">
                            <div class="mb-3">
                                <label for="number">No Identitas</label>
                                <input type="number" name="nomor_identitas" id="nomor_identitas" required class="form-control" value="{{ $data->nomor_identitas }}">
                            </div>

                            <div class="mb-3">
                            <label for="no_telepon">Nama Pasien</label>
                            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" value="{{ $data->nama_pasien }}" required>
                        </div>


                        <div class="mb-3">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" required class="form-control">
                                
                                    <option value="" disabled selected>- Pilih Jenis Kelamin -</option>
                                    <option value="L" <?php {echo 'selected';} ?>>Laki-Laki</option>
                                    <option value="P" <?php {echo 'selected';} ?>>Perempuan</option>

                                </optgroup>
                                
                                </select>
                            </div>

                        <div class="mb-3">
                                <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required>{{ $data->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon">Telepon</label>
                            <input type="tel" name="no_telp" id="no_telp" class="form-control" value="{{ $data->no_telp }}" required>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection