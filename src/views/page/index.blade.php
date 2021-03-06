@extends($namespace ."::layouts.master")

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang($namespace . "::base.dashboard-title")</h4>
                </div>
                <div class="card-body">
                    <p>
                        @lang($namespace . "::base.dashboard-text")
                    </p>
                    <p>
                        @lang($namespace . "::base.help-text")
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection