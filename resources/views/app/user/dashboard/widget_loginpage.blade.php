 <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    Login
                </h6>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <input class="selectall form-control" id="loginpage" readonly="true" spellcheck="false" type="text" value="{{url('/login')}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#loginpage" style="font-size: 12px;">
                            <i class="fa fa-copy">
                            </i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="card-footer">
                <a class="header-elements-toggle text-default d-md-none">
                    <i class="icon-more">
                    </i>
                </a>
                <div class="">
                    <div class="text-semibold text-center">
                       login
                    </div>
                    <hr class="mb-1 mt-1"/>
                    <div class="card-body text-center">


                        <a href ="{{url('/login')}}" class="btn-primary btn-labeled btn-labeled-left btn-lg  btn-block ">login</a>



                      <!--   <button type="button" class="btn-modal btn btn-primary btn-labeled btn-labeled-left btn-lg  btn-block" data-target="#fsModal" data-toggle="modal"><b><i class="icon-share2"></i></b> Share your referral link to 100+ Social Pages! </button>



                        
                        <div aria-hidden="true" aria-labelledby="myModalLabel" class="sharemodal modal animated bounceIn" id="fsModal" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Share your referral link across the web!!
                                        </h5>

                                        <button class="close" data-dismiss="modal" type="button">
                                            ×
                                        </button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="share_target social_links" data-desc="Best MLM Software that is customizable for any type of online business , multilevel marketing and direct selling business with best support, Try our free MLM software demo today!" data-hashtags="MLM,Software" data-img="https://cloudmlmsoftware.com/sites/default/files/mlm-software.jpg" data-rurl="{{url('login')}}" data-title="Cloud MLM Software for multilevel network marketing, direct selling business" data-url="{{url('login')}}" data-via="cloudmlmsoft">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>