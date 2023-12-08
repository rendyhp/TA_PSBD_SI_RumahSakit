@extends('layout.layout')

@section('title', 'Data Restore Dokter')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">


					<div class="left-content">
						<h4 class="content-title mb-1">Data Restore Dokter</h4>
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
								
							<a href="/data_dokter">Kembali</a>
							    <form method="post" action="/cari_restore_dokter">
							        @csrf
							        <div class="input-group mb-4">
							            <input type="text" placeholder="Cari Nama Dokter..." required class="form-control" name="keyword">
							            <button type="submit" class="btn btn-primary">Cari</button>
							        </div>
							    </form>
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

                            <form method="post" action="/restore_dokter" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_dokter" value="{{$d->id_dokter}}">
                            <button type="submit" class="btn d-inline"><i class="fas fa-sync-alt" onclick="return confirm('Yakin mau merestore data {{$d->nama_dokter}} ini?')"></i></button>
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
