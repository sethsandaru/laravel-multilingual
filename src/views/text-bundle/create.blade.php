@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::base.add") - @lang($namespace . "::bundle.title")
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('lml-text-bundle.store')}}" method="POST">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label>@lang($namespace . "::bundle.field-name")</label>
                      	    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label>@lang($namespace . "::bundle.field-description")</label>
                            <input type="text" class="form-control" name="description" value="{{old('description')}}">
                        </div>

                        <div class="text-right">
                            <a href="{{route('lml-text-bundle.index')}}" class="btn btn-secondary">
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