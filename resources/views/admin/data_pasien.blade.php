@extends('layout.layout')

@section('title', 'Data Pasien')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">


					<div class="left-content">
						<h4 class="content-title mb-1">Data Pasien</h4>
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
							    <form method="post" action="/cari_pasien">
							        @csrf
							        <div class="input-group mb-4">
							            <input type="text" placeholder="Cari Nama Pasien..." required class="form-control" name="keyword">
							            <button type="submit" class="btn btn-primary">Cari</button>
							        </div>
							    </form>
							    <a href="/tambah_pasien" class="btn btn-success mb-3">Tambah</a>
							    <a href="/data_restore_pasien" class="btn btn-warning mb-3 mx-1">Restore</a>
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
												<th>No</th>
												<th>No Identitas</th>
												<th>Nama Pasien</th>
												<th>Jenis Kelamin</th>
												<th>Alamat</th>
												<th>No Telepon</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
						<?php $i = ($tb_pasien->currentPage()*10) - 9 ?>
						 @foreach($tb_pasien as $d)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $d->nomor_identitas}}
												<td>{{ $d->nama_pasien }}</td>
                                                <td>
													@if($d->jenis_kelamin === 'L')
														Laki-laki
													@else($d->jenis_kelamin === 'P')
														Perempuan
													@endif
												</td>
												<td>{{ $d->alamat }}</td>
												<td>{{ $d->no_telp }}</td>
												<td>

                            <a href="/edit_pasien/{{$d->id_pasien}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" action="/hapus_pasien" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_pasien" value="{{$d->id_pasien}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$d->nama_pasien}} sementara?')"></i></button>
                            </form>
                            <form method="post" action="/hapus_pasien_permanen" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_pasien" value="{{$d->id_pasien}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$d->nama_pasien}} selamanya?')" style="color: #ff0000;"></i></button>
                            </form>
												</td>
											</tr>
					    @endforeach
										</tbody>
									</table>
								</div><!-- bd -->
								<div class="mt-3"></div>
					{{$tb_pasien->links()}}
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection
