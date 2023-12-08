@extends('layout.layout')

@section('title', 'Cari Poliklinik')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Cari Poliklinik</h4>
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
								    <a href="/data_poliklinik">Kembali</a>
								    <p>{{count($tb_poliklinik)}} hasil pencarian untuk <b>{{$keyword}}</b></p>

									<table class="table table-striped mg-b-0 text-md-nowrap border">
										<thead>
								
					<tr>
												<th>No</th>
                                                <th>Nama Poliklinik</th>
												<th>Gedung</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
					<?php $i=1 ?>
					  @foreach($tb_poliklinik as $p)						<tr>
												<th scope="row">{{$i++}}</th>
												<td>{{ $p->nama_poli }}</td>
												<td>{{ $p->gedung }}</td>
												<td>

                            <a href="/edit_poliklinik/{{$p->id_poli}}"><i class="fas fa-pencil-alt" style="margin-right:5px"></i></a>
                            <form method="post" class="d-inline" action="/hapus_poliklinik">
                                @csrf
                                <input type="hidden" name="id_poli" value="{{$p->id_poli}}">
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