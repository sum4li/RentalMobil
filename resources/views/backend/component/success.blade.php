@if(session()->has('success-message'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>

        <span class="sr-only">Close</span>
                    </button>

            {{session()->get('success-message')}}
        </div>
    </div>
@endif
