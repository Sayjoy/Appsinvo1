 @extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Search Results</div>

                <div class="panel-body">
                    <div class="card">
                        <div class="card-header"><b>{{ $searchResults->count() }} results found for "{{ request('query') }}"</b></div>

                        <div class="card-body">

                            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                <h2>{{ ucfirst($type) }}</h2>

                                @foreach($modelSearchResults as $searchResult)
                                    <ul>
                                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                                    </ul>
                                @endforeach
                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
