@extends('adminlte::page')
@section('title', 'Pegawai')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tambah Jabatan</div>
                <div class="card-body">
                    <a href="{{ url(Request::server('HTTP_REFERER') == null ? '/kepegawaian/pejabat' : Request::server('HTTP_REFERER')) }}"
                        title="Kembali"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"
                                aria-hidden="true"></i> Kembali</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/kepegawaian/pejabat') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('kepegawaian::pejabat.form', ['formMode' => 'create'])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
