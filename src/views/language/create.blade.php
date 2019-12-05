@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::base.add") - @lang($namespace . "::language.title")
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('lml-language.store')}}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label>@lang($namespace . "::language.table-column-code")</label>
                            <input type="text" class="form-control" name="lang_iso_code" value="{{old('lang_iso_code')}}">
                        </div>
                        <div class="form-group">
                            <label>@lang($namespace . "::language.table-column-name")</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        <div class="text-right">
                            <a href="{{route('lml-language.index')}}" class="btn btn-secondary">
                                @lang($namespace . "::base.cancel")
                            </a>

                            <button class="btn btn-primary">
                                @lang($namespace . "::base.save")
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection