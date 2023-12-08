@extends('layout.layout')

@section('title', 'Tambah Pasien')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Tambah Pasien</h4>
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
                        <form method="post" action="/store_pasien">
                            @csrf

                            <div class="mb-3">
                                <label for="id_pasien">Id Pasien</label>
                                <input type="number" class="form-control" name="id_pasien" required id="id_pasien" value="{{ old('id_pasien') }}">
                            </div>
                            <div class="mb-3">
                                <label for="nomor_identitas">No Identitas</label>
                                <input type="number" class="form-control" name="nomor_identitas" required id="nomor_identitas" value="{{ old('nomor_identitas') }}">
                            </div>
                            <div class="mb-3">
                                <label for="nama_pasien">Nama Pasien</label>
                                <input type="text" class="form-control" name="nama_pasien" required id="nama_pasien" value="{{ old('nama_pasien') }}">
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
                                <input type="textarea" class="form-control" name="alamat" required id="alamat" value="{{ old('alamat') }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_telp">No Telepon</label>
                                <input type="text" class="form-control" name="no_telp" required id="no_telp" value="{{ old('no_telp') }}">
                            </div>
                        
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection