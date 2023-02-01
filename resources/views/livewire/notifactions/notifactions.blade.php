<li class="nav-item dropdown ">
    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
        aria-expanded="false">
        <i class="ti-bell"></i>
        <span class="badge badge-danger notification-status"> </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
        <div class="dropdown-header notifications">
            <strong>الاشعارات</strong>
            {{-- <span class="badge badge-pill badge-warning">{{ @$results->count() }}</span> --}}
        </div>
        <div class="dropdown-divider"></div>
        @if(isset($results))
            @foreach($results as $result)
            <a href="{{ url('all/offers/'.$result->job_id.'/'.$result->company_id) }}" class="dropdown-item">{{ @$result->bus->code .' : '.$result->issue->category->name .':'.$result->task}} <small class="float-right text-muted time">{{$result->created_at}}</small> </a>
            @endforeach
        @endif
    </div>
</li>