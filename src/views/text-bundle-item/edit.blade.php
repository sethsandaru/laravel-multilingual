@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::base.edit") - @lang($namespace . "::bundle-item.title")
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('lml-text-bundle-item.update', [$bundle_item->id])}}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-text-bundle")</label>
                                    <p>
                                        {{$bundle_item->bundle->name}}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-key")</label>
                                    <input type="text" class="form-control" name="key" value="{{old('key', $bundle_item->key)}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-text")</label>
                                    <div id="lang-text-control"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-description")</label>
                                    <input type="text" class="form-control" name="description" value="{{old('description', $bundle_item->description)}}">
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-translated")</label> <br>

                                    <label>
                                        <input type="radio" name="is_translated" value="1" @if(old('is_translated', $bundle_item->is_translated)) checked @endif> @lang($namespace . "::base.yes")
                                    </label>
                                    <label>
                                        <input type="radio" name="is_translated" value="0" @if(!old('is_translated', $bundle_item->is_translated)) checked @endif> @lang($namespace . "::base.no")
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-ID")</label>
                                    <p>
                                        {{$bundle_item->id}}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-last-updated")</label>
                                    <p>
                                        {{$bundle_item->updated_at}}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>@lang($namespace . "::bundle-item.field-number-updates")</label>
                                    <p>
                                        {{$bundle_item->updated_times}}
                                    </p>
                                </div>
                            </div>
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

@push('script')
    <script>
        var textControl;
        $(document).ready(function () {
            textControl = new LangTextControl("#lang-text-control", {
                languages: @json($language_options),
                default_language: "{{App::getLocale()}}",
            });

            @if(old('lang_text', $bundle_item->all_lang_texts))
                textControl.setValues(@json(old('lang_text', $bundle_item->all_lang_texts)));
            @endif
        });
    </script>
@endpush