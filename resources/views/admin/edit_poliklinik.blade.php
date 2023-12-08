@extends('layout.layout')

@section('title', 'Edit Poliklinik')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Edit Poliklinik</h4>
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
                        <form method="post" action="/update_poliklinik">
                            @csrf
                            <input type="hidden" value="{{$data->id_poli}}" name="id_poli">
                        
                            <div class="mb-3">
                                <label for="nama_poli">Nama Poliklinik</label>
                                <input type="text" class="form-control" name="nama_poli" required id="nama_poli" value="{{ $data->nama_poli }}">
                            </div>
                        <div class="mb-3">
                            <label for="gedung">Gedung</label>
                            <input type="text" name="gedung" required class="form-control" id="gedung" value="{{ $data->gedung }}">
                        </div>
                        
                    
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection