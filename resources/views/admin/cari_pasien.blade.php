@extends('layout.layout')

@section('title', 'Cari Pasien')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">


					<div class="left-content">
						<h4 class="content-title mb-1">Cari Pasien</h4>
						<nav aria-label="breadcrumb">
						</nav>
					</div>


				</div>
				<!-- breadcrumb -->


				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">

								<div class="table-responsive">
								    <a href="/data_pasien">Kembali</a>
								    <p>{{count($tb_pasien)}} hasil pencarian untuk <b>{{$keyword}}</b></p>

									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>

					<tr>
												<th>No</th>
                                                <th>No Identitas</th>
												<th>Nama</th>
												<th>Jenis Kelamin</th>
												<th>Alamat</th>
												<th>No Telepon</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
					<?php $i=1 ?>
					  @foreach($tb_pasien as $p)						<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $p->nomor_identitas }}</td>
												<td>{{ $p->nama_pasien }}</td>
                                                <td>
													@if($p->jenis_kelamin === 'L')
														Laki-laki
													@else($p->jenis_kelamin === 'P')
														Perempuan
													@endif
												</td>
												<td>{{ $p->alamat }}</td>
												<td>{{ $p->no_telp }}</td>
												
												<td>

                            <a href="/edit_pasien/{{$p->id_pasien}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" class="d-inline" action="/hapus_pasien">
                                @csrf
                                <input type="hidden" name="id" value="{{$p->id_pasien}}">
                            <button class="btn" onclick="return confirm('Yakin mau menghapus?')"><i class="far fa-trash-alt"></i></button>
                            </form>
									    		</td>
											</tr>

					@endforeach
										</tbody>
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
