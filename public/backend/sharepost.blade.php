@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '2357629557892476',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="panel panel-flat ">
    <div class="panel-heading">
        <h4 class="panel-title">
           
        </h4>
    </div>

    <div class="panel-body">
    @if(count($all_posts) > 0)
        <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>Sl.no</th>
                                                    <th>Name</th>
                                                    <th>Post</th>
                                                     <th>Type</th>
                                                    
                                                    <th>Share</th>

                                                </tr>

                                            </thead>

                                            <tbody>


                                                    <script>
                                    // Only works after `FB.init` is called
                                    function myFacebookLogin(url,url2) {
                                      FB.ui(
                                     {
                                      method: 'share',
                                      href: url,
                                     
                                    
                                    }, function(response){
                                  
                                    if(response != undefined){
                                    window.location = url2;
                                   }
                                   else{
                                    alert("Post not shared,please try again");
                                  
                                   }


                                    });
                                    }
                                    </script>   

                                            @foreach ($all_posts as $key=>$post)

                                  <tr>

                                      <td>{{$key+1}}</td>
                                      <td>{{$post->name}}</td>
                                      <td><a class="btn btn-info" href="{{url('viewpost/'.$post->id.'/'.$curuser)}}" target="_blank"><i class="fa fa-eye"></i></a> </td>
                                      <td>{{$post->type}} </td>
                                      
                                      <td>
                                          @php
                                          $media=json_decode($post->media);
                                          @endphp
                                    
                                   @if(in_array("facebook", $media))
                                    <button onclick="myFacebookLogin('{{url('viewpost/'.$post->id.'/'.$curuser)}}','{{url('user/share/'.$post->id)}}')"
                                    class="btn btn-primary" title="Facebook"><i class="fa fa-facebook" style="width: 12px"></i></button>
                                    @endif
                                    @if(in_array("linkedin", $media))  
                                    
                                      <a class="btn btn-primary" title="Linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{url('viewpost/'.$post->id.'/'.$curuser)}}" role="button" onclick="postSharing({{$post->id}},'linkedin',{{Auth::user()->id}})"><i class="fa fa-linkedin"></i></a>

                                      @endif
                                    @if(in_array("twitter", $media))
                                    <a class="btn btn-primary" title="Twitter" href="http://twitter.com/intent/tweet?url={{url('viewpost/'.$post->id.'/'.$curuser)}};via=keepcalm" target="_blank" onclick="postSharing({{$post->id}},'twitter',{{Auth::user()->id}})"> 
                                   <i class="fa fa-twitter"></i></a>

                                      @endif
                                    @if(in_array("whatsapp", $media))
                                    <a class="btn btn-primary" title="Whatsapp" href="https://wa.me/?text={{url('viewpost/'.$post->id.'/'.$curuser)}}" target="_blank" onclick="postSharing({{$post->id}},'whatsapp',{{Auth::user()->id}})"> <i class="fa fa-whatsapp"></i></a>
                                      @endif
                                    @if(in_array("instagram", $media))
                                     <a class="btn btn-primary" title="Instagram" href="https://www.instagram.com/?url={{url('viewpost/'.$post->id.'/'.$curuser)}}" target="_blank"> <i class="fa fa-instagram"></i></a>

                                    @endif
                                    </td>

                                  </tr>

                                            @endforeach

                                            </tbody>

                                        </table>
                                        @else
                                        No Data Found
                                        @endif





                         
     
    </div>
</div>




@endsection
@section('overscripts') 
@parent

@endsection
@section('scripts') 
@parent


<script type="text/javascript">
 App.init();
</script>

<script type="text/javascript">
  function postSharing($post,$media,$user){
   var post = $post;
   var media = $media;
   var user = $user;

     $.ajax({

                url:'/user/sharehistory',
                type: "POST",
                dataType: 'json',
                data:{post:post,media:media,user:user},
                    
                success:function(e){
                   
                    if (e.valid === true) {
                      console.log(e.message);
                    } else {
                      console.log(e.message);
                    }
                }                          

            });

  }
</script>


@endsection
