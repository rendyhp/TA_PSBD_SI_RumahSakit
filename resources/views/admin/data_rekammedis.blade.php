@extends('layout.layout')

@section('title', 'Data Rekam Medis')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Data Rekam Medis</h4>
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
							    <form method="post" action="/cari_rekammedis">
							        @csrf
							        <div class="input-group mb-4">
							            <input type="text" placeholder="Cari Rekam Medis..." required class="form-control" name="keyword">
							            <button type="submit" class="btn btn-primary">Cari</button>
							        </div>
							    </form>
							    <a href="/tambah_rekammedis" class="btn btn-success mb-3">Tambah</a>
								<a href="/data_restore_rekammedis" class="btn btn-warning mb-3 mx-1">Restore</a>
								<div class="table-responsive">
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
												<th>No</th>
                                                <th>Tanggal Periksa
												<th>Nama Pasien</th>
												<th>Keluhan</th>
												<th>Nama Dokter</th>
												<th>Diagnosa</th>
												<th>Obat</th>
												<th>Poliklinik</th>
											</tr>
										</thead>
										<tbody>
						<?php $i = ($tb_rekammedis->currentPage()*10) - 9 ?>
						 @foreach($tb_rekammedis as $d)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $d->tgl_periksa }}</td>
												<td>{{ $d->nama_pasien }}</td>
												<td>{{ $d->keluhan }}</td>
												<td>{{ $d->nama_dokter }}</td>
												<td>{{ $d->diagnosa }}</td>
												

												<td>
													@foreach ($datasObat as $da)
														@if ($da->id_rm == $d->id_rm)
															@foreach ($medicine as $das)
																@if ($das->id_obat == $da->id_obat)
																	{{ $das->nama_obat }}
																	<br>
																@endif
															@endforeach
														@endif
													@endforeach
												</td>

												

												<td>{{ $d->nama_poli }}</td>
												<td>
						
                            <a href="/edit_rekammedis/{{$d->id_rm}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" action="/hapus_rekammedis" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_rm" value="{{$d->id_rm}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data Rekam Medis {{$d->id_rm}} sementara?')"></i></button>
                            </form>
                            <form method="post" action="/hapus_rekammedis_permanen" class="d-inline">
                                @csrf
                            <input type="hidden" name="id_rm" value="{{$d->id_rm}}">
                            <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data Rekam Medis {{$d->id_rm}} selamanya?')" style="color: #ff0000;"></i></button>
                            </form>
												</td>
											</tr>
					    @endforeach						
										</tbody>
									</table>
								</div><!-- bd -->
								<div class="mt-3"></div>
					{{$tb_rekammedis->links()}}
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection