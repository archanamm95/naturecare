<div class="bg-light">
                        <div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2">
                            <div class="text-center d-lg-none w-100">
                                <button type="button" class="navbar-toggler w-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
                                    <i class="icon-circle-down2"></i>
                                </button>
                            </div>

                            <div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-single">
                                <div class="mt-3 mt-lg-0">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light btn-icon btn-checkbox-all" style="width: 39px;">
                                           <div class="table-inbox-checkbox rowlink-skip" style="
    margin-left: -10px;
    margin-top: -3px;
"><span><input type="checkbox" class="styled" ></span></div>
                              
                                        </button>



                                        <!-- <button type="button" class="btn btn-light btn-icon dropdown-toggle" data-toggle="dropdown"></button> -->
                                        <!-- <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item">Select all</a>
                                            <a href="#" class="dropdown-item">Select read</a>
                                            <a href="#" class="dropdown-item">Select unread</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">Clear selection</a>
                                        </div> -->
                                    </div>

                                    <div class="btn-group ml-3 mr-lg-3">
                                        <button type="button" class="btn btn-light button-email-compose"><i class="icon-pencil7"></i> <span class="d-none d-lg-inline-block ml-2"> {{trans('mail.compose')}}</span></button>
                                        <button type="button" class="btn btn-light deleteAllCheckedMails" disabled="true"><i class="icon-bin"></i> <span class="d-none d-lg-inline-block ml-2"> {{trans('mail.delete')}}</span></button>
                                        
                                    </div>
                                </div>

                                <div class="navbar-text ml-lg-auto"><span class="font-weight-semibold">  {{trans('mail.page')}} {{$all_mail->currentPage()}} </span>  {{trans('mail.with')}} <span class="font-weight-semibold">{{$all_mail->perPage()}} </span>  {{ $all_mail->links() }}</div>

                                <div class="ml-lg-3 mb-3 mb-lg-0">
                                   <!--  <div class="btn-group">
                                        <button type="button" class="btn btn-light btn-icon disabled"><i class="icon-arrow-left12"></i></button>
                                        <button type="button" class="btn btn-light btn-icon"><i class="icon-arrow-right13"></i></button>
                                    </div> -->

                             <!--        <div class="btn-group ml-3">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item button-email-compose">Composer</a>                                           
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>