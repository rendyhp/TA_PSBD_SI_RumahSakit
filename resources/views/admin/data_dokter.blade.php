@extends('layout.layout')

@section('title', 'Data Dokter')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">


					<div class="left-content">
						<h4 class="content-title mb-1">Data Dokter</h4>
						<nav aria-label="breadcrumb">
						</nav>
					</div>


				</div>
				<!-- breadcrumb -->


				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
					    @if(session('sukses'))
					    <div class="alert alert-success my-4">
					        {{session('sukses')}}
					    </div>
					    @endif
					    @if(session('hapus'))
					    <div class="alert alert-warning my-4">
					        {{session('hapus')}}
					    </div>
					    @endif
					    @if(session('update'))
					    <div class="alert alert-info my-4">
					        {{session('update')}}
					    </div>
					    @endif
						<div class="card">
							<div class="card-body">
							    <form method="post" action="/cari_dokter">
							        @csrf
							        <div class="input-group mb-4">
							            <input type="text" placeholder="Cari Nama Dokter..." required class="form-control" name="keyword">
							            <button type="submit" class="btn btn-primary">Cari</button>
							        </div>
							    </form>
							    <a href="/tambah_dokter" class="btn btn-success mb-3 mx-1">Tambah</a>
							    <a href="/data_restore_dokter" class="btn btn-warning mb-3 mx-1">Restore</a>
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Spesialis</th>
												<th>Alamat</th>
												<th>No Telepon</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
						<?php $i = ($tb_dokter->currentPage()*10) - 9 ?>
						 @foreach($tb_dokter as $d)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $d->nama_dokter }}</td>
												<td>{{ $d->spesialis }}</td>
												<td>{{ $d->alamat }}</td>
												<td>{{ $d->no_telp }}</td>
												<td>

                            <a href="/edit_dokter/{{$d->id_dokter}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" action="/hapus_dokter" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_dokter" value="{{$d->id_dokter}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$d->nama_dokter}} sementara?')"></i></button>
                            </form>
                            <form method="post" action="/hapus_dokter_permanen" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_dokter" value="{{$d->id_dokter}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$d->nama_dokter}} selamanya?')" style="color: #ff0000;"></i></button>
                            </form>
												</td>
											</tr>
					    @endforeach
										</tbody>
									</table>
								</div><!-- bd -->
								<div class="mt-3"></div>
					{{$tb_dokter->links()}}
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection
