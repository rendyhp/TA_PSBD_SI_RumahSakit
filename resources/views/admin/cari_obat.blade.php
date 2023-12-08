@extends('layout.layout')

@section('title', 'Obat')

@section('content')
            <div class="container-fluid mg-t-20">

				
				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
								<a href="/data_obat">Kembali</a>
								<p>{{count($tb_obat)}} hasil untuk pencarian <b>{{$keyword}}</b></p>
									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
											<th>No</th>
												<th>Nama</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
						<?php $i=1?>				    
						@foreach($tb_obat as $o)					<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{$o->nama_obat}}</td>
												<td>{{$o->keterangan}}</td>
												<td>
                            <a href="/edit_obat/{{$o->id_obat}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" class="d-inline" action="/hapus_obat">
                                @csrf
                                <input type="hidden" name="id" value="{{$o->id_obat}}">
                                <button type="submit" class="btn" onclick="return confirm('Yakin mau menghapus?')"><i class="far fa-trash-alt"></i></button>
							</form>					</td>
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