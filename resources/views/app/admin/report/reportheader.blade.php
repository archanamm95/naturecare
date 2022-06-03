
                     <div class="row">
              <div class="col-sm-6">
                <div class="mb-6">
                  <div class="comp_name">
               <p> {{ option('app.company_name') }}</p>
               </div>
                  <ul class="list list-unstyled mb-0">
                    <!-- <li>{{ option('app.company_email') }}</li> -->
                    <!-- <li>(602) 519-0450</li> -->
                    <li>{!! option('app.company_address') !!}</li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-4">
                  <div class="text-sm-right">
                  @if($start_date != 'na')
                    <ul class="list list-unstyled mb-0">
                      <li> {{trans('report.start_date')}}: <span class="font-weight-semibold">{{$start_date}}</span></li>
                      <li> {{trans('report.end_date')}}: <span class="font-weight-semibold">{{$end_date}}</span></li>
                    </ul>
                    @endif
                  </div>
                </div>
              </div>
            </div>
