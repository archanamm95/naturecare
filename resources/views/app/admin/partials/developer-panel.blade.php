<li class="nav-item dropdown dev-switch">
    <a class="navbar-nav-link dropdown-toggle caret-0 d-flex" data-backdrop="true" data-target="#modal_developer_panel"
        data-toggle="modal" href="#">
        <svg class="feather d-inline-block" style="height: 18px;"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#sliders"></use></svg>
    </a>
    @section('content_bottom')
    @parent
    <!-- Developer panel modal -->
    <div class="modal fade text-default" id="modal_developer_panel" tabindex="-1">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">

                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="table-border-double">
                                    <th class="table-active" colspan="3">
                                        {{trans('menu.commands')}}
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.reset_application')}}
                                    </td>
                                    <td>
                                        {{trans('menu.usage')}}:
                                        <br />
                                        cloud:reset [options]
                                        <br />
                                        {{trans('menu.example')}} 1:
                                        <code>
                                            cloud:reset
                                        </code>
                                        <br />
                                        {{trans('menu.example')}} 2:
                                        <code>
                                            cloud:reset --prompt=true --userslimit=10 --ticketslimit=10 --silent=false
                                            --maintenance = true
                                        </code>
                                        <br />
                                        {{trans('menu.type')}}
                                        <code>
                                            cloud:reset --help
                                        </code>
                                        {{trans('menu.for_more_informations')}}.
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.bulk_generate_users')}}
                                    </td>
                                    <td>
                                        {{trans('menu.usage')}}:
                                        <br />
                                        cloud:dummynetwork [options]
                                        <br />
                                        {{trans('menu.example')}} 1:
                                        <code>
                                            php artisan cloud:dummynetwork
                                        </code>
                                        <br />
                                        {{trans('menu.example')}} 2:
                                        <code>
                                            php artisan cloud:dummynetwork --userslimit=5
                                        </code>
                                        <br />
                                        {{trans('menu.type')}}
                                        <code>
                                            cloud:dummynetwork --help
                                        </code>
                                        {{trans('menu.for_more_informations')}}.
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.bulk_generate_tickets')}}
                                    </td>
                                    <td>
                                        {{trans('menu.usage')}}:
                                        <br />
                                        cloud:dummytickets [options]
                                        <br />
                                        {{trans('menu.example')}} 1:
                                        <code>
                                            php artisan cloud:dummytickets
                                        </code>
                                        <br />
                                        {{trans('menu.example')}} 2:
                                        <code>
                                            php artisan cloud:dummytickets --ticketslimit=5
                                        </code>
                                        <br />
                                        {{trans('menu.type')}}
                                        <code>
                                            cloud:dummynetwork --help
                                        </code>
                                        {{trans('menu.for_more_information')}}.
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="table-active" colspan="3">
                                        {{trans('menu.initial_category_and_product_creation')}}
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.category_creation')}}
                                    </td>
                                    <td>
                                        <code>
                                            php artisan cloud:dummycategory
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.product_creation')}}
                                    </td>
                                    <td>
                                        <code>
                                            php artisan cloud:dummyproduct
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="table-active" colspan="3">
                                        {{trans('menu.quick_codes')}}
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.image')}}
                                    </td>
                                    <td>
                                        <input class="form-control code"
                                            value="@{{ url('img/cache/original/your-image.png) }} " />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{trans('menu.bootstrap')}} 4 {{trans('menu.card')}}
                                    </td>
                                    <td>
<pre>
<xmp>
<div class="card">
<div class="card-header">
<h6 class="card-title">{{trans('menu.card_title')}}</h6>
</div>

<div class="card-body">
{{trans('menu.basic_card_example_without_header_element')}}
</div>
</div>
</xmp>
</pre>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-link" data-dismiss="modal" type="button">
                        {{trans('menu.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Developer modal -->
@endsection
</li>