
    <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('dashboard.referral_link')}}
                </h6>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink" readonly="true" spellcheck="false" type="text" value="{{url('/',Auth::user()->username)}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#referrallink" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="card-footer">
               
                <div class="">
                    <div class="text-semibold text-center">
                       {{trans('dashboard.share')}}
                    </div>
                    <hr class="mb-1 mt-1"/>
                    <div class="card-body text-center">

                         <button class="btn btn-primary btn-labeled btn-xs btn-modal"
                data-toggle="modal"
                data-target="#fsModal" style="font-size: 12px; width: 280px; margin-left: -14px;">
               <!--  <b><i class="icon-share2"></i></b> -->
                {{trans('dashboard.share_your_referral_link_to')}} 100+  {{trans('dashboard.social_pages')}} 
                </button>



                        
                        <div aria-hidden="true" aria-labelledby="myModalLabel" class="sharemodal modal animated bounceIn" id="fsModal" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            {{trans('dashboard.share_your_referral_link_across_the_web')}}!!
                                        </h5>

                                        <button class="close" data-dismiss="modal" type="button">
                                            ×
                                        </button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="share_target social_links" data-desc="Best MLM Software that is customizable for any type of online business , multilevel marketing and direct selling business with best support, Try our free MLM software demo today!" data-hashtags="MLM,Software" data-img="https://cloudmlmsoftware.com/sites/default/files/mlm-software.jpg" data-rurl="{{url('/',Auth::user()->username)}}" data-title="Cloud MLM Software for multilevel network marketing, direct selling business" data-url="{{url('/',Auth::user()->username)}}" data-via="cloudmlmsoft">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>