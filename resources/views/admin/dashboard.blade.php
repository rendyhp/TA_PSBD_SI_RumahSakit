@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
            <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">


					<div class="left-content">
						<h4 class="content-title mb-1">Dashboard</h4>
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
                                @foreach($tb_user as $d)
                                    Selamat datang {{ $d->nama_user }}...
                                @endforeach
                                </div><!-- bd -->
                                Ini adalah program Sistem Informasi Rumah Sakit, di mana akan menampilkan data dan CRUD dari Entitas yang diperlukan.
                                 Terakhir, yaitu Rekam Medis berisi join dari semua tabel yang dibuat.

                            <div class="mt-3"></div>
                        </div>

						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection
