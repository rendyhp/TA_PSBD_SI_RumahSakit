@extends('layout.layout')

@section('title', 'Cari Dokter')

@section('content')
            <div class="container-fluid mg-t-20">


				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
								<a href="/data_restore_dokter">Kembali</a>
								<p>{{count($tb_dokter)}} hasil untuk pencarian <b>{{$keyword}}</b></p>
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
											<th>No</th>
												<th>Nama Dokter</th>
												<th>Spesialis</th>
												<th>Alamat</th>
												<th>No Telepon</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
						<?php $i=1?>
						@foreach($tb_dokter as $o)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{$o->nama_dokter}}</td>
												<td>{{$o->spesialis}}</td>
												<td>{{$o->alamat}}</td>
												<td>{{$o->no_telp}}</td>
												<td>
                                                    <form method="post" action="/restore_dokter" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_dokter" value="{{$o->id_dokter}}">
                                                    <button type="submit" class="btn d-inline"><i class="fas fa-sync-alt" onclick="return confirm('Yakin mau merestore data {{$o->nama_dokter}} ini?')"></i></button>
                                                    </form>
                                                    <form method="post" action="/hapus_dokter_permanen" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_dokter" value="{{$o->id_dokter}}">
                                                    <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$o->nama_dokter}} selamanya?')" style="color: #ff0000;"></i></button>
                                                    </form>
                                                </td>
											</tr>
						@endforeach				</tbody>
									</table>
								</div><!-- bd -->
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection
