@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::base.edit") - @lang($namespace . "::bundle.title")
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('lml-text-bundle.update', [$bundle->id])}}" method="POST">
                        @method('PUT')
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label>@lang($namespace . "::bundle.field-name")</label>
                      	    <input type="text" class="form-control" name="name" value="{{old('name', $bundle->name)}}">
                        </div>
                        <div class="form-group">
                            <label>@lang($namespace . "::bundle.field-description")</label>
                            <input type="text" class="form-control" name="description" value="{{old('description', $bundle->description)}}">
                        </div>
                        <div class="form-group">
                            <label>@lang($namespace . "::bundle.field-translated")</label> <br>

                            <label>
                                <input type="radio" name="is_translated" value="1" @if(old('is_translated', $bundle->is_translated)) checked @endif> @lang($namespace . "::base.yes")
                            </label>
                            <label>
                                <input type="radio" name="is_translated" value="0" @if(!old('is_translated', $bundle->is_translated)) checked @endif> @lang($namespace . "::base.no")
                            </label>
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