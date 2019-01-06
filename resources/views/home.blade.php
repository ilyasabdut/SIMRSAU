@extends('layouts.app')
     <title>{{ env('APP_NAME') }} - Redirect</title> 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mengalihkan</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

   <p>  Anda telah masuk! Anda akan otomatis masuk ke halaman utama dalam <span id="countdown"> </span> detik. 
   </p>

          <script>
          var param = 3; 
          var today = new Date();
          var newDate = today.setSeconds(today.getSeconds() + param);
          $('#countdown').countdown(newDate, function(event) {
            $(this).html(event.strftime('%S'));
          });
          </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
