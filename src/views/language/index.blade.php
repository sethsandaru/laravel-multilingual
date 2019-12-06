@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::language.title")

                        <a href="{{route('lml-language.create')}}" class="btn btn-success">
                            <i class="fa fa-plus"></i> @lang($namespace . "::base.add")
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url()->current()}}">
                        <div class="form-group">
                            <label>@lang($namespace . "::language.search-by-keyword")</label>
                            <input type="text" class="form-control" name="keyword" value="{{request()->get('keyword')}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">@lang($namespace . "::language.search")</button>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang($namespace . "::language.table-column-code")</th>
                                <th>@lang($namespace . "::language.table-column-name")</th>
                                <th>@lang($namespace . "::language.table-column-last-updated")</th>
                                <th>@lang($namespace . "::language.table-column-actions")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($languages as $language)
                                <tr>
                                    <td>{{$language->lang_iso_code}}</td>
                                    <td>{{$language->name}}</td>
                                    <td>{{$language->updated_at}}</td>
                                    <td>
                                        <a href="{{route('lml-language.edit', [$language->lang_iso_code])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        |
                                        <a class="delete-btn" href="javascript:void(0);" data-id="{{$language->lang_iso_code}}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>

                                        <form action="{{route('lml-language.destroy', [$language->lang_iso_code])}}" id="deleteForm{{$language->lang_iso_code}}" method="POST">
                                            {!! csrf_field() !!}
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        @lang($namespace . "::language.no-result")
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="col-12">
                        {!! $languages->appends(request()->all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $(".delete-btn").click(function () {
                if (!confirm("@lang($namespace .'::base.are-you-sure')")) {
                    return;
                }

                var id = $(this).attr('data-id');
                $("#deleteForm" + id).submit();
            });
        });
    </script>
@endpush