    <!-- <div class="row">  -->
    @foreach($payment as $key=>$data)
    
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">{{ucfirst(str_replace("_"," ",$key))}}</h6>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{currency(round($data,2))}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
                <div class="text-muted font-size-sm">
                    {{ucfirst(str_replace("_"," ",$key))}}
                </div>
            </div>
        </div>
    </div>
    
    
    @endforeach
    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="card metric">
            <div class="card-header bg-white border-0 header-elements-inline pb-0">
                <h6 class="card-title">Level Bonus</h6>
            </div>
            <div class="card-body pt-0 pb-0">
                <div class="d-flex mt-2 overflow-auto">
                    <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{currency(round($level_bonus,2))}} </h3>
                    <!-- <div class="list-icons ml-auto">
                        <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                            <use xlink:href="/backend/icons/feather/feather-sprite.svg#pocket"></use>
                        </svg> 
                    </div> -->
                </div>
                <br>
                <div class="text-muted font-size-sm">
                    Level Bonus
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->