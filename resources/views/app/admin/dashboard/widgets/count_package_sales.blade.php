<div class="card metric">
    <div class="card-header bg-white border-0 header-elements-inline pb-0">
        <h6 class="card-title">{{trans('dashboard.package_sales')}}</h6>
    </div>
    <div class="card-body pt-0 pb-0">
        <div class="d-flex mt-2 overflow-auto">
            <h3 class="text-4xla fz-xs-15 fz-xs-20 no-margin text-muted font-weight-semibold mt-1 mb-0">  {{ currency(round($total_sales,2)) }} </h3>
            <!-- <div class="list-icons ml-auto">
                <svg class="feather" style="width: 60px;height: 60px;color: #ddd;">
                    <use xlink:href="/backend/icons/feather/feather-sprite.svg#shopping-cart"></use>
                </svg> 
            </div> -->
        </div>
        <div class="text-muted font-size-sm">
            {{round($per_payout)}}% {{trans('dashboard.payout_done')}}
        </div>
    </div>
</div>



