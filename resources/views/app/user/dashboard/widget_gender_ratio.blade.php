<!-- Pie with legend -->
        <div class="card card-body text-center">
            <div class="card-heading">
                <h6 class="card-title text-semibold">
                   {{trans('dashboard.gender_ratio')}}
                </h6>
            </div>
            <div class="text-size-small text-muted content-group-sm">
            </div>
            <div class="svg-center has-fixed-height" id="pie_gender_legend" style="height: 300px">
            </div>
            <script type="text/javascript">
                var pie_gender_legend_data = [{
                        "name": "Male",
                        "value": {{$male_users_count}},
                        "color": "#66BB6A"
                        }, {
                        "name": "Female",
                        "value": {{$female_users_count}},
                        "color": "#EF5350"
                        }];
            </script>
        </div>
        <!-- /pie with legend -->