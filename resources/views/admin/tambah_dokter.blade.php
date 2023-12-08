@extends('layout.layout')

@section('title', 'Tambah Dokter')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Tambah Dokter</h4>
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
                        <form method="post" action="/store_dokter">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="id_dokter">Id Dokter</label>
                                <input type="number" class="form-control" name="id_dokter" required id="id_dokter" required value="{{ old('id_dokter') }}">
                            </div>
                            <div class="mb-3">
                                <label for="nama_dokter">Nama Dokter</label>
                                <input type="text" class="form-control" name="nama_dokter" required id="nama_dokter" value="{{ old('nama_dokter') }}">
                            </div>
                        <div class="mb-3">
                            <label for="spesialis">Spesialis</label>
                            <input type="text" name="spesialis" required class="form-control" id="spesialis" value="{{ old('spesialis') }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp">No Telepon</label>
                            <input type="tel" name="no_telp" id="no_telp" class="form-control" required value="{{ old('no_telp') }}">
                        </div>
                        
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection