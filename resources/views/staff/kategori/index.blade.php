@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Kategori</h4>
                </div>

               

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover no-wrap-header">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($kategori as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>{{ $k->slug }}</td>
                                    <td>{{ $k->deskripsi }}</td>

                                  
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
