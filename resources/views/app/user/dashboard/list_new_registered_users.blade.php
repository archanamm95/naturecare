<div class="card height-367 ">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{trans('dashboard.new-registered-users')}} : 
                            <span class="pull-right label label-success">
                                {!! $count_sponsored_users !!} {{trans('dashboard.new-users')}}
                            </span>
                        </h4>
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="row mb-3 row-xs">
                        @foreach($sponsored_users->chunk(4) as $chunk)
                        
                            
                                @foreach($chunk as $user)

                        <div class="col-xl-3 col-sm-3 col-6">
                        <div class="card box">
                            <div class="card-img-actions mx-1 mt-1">

                                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $user->profile]), 'Admin', array('class' => 'card-img img-fluid')) }}

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
