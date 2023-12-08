@extends('layout.layout')

@section('title', 'Tambah Rekam Medis')

@section('content')
    <div class="container-fluid mg-t-20">

				<!-- breadcrumb -->

				<div class="breadcrumb-header justify-content-between">

					
					<div class="left-content">
						<h4 class="content-title mb-1">Tambah Rekam Medis</h4>
						<nav aria-label="breadcrumb">
						</nav>
					</div>


				</div>
				<!-- breadcrumb -->

				
				<!-- row opened -->
				<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
					    @if($errors->any())
					        <div class="alert alert-danger my-3">
					            <ul>
					                @foreach($errors->all() as $e)
					                <li>{{$e}}</li>
					                @endforeach
					            </ul>
					        </div>
					    @endif
                        <form method="post" action="/store_rekammedis">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="id_rm">Id Rekam Medis</label>
                                <input type="number" class="form-control" name="id_rm" required id="id_rm" required value="{{ old('id_rm') }}">
                            </div>
                            <div class="mb-3">
                                <label for="id_pasien">Id Pasien</label>
                                <select class="form-control m-bot15" name="id_pasien" id="id_pasien" required>
                                    @foreach($datas as $data)
                                        <option value="{{ $data->id_pasien }}" <?php {echo 'selected';} ?>>{{ $data->nama_pasien }}</option> 
                                    @endforeach
                                </select>
                            </div>




                            <div class="mb-3">
                            <label for="keluhan">Keluhan</label>
                            <textarea name="keluhan" id="keluhan" class="form-control" required>{{ old('keluhan') }}</textarea>
                        </div>
                        <div class="mb-3">
                                <label for="id_dokter">Id dokter</label>
                                <select class="form-control m-bot15" name="id_dokter" id="id_dokter" required>
                                    @foreach($datasDokter as $data)
                                        <option value="{{ $data->id_dokter }}" <?php {echo 'selected';} ?>>{{ $data->nama_dokter }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        <div class="mb-3">
                            <label for="diagnosa">Diagnosa</label>
                            <textarea name="diagnosa" id="diagnosa" class="form-control" required>{{ old('diagnosa') }}</textarea>
                        </div>

                        

                        <div class="mb-3">
                                <label for="id_poli">Id Poliklinik</label>
                                <select class="form-control m-bot15" name="id_poli" id="id_poli" required>
                                    @foreach($datasPoliklinik as $data)
                                        <option value="{{ $data->id_poli }}" <?php {echo 'selected';} ?>>{{ $data->nama_poli }}</option> 
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_obat">Obat</label>
                                <select multiple class="form-control m-bot15" name="id_obat[]" id="id_obat" required>
                                    @foreach($datasObat as $data)
                                        <option value="{{ $data->id_obat }}" {{ in_array($data->id_obat, $selectedObats) ? 'selected' : '' }}>
                                            {{ $data->nama_obat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        <div class="mb-3">
                            <label for="tgl_periksa">Tanggal Periksa</label>
                            <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control" required value="{{ old('tgl_periksa') }}">
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </form>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->


            </div>
@endsection