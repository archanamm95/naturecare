<div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('dashboard.referral_link')}}
                </h6>
            </div>
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=account/register&sponsor={{$secret}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy input-group-text" data-clipboard-target="#referrallink" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>

        </div>
    </div>
</div>
</div>     
<div class="col-md-6">
     <!-- Sparklines in colored card -->
    <div class="card box">
      <div class="card-body">           
       <div class="card border-top-purple-300 border-bottom-purple-300">
                <div class="card-header header-elements-inline">
                <h6 class="card-title">
                    {{trans('Purchase Link')}}
                </h6>
            </div>
       

         <!-- <div class="card-body"> -->
                <div class="input-group">
                    <input class="selectall form-control" id="referrallink2" readonly="true" spellcheck="false" type="text" value="{{config('app.site_url')}}/index.php?route=product/all_product&purchase={{$secret}}"/>
                    <span class="input-group-append copylink">
                        <button class="btn btn-copy1 input-group-text" data-clipboard-target="#referrallink2" style="font-size: 12px;">
                            <i class="icon-copy">
                            </i>
                        </button>
                    </span>
                </div>
            <!-- </div> -->

        </div>
    </div>
</div>
</div>    