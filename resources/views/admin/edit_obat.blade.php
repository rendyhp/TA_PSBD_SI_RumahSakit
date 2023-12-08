@extends('layout.layout')

@section('title', 'Edit Obat')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Edit Obat</h4>
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
                        <form method="post" action="/update_obat">
                            @csrf
                            <input type="hidden" name="id_obat" value="{{$data->id_obat}}">
							
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama_obat" id="nama_obat" required class="form-control" value="{{ $data->nama_obat }}">
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