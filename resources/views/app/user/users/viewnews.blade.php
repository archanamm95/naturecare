@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
    body{background:white;}
#ct{/*border:1px solid #f1c40f;*/
  /*margin: 100px auto;*/
  text-align:center;
  position:relative;
  color:#fff;
}
.header{
  /*background:#1D1F20;*/
  color:black;
  padding:0 10px;
  font-size:35px;
  position:relative; 
  /*top:28px;*/
}
.corner{/*height:30px;*/
 /* width:30px;
  border-radius:50%;
  border:1px solid #fff;
  transform:rotate(-45deg);  
  position:absolute;
  background:#1D1F20;*/
}

#left_top{
 /* top:-16px;
  left:-16px;*/
  /*border-color:transparent transparent #f1c40f transparent;*/
}
#right_top{
  /*top:-16px;
  right:-16px;*/
  /*border-color:transparent transparent transparent #f1c40f;*/
}
#left_bottom{
 /* bottom:-16px;
  left:-16px;*/
  /*border-color:transparent #f1c40f transparent transparent ;*/
}
#right_bottom{
 /* bottom:-16px;
  right:-16px;*/
  /*border-color:#f1c40f transparent transparent transparent;*/
}
/*img.card-image.img-fluid {
    height: 200px;
    width: 296px;
}*/

.container img {
  width: 100%;
  height: auto;
}

.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  color: transparent;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
  background: transparent;
}

.container .btn:hover {
  background-color: black;
  color: white
}
.p-sty i{
  color:#8A98AC;
  font-size:21px;
}
/*p{padding-top:13px;font-size:18px}*/
</style>
@endsection @section('main')@include('flash::message') @include('utils.errors.list')
<!--   <div class="card card-flat">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">View News</h5>
        <div class="header-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    
        <div class="card-body">
 {{$post->title}}
      





                         
     
    </div>
</div>
 -->


<div id="ct">
  <div class="container">
   <img src="{{ url('uploads/documents/'.$post->thumnail) }}"  class="card-image img-fluid" alt="product"/><a href="{{url('user/download-image/'.$post->thumnail)}}" class="btn" type="button" ><i class="fa fa-download"></i></a></div><br>
  <div class="corner "id="left_top"></div>
  <div class="corner" id="left_bottom"></div>
  <div class="corner" id="right_top"></div>
  <div class="corner" id="right_bottom"></div>
  <span class="header"> {{$post->title}}</span>
  <blockquote class="p-sty">
    <p ><i>{!!$post->content!!} </i></p>
  </blockquote>
</div>


@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
 @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 @endsection