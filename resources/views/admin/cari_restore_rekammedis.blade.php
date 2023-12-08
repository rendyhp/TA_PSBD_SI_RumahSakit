@extends('layout.layout')

@section('title', 'Cari Restore rekammedis')

@section('content')
            <div class="container-fluid mg-t-20">


				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
								<a href="/data_restore_rekammedis">Kembali</a>
								<p>{{count($tb_rekammedis)}} hasil untuk pencarian <b>{{$keyword}}</b></p>
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
						<?php $i=1?>
						@foreach($tb_rekammedis as $o)					<tr>
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
                                                    <form method="post" action="/restore_rekammedis" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_rm" value="{{$o->id_rm}}">
                                                    <button type="submit" class="btn d-inline"><i class="fas fa-sync-alt" onclick="return confirm('Yakin mau merestore data {{$o->keluhan}} ini?')"></i></button>
                                                    </form>
                                                    <form method="post" action="/hapus_rekammedis_permanen" class="d-inline">
                                                        @csrf
                                                    <input type="hidden" name="id_rm" value="{{$o->id_rm}}">
                                                    <button type="submit" class="btn d-inline"><i class="far fa-trash-alt" onclick="return confirm('Yakin mau menghapus data {{$o->keluhan}} selamanya?')" style="color: #ff0000;"></i></button>
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
