@extends('layout.layout')

@section('title', 'Cari Obat')

@section('content')
            <div class="container-fluid mg-t-20">


				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
								<a href="/data_restore_obat">Kembali</a>
								<p>{{count($tb_obat)}} hasil untuk pencarian <b>{{$keyword}}</b></p>
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
											<th>No</th>
											<th>No</th>
												<th>Nama Obat</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
						<?php $i=1?>
						@foreach($tb_obat as $o)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $d->nama_obat }}</td>
												<td>{{ $d->keterangan }}</td>
												<td>
                                                    <form method="post" action="/restore_obat" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_obat" value="{{$o->id_obat}}">
                                                    <button type="submit" class="btn d-inline"><i class="fas fa-sync-alt" onclick="return confirm('Yakin mau merestore data {{$o->nama_obat}} ini?')"></i></button>
                                                    </form>
                                                    <form method="post" action="/hapus_obat_permanen" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_obat" value="{{$o->id_obat}}">
                                                    <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$o->nama_obat}} selamanya?')" style="color: #ff0000;"></i></button>
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
