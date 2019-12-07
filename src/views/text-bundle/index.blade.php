@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::bundle.title")

                        <a href="{{route('lml-text-bundle.create')}}" class="btn btn-success">
                            <i class="fa fa-plus"></i> @lang($namespace . "::base.add")
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="bundle-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang($namespace . "::bundle.field-ID")</th>
                                <th>@lang($namespace . "::bundle.field-name")</th>
                                <th>@lang($namespace . "::bundle.field-description")</th>
                                <th>@lang($namespace . "::bundle.field-translated")</th>
                                <th>@lang($namespace . "::bundle.field-last-updated-at")</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include($namespace . "::text-bundle.partials.template")
@endsection

@push('script')
    <script>
        var datatable_obj;

        $(document).ready(function () {
            datatable_obj = $("#bundle-table").DataTable({
                paging: true,
                lengthChange: true,
                searching: false,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{route('lml-text-bundle.retrieve')}}",
                    data: function (data) {
                        data._token = "{{csrf_token()}}";
                        return data;
                    },
                    type: "POST"
                },
                columns: [
                    {
                        data: "id",
                    },
                    {
                        data: "name",
                    },
                    {
                        data: "description",
                    },
                    {
                        data: "translated_text",
                    },
                    {
                        data: "updated_at",
                    },
                    {
                        data: "urls",
                        render: function (data) {
                            return render("#action_template", {url: data});
                        },
                    },
                ],
            });
        });
    </script>
@endpush