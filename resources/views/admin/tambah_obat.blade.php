@extends('layout.layout')

@section('title', 'Tambah Obat')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Tambah Obat</h4>
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
                        <form method="post" action="/store_obat">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="id_obat">Id obat</label>
                                <input type="number" class="form-control" name="id_obat" required id="id_obat" required value="{{ old('id_obat') }}">
                            </div>
                            <div class="mb-3">
                                <label for="nama_obat">Nama obat</label>
                                <input type="text" class="form-control" name="nama_obat" required id="nama_obat" value="{{ old('nama_obat') }}">
                            </div>
                        <div class="mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="textarea" name="keterangan" required class="form-control" id="keterangan" value="{{ old('nama_obat') }}">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection