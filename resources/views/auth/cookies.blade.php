@extends('layouts.auth')
<style type="text/css">

.legal_doc{
 
    margin: 20px auto 90px;
    padding: 0 30px 30px;
    border: 10px solid #e3e8e9;
    max-width: 1024px;
    color: #4e5a5e;

}
</style>
@section('content')
 <div class="card card-default">
    <div class="card-body">
      <div id="legal_doc" class="legal_doc">
        <div class="text-center">

           {!!$cookie!!} 
        
        </div>
        </div>
    </div>
        
            


  </div>
       




@endsection