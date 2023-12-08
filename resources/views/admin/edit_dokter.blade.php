@extends('layout.layout')

@section('title', 'Edit Dokter')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Edit Dokter</h4>
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
                        <form method="post" action="/update_dokter">
                            @csrf
                            <input type="hidden" value="{{$data->id_dokter}}" name="id_dokter">
                        
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama_dokter" required id="nama_dokter" value="{{ $data->nama_dokter }}">
                            </div>
                        <div class="mb-3">
                            <label for="spesialis">Spesialis</label>
                            <input type="text" name="spesialis" required class="form-control" id="spesialis" value="{{ $data->spesialis }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $data->alamat }}">
                        </div>
                        <div class="mb-3">
                            <label for="telepon">Telepon</label>
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