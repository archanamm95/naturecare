
                <div class="card">
                            <div class="card-header header-elements-inline">
                                <h5 class="card-title">{{trans('dashboard.top_users')}}</h5>
                                <div class="header-elements">
                                    
                                </div>
                            </div>

                            <div class="card-body">
                                <ul class="media-list">
                                   

                                     @foreach($top_recruiters as $user)

                                    <li class="media">
                                        <div class="mr-3">
                                            <a href="#">
                                                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $user->profile]), $user->username, array('class' => 'rounded-circle','width'=>'40','height'=>'40')) }}

                                                 

                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <div class="media-title font-weight-semibold"><a href="{{url('admin/userprofiles/')}}/{{$user->username}}" target="_blank">{{$user->username}}</a></div>
                                            <span class="text-muted">{{$user->name}}</span>
                                           
                                        </div>

                                        <div class="align-self-center ml-3">
                                            <div class="list-icons list-icons-extended">

                                                 <span class="list-icons-item badge bg-blue-400 align-self-center ml-auto">
                                                {{$user->count}}
                                            </span>


                                                <a class="list-icons-item button btn bg-blue btn-xs" href="{{url('/admin/sponsortree?st='.$user->username)}}" target="_blank">
                                                <i class="icon-tree5 position-left">
                                                </i>
                                               {{trans('dashboard.tree')}}
                                            </a>
                                            <a class="list-icons-item  button btn bg-blue btn-xs" href="{{url('/admin/userprofiles',$user->username )}}" target="_blank">
                                                <i class="icon-tree5 position-left">
                                                </i>
                                                {{trans('dashboard.profile')}}
                                            </a>


                                               
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                   
                                </ul>
                            </div>
                        </div>
