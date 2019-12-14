@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang($namespace . "::bundle-item.title")

                        <a href="{{route('lml-text-bundle-item.create')}}" class="btn btn-success">
                            <i class="fa fa-plus"></i> @lang($namespace . "::base.add")
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form id="searchForm">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>@lang($namespace . "::base.keyword")</label>
                                <input type="text" id="txt-keyword" name="keyword" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang($namespace . "::bundle-item.filter-text-bundle")</label>
                                <select id="filter-bundle" class="form-control">
                                    <option value="" selected>@lang($namespace . "::bundle-item.all-bundle")</option>
                                    @foreach($text_bundle_options as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>@lang($namespace . "::bundle-item.filter-lang-text-type")</label>
                                <select id="filter-lang" class="form-control">
                                    <option value="" selected>@lang($namespace . "::bundle-item.current-language", ['lang' => App::getLocale()])</option>
                                    @foreach($language_options as $lang_code => $name)
                                        <option value="{{$lang_code}}">{{$name}} ({{$lang_code}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary btn-filter">@lang($namespace . "::base.apply")</button>
                            <button class="btn btn-secondary btn-clear">@lang($namespace . "::base.clear")</button>
                        </div>
                    </form>
                    
                    <table id="bundle-item-table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang($namespace . "::bundle-item.field-ID")</th>
                                <th>@lang($namespace . "::bundle-item.field-text-bundle")</th>
                                <th>@lang($namespace . "::bundle-item.field-key")</th>
                                <th>@lang($namespace . "::bundle-item.field-text")</th>
                                <th>@lang($namespace . "::bundle-item.field-description")</th>
                                <th>@lang($namespace . "::bundle-item.field-translated")</th>
                                <th>@lang($namespace . "::bundle-item.field-last-updated")</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include($namespace . "::partials.template")
@endsection

@push('script')
    <script>
        var datatable_obj;
        var is_loading = true;
        var keyword, bundle_id, show_lang;

        $(document).ready(function () {
            // get cache??
            keyword = sessionStorage.getItem(CACHE_KEY);
            bundle_id = sessionStorage.getItem(CACHE_BUNDLE);
            show_lang = sessionStorage.getItem(CACHE_LANG);
            if (!_.isEmpty(keyword)) {
                $("#txt-keyword").val(keyword);
            }
            if (!_.isEmpty(bundle_id)) {
                $("#filter-bundle").val(bundle_id);
            }
            if (!_.isEmpty(show_lang)) {
                $("#filter-lang").val(show_lang);
            }

            // datatable
            datatable_obj = $("#bundle-item-table").DataTable({
                paging: true,
                lengthChange: true,
                searching: false,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{route('lml-text-bundle-item.retrieve')}}",
                    data: function (data) {
                        is_loading = true;
                        // set csrf
                        data._token = "{{csrf_token()}}";

                        // filter by keyword
                        data.filter_keyword = keyword;
                        data.filter_bundle = bundle_id;

                        // show by lang
                        data.language = show_lang;

                        return data;
                    },
                    type: "POST"
                },
                columns: [
                    {
                        data: "id",
                    },
                    {
                        data: "bundle_name",
                    },
                    {
                        data: "key",
                    },
                    {
                        data: "text_value",
                    },
                    {
                        data: "description",
                    },
                    {
                        data: "is_translated",
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
                drawCallback: afterRenderedTable,
            });

            // filtering...
            $("#searchForm").submit(doFilter);
            $(".btn-filter").click(doFilter);
            $(".btn-clear").click(clearFilter);

            // delete
            $("#bundle-table").on('click', '.delete-btn', deleteItem);
        });

        var CACHE_KEY = "TEXT_BUNDLE_ITEM_CACHE";
        var CACHE_BUNDLE = "TEXT_BUNDLE_ITEM_BUNDLE";
        var CACHE_LANG = "TEXT_BUNDLE_ITEM_LANG";

        function doFilter(e) {
            e.preventDefault();
            if (is_loading) {
                return;
            }

            // prepare & cache
            keyword = $("#txt-keyword").val();
            sessionStorage.setItem(CACHE_KEY, keyword);

            show_lang = $("#filter-lang").val();
            sessionStorage.setItem(CACHE_LANG, show_lang);

            bundle_id = $("#filter-bundle").val();
            sessionStorage.setItem(CACHE_BUNDLE, bundle_id);

            // draw table
            reloadTable();
        }

        function clearFilter() {
            if (is_loading) {
                return;
            }

            // remove data
            sessionStorage.removeItem(CACHE_KEY);
            sessionStorage.removeItem(CACHE_BUNDLE);
            sessionStorage.removeItem(CACHE_LANG);
            keyword = show_lang = bundle_id = "";
            $("#txt-keyword, #filter-lang, #filter-bundle").val(null);

            // draw table again
            reloadTable();
        }
        
        function reloadTable() {
            datatable_obj.draw();
        }
        
        function afterRenderedTable() {
            // $("#bundle-item-table").css('width', '100%');
            is_loading = false;
        }

        function deleteItem(e) {
            if (!e) {
                return;
            }

            var submit_url = $(this).attr('data-url');
            if (!submit_url) {
                return;
            }

            // confirmation first
            if (!confirm("@lang($namespace . "::bundle-item.delete-warning")")) {
                return;
            }

            // request API to delete
            $.ajax({
                type: "DELETE",
                url: submit_url,
                dataType: 'json',
                data: {
                    _token: "{{csrf_token()}}"
                }
            }).done(function (data) {
                alert(data.msg);
                reloadTable();
            });
        }
    </script>
@endpush