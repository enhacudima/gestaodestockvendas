@if(count($errors)>0)
    @foreach($errors->all() as $error)
        
        <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                </button>
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
        <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                </button>
            {{session('success')}}
        </div>
@endif

@if(session('error'))
        
        <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                </button>
            {{session('error')}}

        </div>
@endif