@extends('layouts.auth')
<style type="text/css">
    .card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding-left: 15px;
  padding-right: 15px;
  border: 10px;
  padding-top: 15px;
}
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

          {!!$t_and_c!!} 
        
        </div>
        </div>
    </div>
        
            


  </div>
       




@endsection