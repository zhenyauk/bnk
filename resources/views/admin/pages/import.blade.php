@extends('layouts.cabinet')
@section('title')
    Добро подаловать! | {{env('sitename', 'AstroBank')}}
@stop
@section('content')
    <div class="main-content main-content_height portfolio">
        <div class="row">
            <div class="col col--lg-12" >

                <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Файл для импорта</label><br>
                        <input type="file" id="file" name="import" style="margin:10px">
                    </div>
                    <button type="submit" class="btn btn-success">Импорт</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection