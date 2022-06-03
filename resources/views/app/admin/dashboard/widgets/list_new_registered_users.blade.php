<hr>
<div class="card height-367 ">
                  
                    <div class="col-md-12">
                        <div  class="main-head">
                            <div class="container">
                                  {{trans('dashboard.new-registered-users')}} :
                                <h5 class="text-success"> {!! $count_new !!} {{trans('dashboard.new-users')}}</h1>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="row mb-3">
                        @foreach($new_users->chunk(4) as $chunk)
                        
                            
                                @foreach($chunk as $user)

                        <div class="col-md-3 col-6">
                        <div class="card box">
                            <div class="card-img-actions mx-1 mt-1">

                                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $user->profile]), 'Admin', array('class' => 'card-img img-fluid')) }}



                            <div class="card-img-actions-overlay card-img">
                                <a href="{{url('/admin/userprofiles/')}}/{{$user->username}}"  class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" title="view profile">
                                       <i class="icon-user iconstyle"></i>
                                </a>
                           <!--  <button class="btn btn-copy btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 copy-link" title="Copy Link" link="{{url('/')}}/{{$user->username}}"> <i class="icon-link iconstyle"></i></button>
                                 -->

                              
                            </div>
                            </div>

                            <div class="card-body text-center">
                                <h6 class="font-weight-semibold mb-0"> {!! $user->name !!}</h6>
                                <span class="d-block text-muted">{!! $user->username !!} - {!! $user->country !!}</span>

                                
                            </div>
                        </div>
                    </div>
                                
                                @endforeach
                         
                        
                        
                   
                    @endforeach
                     </div>
                </div>
            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script type="text/javascript">

$(document).on('click', '.copy-link', function() {
    var link = $(this).attr('link');
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = link;
    document.body.appendChild(tempInput);
    tempInput.select();
    console.log("Copied the text:", tempInput.value);
    copied = document.execCommand("copy");
    document.body.removeChild(tempInput);
    if(copied){
        new PNotify({
                text: 'Copied to clipboard',
                delay: 1000,
                nonblock: {
                    nonblock: true
                }
            });
    }else{
        new PNotify({
                text: 'Not Copied to clipboard',
                delay: 1000,
                nonblock: {
                    nonblock: true
                }
            });
    }

});
    </script>
