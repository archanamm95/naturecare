
var cookie_prefix = CLOUDMLMSOFTWARE.cookie_prefix;
$(document).ready(function () {
    if ($('#toggle-images').length) {
        $('#toggle-images').bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'default'
        });
        if (typeof $.cookie(cookie_prefix + "tree_images") != 'undefined') {
            if ($.cookie(cookie_prefix + "tree_images") === 'true') {
                $('#treediv').removeClass('no-images');
                $('#sponsortreediv').removeClass('no-images');
                $('#toggle-images').bootstrapSwitch('state', true);
            } else {
                $('#treediv').addClass('no-images');
                $('#sponsortreediv').addClass('no-images');
                $('#toggle-images').bootstrapSwitch('state', false);
            }
        } else {
            $.cookie(cookie_prefix + "tree_images", $('#toggle-images').bootstrapSwitch('state'));
            $('#treediv').removeClass('no-images');
            $('#sponsortreediv').removeClass('no-images');
            $('#toggle-images').bootstrapSwitch();
        }
    }
});
$('#toggle-images').on('switchChange.bootstrapSwitch', function () {
    var state = $('#toggle-images').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie(cookie_prefix + "tree_images", "true");
            $('#treediv').removeClass('no-images'); // activate     
            $('#sponsortreediv').removeClass('no-images'); // activate     
        } else {
            $.cookie(cookie_prefix + "tree_images", "false");
            $('#treediv').addClass('no-images'); // deactivate
            $('#sponsortreediv').addClass('no-images'); // deactivate
        }
    } else {
        $.cookie(cookie_prefix + "tree_images", "true");
        $('#treediv').removeClass('no-images'); // activate  
        $('#sponsortreediv').removeClass('no-images'); // activate  
    }
});



'use strict';

var tree_pan_flag = false;
var tree_zoom_flag = false;
console.log(tree_zoom_flag);
if ($.cookie(cookie_prefix + "tree_pan") === 'true') {
    tree_pan_flag = true;
}
if ($.cookie(cookie_prefix + "tree_zoom") === 'true') {
    tree_zoom_flag = true;
}
console.log(tree_zoom_flag);

var levellimit = 5;


if ($(window).width() >= 1024) {
    var levellimit = 5;
} else {
    var levellimit = 4;
}

$(window).resize(function () {
    // This will fire each time the window is resized:
    if ($(window).width() >= 1024) {
        // if larger or equal
        var levellimit = 5;
    } else {
        // if smaller
        var levellimit = 4;
    }
}).resize(); // This will simulate a resize to trigger the initial run.

let searchParams = new URLSearchParams(window.location.search)
if (searchParams.has('st')) {
    let param = searchParams.get('st')
    if (param) {
        var user = param;
    } else {
        var user = 1;
    }
} else {
    var user = 1;
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    data: {
        'data': user,
        'levellimit': levellimit,
        '_token': $('meta[name="csrf-token"]').attr('content')
    },
});
var ajaxURLs = {};

 


/*****
 * Genealogy Tree
 */

genealogy_orgchart_options = {
    'data': "getTree/" + levellimit,
    'ajaxURL': ajaxURLs,
    'nodeTitle': 'name',
    'parentNodeSymbol': 'fa fa-user',
    'nodeContent': 'content',
    // 'direction': 'l2r',
    'depth': 500,
    'pan': tree_pan_flag,
    'zoom': tree_zoom_flag,
    'zoominLimit': 2,
    'exportButton': !0,
    'exportFilename': "cloud-mlm-software-tree-screenshot",
    'nodeTemplate': function (data) {
        return generateLayoutForNodeTemplate(data);
    },
    'createNode': function ($node, data) {
        var info_box = `
        <div class="hoverouter">

            <div class="user-card-inner">
                <div class="text-center pt-3">
                    <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                </div>
                <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                    <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                </div>
                <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                    <div class="d-flex justify-content-center">
                        <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                            <div class="pfcard-user_name"> 
                                `+data.first_name+' '+data.last_name+`
                            </div>                              
                        </div>
                        <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                    </div>
                
                    <hr class="pfcard-details-divider m-1">
                    <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                            <dl class="row w-100">
                                <dt class="col-sm-6 mb-0">
                                    <div class="pfcard-package-box text-center">  
                                        <div>                       
                                            ccc 
                                        </div><div class="badge badge-success text-sm">`+data.package_name+`</div>
                                    </div>
                                </dt>                          
                                <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                    <div class="pfcard-rank-box">  
                                        <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                        
                                    </div>
                                </dd>      
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left Count</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right Count</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                            
                                        </div>
                                </dd>                                  
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                            
                                        </div>
                                </dd>              
                            </dl>
                    </div>


                    
                   
                    <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                        <div class="row mb-0">              
                            <dd class="col-sm-12 text-center">                        
                                <div class="ml-auto font-weight-bold"> 
                                    
                                </div>
                            </dd>                    
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        `;
        $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
        $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        // var secondMenuIcon = $('<i>', {
        //     'class': 'icon-info22 second-menu-icon show-pop',
        //     'data-title': 'data.name',
        //     'data-content': 'data.info',
        //     hover: function () {
        //         $('.show-pop').webuiPopover({
        //             //backdrop: true
        //         });
        //     }
        // });
        // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
        // $node.append(secondMenuIcon).append(secondMenu);
    },
    'initCompleted': function ($chart) {
           window.setTimeout(function () {
                $('.tree-holder').unblock();
            }, 2000); 
    }
};

function generateLayoutForNodeTemplate(data){ //FOR EMBEDDED ON CLICK EVENT
    // console.log(data.user_role);
    if(data.class_name == 'inactive')
        var style_data = 'background-color: red;';//red 

   if(data.class_name == "vacant"){
    return `
    <div class="content tree-invite">
        <div class="p-1">
            <a href="#" class="invite-button" data-accessid="`+data.placement_accessid+`" data-userrole="`+data.user_role+`">
                <div class="invite-box">
                    <i class="icon-plus-circle2 mr-1"></i>
                    <span class="invite-text">Register</span>
                </div>
            </a>
        </div>
   </div>`;
   }
    if(data.user_role == 'admin'){
        return `<div class="content" style="`+style_data+`">
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div>              
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>              
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-6 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        ddd 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-6 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.member_count+`</div>
                                    <div>Member Count</div>
                                </div>
                            </dd>         
                            <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                                    
                                                </div>
                                        </dd>
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                                    
                                                </div>
                                        </dd>   
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                                    
                                                </div>
                                        </dd>
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                                    
                                                </div>
                                        </dd>          
                        </dl>
                    </div>

                   

                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <a href="`+CLOUDMLMSOFTWARE.siteUrl+`/`+data.user_role+`/inbox#/u/mail/compose?usnm=`+data.user_name+`" target="_blank" class="list-icons-item flex-fill p-1 btn btn-link text-pink-600" data-popup="tooltip" data-container="body" title="" data-original-title="Send Mail">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#mail"></use></svg>
                </a> 
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;
   }
   if(data.user_role == 'user'){
        return `<div class="content" style="`+style_data+`">
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div> 
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>                           
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-6 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        Package 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-6 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.rank_name+`</div>
                                    <div>Rank</div>
                                </div>
                            </dd>         
                            <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                                    
                                                </div>
                                        </dd>
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                                    
                                                </div>
                                        </dd>   
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                                    
                                                </div>
                                        </dd>
                                        <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                                <div class="pfcard-rank-box">  
                                                    <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                                    
                                                </div>
                                        </dd>          
                        </dl>
                    </div>

                   

                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;  
   }
}


function generateLayoutForSponsorTreeNodeTemplate(data){ //FOR EMBEDDED ON CLICK EVENT
    console.log(data);
    // return `hiii`;
     if(data.class_name == 'active'){
        var style_data = 'background-color:  #4baf43 ;'; //green
     }
     if(data.class_name == 'inactive') {
         var style_data = 'background-color:  #cdd0d1;';  //red
     }
   if(data.class_name == "vacant"){
    return `
    <div class="content tree-invite">
        <div class="p-1">
            <a href="#" class="invite-button" data-accessid="`+data.placement_accessid+`" data-userrole="`+data.user_role+`">
                <div class="invite-box">
                    <i class="icon-plus-circle2 mr-1"></i>
                    <span class="invite-text">Invite</span>
                </div>
            </a>
        </div>
   </div>`;
   }
    if(data.user_role == "admin"){
        return `<div class="content" style="`+style_data+`">
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div>   
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>                         
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-4 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        fff 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-4 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.member_count+`</div>
                                    <div>Member Count</div>
                                </div>
                            </dd>   
                            <dd class="col-sm-4 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.pv+`</div>
                                    <div>GroupSale Count</div>
                                </div>
                            </dd>                  
                        </dl>
                    </div>


                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <a href="`+CLOUDMLMSOFTWARE.siteUrl+`/`+data.user_role+`/inbox#/u/mail/compose?usnm=`+data.user_name+`" target="_blank" class="list-icons-item flex-fill p-1 btn btn-link text-pink-600" data-popup="tooltip" data-container="body" title="" data-original-title="Send Mail">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#mail"></use></svg>
                </a> 
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;
    }
    if(data.user_role == "user"){
        return  `<div class="content"style="`+style_data+`"
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div>    
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>                        
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-4 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        Package 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-4 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.member_count+`</div>
                                    <div>Member Count</div>
                                </div>
                            </dd>  
                            <dd class="col-sm-4 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.pv+`</div>
                                    <div>GroupSale Count</div>
                                </div>
                            </dd>                    
                        </dl>
                    </div>


                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;  
    }
}


// function generateLayoutForNodeInfoContent(data){ //FOR HOVER EVENT
//     return 
//             `<div class='hoverouter'>
//                 <div class='hoverinner'>
                    
//                             <div class='coverholder'>
//                                 <div class="tree-cover-img-holder" style="background-image: url('https://dev.cloudmlmsoftware.com/img/cache/large/cover.jpg' );"></div>
//                             </div>
//                             <div class='background'>
//                             </div>
                        
//                     <div class='primeinfo' >
//                         <div class='primeinfohold' >
                            
//                                 <div class='ellipsis username'>
//                                   username:$value->username
//                                 </div>
                           
//                         </div>
//                         <ul class='secondaryinfo'>
//                            <li>
//                                 <span class='value'>fullname</span> : <span class='value'>$name $lastname</span>
//                             </li>  
//                              <li>
//                                 <span class='value'>email</span> : <span class='value'>$email</span>
//                             </li>   

//                              <li>
//                                 <span class='value'>date_of_joining</span> : <span class='value'>$datofjoining</span>
//                             </li>                            
                                   
//                             <li class='rankname'>
//                                 <span class='value'>rank</span> :  <span class='value'>$value->rank_name</span>
//                             </li class='packagename'>                            
//                             <li>
//                                 <span class='value'>package</span> : <span class='value'>$package_name</span>
//                             </li>                            
                                                       
//                             <li class='rsbalance'>
//                                 <span class='value'>user_balance</span> : <span class='value'>$balance</span>
//                             </li>
//                         </ul>
//                     </div>
//                 </div>
//                 <table cellpadding='0' cellspacing='0' class='profcontenttbl' >
//                     <tbody>
//                         <tr>
//                             <td rowspan='2' valign='top'>
                               
//                                     <div class='profpicholder'>
//                                         $user_photo
//                                     </div>
                              
//                             </td>
//                         </tr>
//                         <tr valign='bottom'>
//                             <td class='secinfo-list-holder'>
                              
//                             </td>
//                         </tr>
//                     </tbody>
//                 </table>
//                 <div class='pillforholder'>
//                 </div>
//                 <div class='details'>
             
                
//                 <table class='table table-condensed'>
//                 <thead>
//                 <tr>
//                     <td>total_left</td>
//                     <td>total_right</td>
//                     <td>left_point</td>
//                     <td>right_point</td>
//                 </tr>
//                 </thead>
//                 <tbody>
//                 <tr>
//                     <td>$value->total_left</td>
//                     <td>$value->total_right</td>
//                     <td>$value->left_carry</td>
//                     <td>$value->right_carry</td>
//                 </tr>
//                 </tbody>
//                 </table>
      
//                 </div>
//                 </div>`;
// }


if ($('#treediv').length) {
    var oc = $('#treediv').orgchart(genealogy_orgchart_options);
    oc.$chart.on('init.orgchart', function (e) {});
}


$('#treediv').on('click', '.orgchart .node .btn-focus', function (e) {
    
    
     
            $('.tree-holder').block({ 
                message: '<i class="icon-spinner2 spinner"></i>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait',
                    'box-shadow': '0 0 0 1px #ddd'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });

            // // For demo purposes
            // window.setTimeout(function () {
            //     $('.tree-holder').unblock();
            // }, 2000); 

    $('#treediv [data-popup="tooltip"]').tooltip('dispose');    
    genealogy_orgchart_options.data = 'getChildrenGenealogy/' + $(this).data('access-id') + '/' + levellimit;
    genealogy_orgchart_options.createNode = function ($node, data) {
                var info_box = `
        <div class="hoverouter">

            <div class="user-card-inner">
                <div class="text-center pt-3">
                    <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                </div>
                <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                    <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                </div>
                <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                    <div class="d-flex justify-content-center">
                        <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                            <div class="pfcard-user_name"> 
                                `+data.first_name+' '+data.last_name+`
                            </div>                              
                        </div>
                        <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                    </div>
                
                    <hr class="pfcard-details-divider m-1">
                    <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                            <dl class="row w-100">
                                <dt class="col-sm-6 mb-0">
                                    <div class="pfcard-package-box text-center">  
                                        <div>                       
                                            Package 
                                        </div><div class="badge badge-success text-sm">`+data.package_name+`</div>
                                    </div>
                                </dt>                          
                                <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                    <div class="pfcard-rank-box">  
                                        <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                        
                                    </div>
                                </dd>  
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                            
                                        </div>
                                </dd>  
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                            
                                        </div>
                                </dd>                  
                            </dl>
                    </div>

                    
                   
                    <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                        <div class="row mb-0">              
                            <dd class="col-sm-12 text-center">                        
                                <div class="ml-auto font-weight-bold"> 
                                    
                                </div>
                            </dd>                    
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        `;
       
        // console.log(data);
        if (data.user_type == 'root') {
            // console.log(data);
            if (data.id !== data.current_user_id) {
                 $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                 $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                 $node.prepend('<svg class="feather" id="tree-user-up" data-access_id="' + data.access_id + '"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#corner-left-up"></use> </svg>');
            }
        }
        else{
             $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
             $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(genealogy_orgchart_options);
});

$('#sponsortreediv').on('click', '.orgchart .node .btn-focus', function (e) {
    
    
     
            $('.tree-holder').block({ 
                message: '<i class="icon-spinner2 spinner"></i>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait',
                    'box-shadow': '0 0 0 1px #ddd'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });

            // // For demo purposes
            // window.setTimeout(function () {
            //     $('.tree-holder').unblock();
            // }, 2000); 

    $('#sponsortreediv [data-popup="tooltip"]').tooltip('dispose');    
    sponsortreeoptions.data = 'sponsor-child/' +  $(this).data('access-id');
    sponsortreeoptions.createNode = function ($node, data) {

console.log(data.member_type);
        if(data.member_type == 'no'  ){ var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
        var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-4 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                               Member Type
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd>  
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Group sale Count</div><div class="badge badge-info text-sm">`+data.pv+`</div>
                                            
                                        </div>
                                    </dd>                    
                                </dl>
                        </div>
    
         
    
                        <hr class="pfcard-details-divider m-1">

                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;

        // console.log(data);
        if (data.user_type == 'root') {
            // console.log(data);
            if (data.id !== data.current_user_id) {
              $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
        $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                $node.prepend('<svg class="feather" id="tree-user-up" data-access_id="' + data.access_id + '"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#corner-left-up"></use> </svg>');
            }
        }
        else{
                         $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
        $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(sponsortreeoptions);
});

// $('.show-pop').webuiPopover({
//     trigger: 'hover',
//     content: function(){ return Date.now }
// });


$('#treediv').on('click', '#tree-user-up', function () {

    $('.tree-holder').block({ 
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

    genealogy_orgchart_options.data = 'getParentGenealogy/' + $(this).data('access_id') + '/' + levellimit;
    // options.createNode = function ($node, data) {
    //     var secondMenuIcon = $('<i>', {
    //         'class': 'icon-info22 second-menu-icon show-pop',
    //         'data-title': data.name,
    //         'data-content': data.info,
    //         click: function () {
    //             $('.show-pop').webuiPopover({
    //                 // backdrop: true
    //                 trigger: 'hover'
    //             });
    //         }
    //     });
    //     var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
    //     $node.append(secondMenuIcon).append(secondMenu);
    //     if (data.usertype == 'root') {
    //         if (data.id !== data.currentuserid) {
    //             $node.prepend('<i id="tree-user-up" data-access_id="' + data.access_id + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#000"></i>');
    //         }
    //     }
    // }
    oc.init(genealogy_orgchart_options);
});

$('#sponsortreediv').on('click', '#tree-user-up', function () {

    $('.tree-holder').block({ 
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

    sponsortreeoptions.data = 'sponsor-up/' + $(this).data('access_id');
    // options.createNode = function ($node, data) {
    //     var secondMenuIcon = $('<i>', {
    //         'class': 'icon-info22 second-menu-icon show-pop',
    //         'data-title': data.name,
    //         'data-content': data.info,
    //         click: function () {
    //             $('.show-pop').webuiPopover({
    //                 // backdrop: true
    //                 trigger: 'hover'
    //             });
    //         }
    //     });
    //     var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
    //     $node.append(secondMenuIcon).append(secondMenu);
    //     if (data.usertype == 'root') {
    //         if (data.id !== data.currentuserid) {
    //             $node.prepend('<i id="tree-user-up" data-access_id="' + data.access_id + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#000"></i>');
    //         }
    //     }
    // }
    oc.init(sponsortreeoptions);
});
// alert('hiii');


$(document).ready(function () {
    $(document).ajaxComplete(function () {
        $('.show-pop').webuiPopover({
            trigger: 'hover',
            cache: false,
            animation:'pop',
            content:function(){                 
                return $(this).parent().find('.show-pop-content').html();
            // console.log($(this).data('access-id'));          
            //    return 'html';
           }
        });
    });
});
$(document).ready(function () {
    $('.show-pop').webuiPopover({
        trigger: 'hover',
        cache: false,
        animation:'pop',
        content:function(){                 
            return $(this).parent().find('.show-pop-content').html();
        // console.log($(this).data('access-id'));          
        //    return 'html';
        }
    });
});

// $(document).on("hover", "body .node", function(){    
//     alert('hi');
//     // $(this).webuiPopover('destroy'); // the trick
//     $(this).webuiPopover({
//        placement: 'right',
//        content: function(){ return Date.now }
//     }); 
//  });


// $(document).ready(function () {
//     // $('.show-pop').webuiPopover({
//     //     trigger: 'hover',
//     //     backdrop: true,
//     //     data : "sdsdsd"
//     // });    
//     $(document).ajaxComplete(function () {

//         $(this).webuiPopover('destroy'); // the trick
//         $(this).webuiPopover({
//             placement: 'right',
//             content: function(){ return Date.now }
//         }); 

//         $('.show-pop').webuiPopover({
//             trigger: 'hover',
//             // backdrop: true,
//             data : "sdsdsd"
//         });   
//     });
// });




/*****
 * Genealogy Tree reload
 */
if ($('#btn-restart-genealogy-node').length) {
    $('#btn-restart-genealogy-node').on('click', function () {       
        $('.tree-holder').block({ 
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });
        genealogy_orgchart_options.data = 'getTree/' + levellimit;
        
        oc.init(genealogy_orgchart_options);
        new PNotify({
            text: 'Resetting tree',
            delay: 1000,
            nonblock: {
                nonblock: true
            }
        });
    });
}
if ($('#btn-restart-tree').length) {
    $('#btn-restart-tree').on('click', function () {       
        $('.tree-holder').block({ 
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait',
                'box-shadow': '0 0 0 1px #ddd'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });
        genealogy_orgchart_options.data = 'getTree/' + levellimit;
        
        oc.init(genealogy_orgchart_options);
 
    });
}
 



/*****
 * Sponsor Genealogy Tree
 */

// sponsor_genealogy_orgchart_options = {
//     'data': '',
//     'ajaxURL': ajaxURLs,
//     'nodeTitle': 'name',
//     'parentNodeSymbol': 'fa fa-user',
//     'nodeContent': 'content',
//     'depth': 500,
//     'pan': true,
//     'zoom': false,
//     'zoominLimit': 2,
//     'exportButton': !0,
//     'exportFilename': "cloud-mlm-software-tree-screenshot",
//     'nodeTemplate': function (data) {
//         return generateLayoutForSponsorTreeNodeTemplate(data);
//     },
//     // 'createNode': function ($node, data) {
//     //     var secondMenuIcon = $('<i>', {
//     //         'class': '',
//     //         'data-title': data.name,
//     //         'data-content': data.info,
//     //         click: function () {
//     //             $('.show-pop').webuiPopover({
//     //                 // backdrop: true
//     //                 trigger: 'hover'
//     //             });
//     //         }
//     //     });
//     //     var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
//     //     $node.append(secondMenuIcon).append(secondMenu);
//     // }
// };

// if ($('#sponsortreediv').length) {
//     var oc = $('#sponsortreediv').orgchart(sponsor_genealogy_orgchart_options);
//     oc.$chart.on('init.orgchart', function (e) {

//     });

// }




$(document).ready(function () {
    if ($('#toggle-zoom').length) {
        $('#toggle-zoom').bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'default'
        });
        if (typeof $.cookie(cookie_prefix + "tree_zoom") != 'undefined') {
            console.log($.cookie(cookie_prefix + "tree_zoom"));
            if ($.cookie(cookie_prefix + "tree_zoom") === 'true') {
                $('#treediv').removeClass('no-zoom');
                $('#sponsortreediv').removeClass('no-zoom');
                $('#toggle-zoom').bootstrapSwitch('state', true);
                oc.setOptions("zoom", true);

            } else {
                $('#treediv').addClass('no-zoom');
                $('#sponsortreediv').addClass('no-zoom');
                $('#toggle-zoom').bootstrapSwitch('state', false);
                oc.setOptions("zoom", false);

            }
        } else {
            oc.setOptions("zoom", $('#toggle-zoom').bootstrapSwitch('state'));
        }
    }
});

$('#toggle-zoom').on('switchChange.bootstrapSwitch', function () {
    var state = $('#toggle-zoom').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {



            $.cookie(cookie_prefix + "tree_zoom", "true");
            $('#treediv').removeClass('no-zoom'); // activate     
            $('#sponsortreediv').removeClass('no-zoom'); // activate     
            oc.setOptions("zoom", true);
        } else {


            $.cookie(cookie_prefix + "tree_zoom", "false");
            $('#treediv').addClass('no-zoom'); // deactivate
            $('#sponsortreediv').addClass('no-zoom'); // deactivate
            oc.setOptions("zoom", false);
        }
    }
});

$(document).ready(function () {
 $('#treediv').addClass('no-pan');
 $('#influencertreediv').addClass('no-pan');
});

$(document).ready(function () {
    if ($('#toggle-pan').length) {
        $('#toggle-pan').bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'default'
        });
        if (typeof $.cookie(cookie_prefix + "tree_pan") != 'undefined') {
            if ($.cookie(cookie_prefix + "tree_pan") === 'true') {
                $('#treediv').removeClass('no-pan');
                $('#sponsortreediv').removeClass('no-pan');
                $('#toggle-pan').bootstrapSwitch('state', true);
                oc.setOptions("pan", true);

            } else {
                $('#treediv').addClass('no-pan');
                $('#sponsortreediv').addClass('no-pan');
                $('#toggle-pan').bootstrapSwitch('state', false);
                oc.setOptions("pan", false);

            }
        } else {
            tree_zoom_flag = false;
            oc.setOptions("pan", $('#toggle-pan').bootstrapSwitch('state'));
            $('#treediv').removeClass('no-pan');
            $('#sponsortreediv').removeClass('no-pan');
            $('#toggle-pan').bootstrapSwitch('state', true);
            oc.setOptions("pan", true);
        }
    }
});


$('#toggle-pan').on('switchChange.bootstrapSwitch', function () {
    var state = $('#toggle-pan').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie(cookie_prefix + "tree_pan", "true");
            $('#treediv').removeClass('no-pan'); // activate     
            $('#sponsortreediv').removeClass('no-pan'); // activate     
            oc.setOptions("pan", true);



        } else {
            $.cookie(cookie_prefix + "tree_pan", "false");
            $('#treediv').addClass('no-pan'); // deactivate
            $('#sponsortreediv').addClass('no-pan'); // deactivate
            oc.setOptions("pan", false);

        }
    } else {
        $.cookie(cookie_prefix + "tree_pan", "true");
        $('#treediv').removeClass('no-pan'); // activate     
        $('#sponsortreediv').removeClass('no-pan'); // activate     
        oc.setOptions("pan", true);
    }
});



$(document).ready(function () {
    if ($('#btn_l2r_tree').length) {
        $('#btn_l2r_tree').on('click', function () {
            options.direction = 'l2r';
            oc.init(options);

        });
    }
});

$(document).ready(function () {
    if ($('#btn_r2l_tree').length) {
        $('#btn_r2l_tree').on('click', function () {
            options.direction = 'r2l';
            oc.init(options);

        });
    }
});

$(document).ready(function () {
    if ($('#btn_vertical_tree_switch').length) {
        $('#btn_vertical_tree_switch').on('click', function () {
            options.direction = 'none';
            oc.init(options);

        });
    }
});

$(document).ready(function () {
    if ($('#btn_save_scrht').length) {
        $('#btn_save_scrht').on('click', function () {
            $(".oc-export-btn").click();
        });
    }
});


$("#aZOut").on("click", function () {

        var state = $('#toggle-zoom').bootstrapSwitch('state');

        if (state === false) {
            swal('Make sure zooming is enabled');
            return;
        }

        oc.setOptions("zoom", true);
        var e = new WheelEvent("wheel", {
            deltaY: 100
        });
        document.getElementById("treediv").dispatchEvent(e)
}),

$("#aZOutSp").on("click", function () {

    var state = $('#toggle-zoom').bootstrapSwitch('state');

    if (state === false) {
        swal('Make sure zooming is enabled');
        return;
    }

    oc.setOptions("zoom", true);
    var e = new WheelEvent("wheel", {
        deltaY: 100
    });
    document.getElementById("sponsortreediv").dispatchEvent(e)
}),

$("#aZIn").on("click", function () {

    var state = $('#toggle-zoom').bootstrapSwitch('state');

    if (state === false) {
        swal('Make sure zooming is enabled');
        return;
    }


    oc.setOptions("zoom", true);
    var e = new WheelEvent("wheel", {
        deltaY: -100
    });
    document.getElementById("treediv").dispatchEvent(e)
}),

$("#aZInSp").on("click", function () {

    var state = $('#toggle-zoom').bootstrapSwitch('state');

    if (state === false) {
        swal('Make sure zooming is enabled');
        return;
    }


    oc.setOptions("zoom", true);
    var e = new WheelEvent("wheel", {
        deltaY: -100
    });
    document.getElementById("sponsortreediv").dispatchEvent(e)
}),

$("#aZOutSp").on("click", function () {
    console.log(1);

        var state = $('#toggle-zoom').bootstrapSwitch('state');

        if (state === false) {
            swal('Make sure zooming is enabled');
            return;
        }

        oc.setOptions("zoom", true);
        var e = new WheelEvent("wheel", {
            deltaY: 100
        });
        document.getElementById("sponsortreediv").dispatchEvent(e)
}),

$("#btn-zoom-reset-sponsortree").on("click", function () {
    console.log('hii');
    oc.init(sponsortreeoptions);

}),



$("#aZInInflncr").on("click", function () {

    var state = $('#toggle-zoom').bootstrapSwitch('state');

    if (state === false) {
        swal('Make sure zooming is enabled');
        return;
    }


    oc.setOptions("zoom", true);
    var e = new WheelEvent("wheel", {
        deltaY: -100
    });
    document.getElementById("influencertreediv").dispatchEvent(e)
}),

$("#aZOutInflncr").on("click", function () {
    console.log(1);

        var state = $('#toggle-zoom').bootstrapSwitch('state');

        if (state === false) {
            swal('Make sure zooming is enabled');
            return;
        }

        oc.setOptions("zoom", true);
        var e = new WheelEvent("wheel", {
            deltaY: 100
        });
        document.getElementById("influencertreediv").dispatchEvent(e)
}),



$("#btn-zoom-reset").on("click", function () {
    oc.init(options);
}),


// $("#treediv").on('click', '.toggle-more-content', function (e) {
// $("#treediv").on('click', '.node .content .tree-node-box', function (e) {
//     e.preventDefault();
//     $(this).closest('td').toggleClass('expanded');
//     $('#treediv [data-popup="tooltip"]').tooltip('dispose');
// }),


// $("#sponsortreediv").on('click', '.node .content .tree-node-box', function (e) {
//     e.preventDefault();
//     $(this).closest('td').toggleClass('expanded');
//     $('#sponsortreediv [data-popup="tooltip"]').tooltip('dispose');
// }),

// $("#sponsortreediv").on('click', '.toggle-more-content', function (e) {
//     e.preventDefault();
//     $('#sponsortreediv [data-popup="tooltip"]').tooltip('dispose');
//     var selector = $(this).data("target");
//     $('#sponsortreediv .tree-user-more-details').not(selector).hide("fast");
//     $(selector).slideToggle("slow", function () {
//         // Animation complete.
//     });
//     // $(selector).collapse('show');
// }),





    // $(document).ready(function() {
    //     $('[data-toggle="tooltip"]').tooltip({
    //         placement: 'top'      
    //     })
    // });


    // $(document).ready(function() {
    //     $("body").tooltip({ selector: 'a[data-toggle=tooltip]' });
    // });



    // Load sponsor tree init ******************************
    sponsortreeoptions = {
        'data': 'getsponsortree',
        'ajaxURL': ajaxURLs,
        'nodeTitle': 'name',
        'parentNodeSymbol': 'fa fa-user',
        'nodeContent': 'content',
        'depth': 500,
        'pan': tree_pan_flag,
        'zoom': tree_zoom_flag,
        'zoominLimit': 2,
        'exportButton': !0,
        'exportFilename': "cloud-mlm-software-tree-screenshot",
        'nodeTemplate': function (data) {
            return generateLayoutForSponsorTreeNodeTemplate(data);
        },
        'createNode': function ($node, data) {
            // console.log(data);
            console.log(data.member_type);
             if(data.member_type == 'no'  ){ var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
            var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-4 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                                Member Type 
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd> 
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Group sale Count</div><div class="badge badge-info text-sm">`+data.pv+`</div>
                                            
                                        </div>
                                    </dd>                      
                                </dl>
                        </div>
    
                       
                        <hr class="pfcard-details-divider m-1">

                       
                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;
            $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
            $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
            // var secondMenuIcon = $('<i>', {
            //     'class': 'icon-info22 second-menu-icon show-pop',
            //     'data-title': 'data.name',
            //     'data-content': 'data.info',
            //     hover: function () {
            //         $('.show-pop').webuiPopover({
            //             //backdrop: true
            //         });
            //     }
            // });
            // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
            // $node.append(secondMenuIcon).append(secondMenu);
        },
        'initCompleted': function ($chart) {
               window.setTimeout(function () {
                    $('.tree-holder').unblock();
                }, 2000); 
        }
    }

if ($('#sponsortreediv').length) {
    var oc = $('#sponsortreediv').orgchart(sponsortreeoptions);

}

if ($('#btn-restart-node').length) {
    $('#btn-restart-node').on('click', function () {
        // $('.orgchart').css('transform','');
        sponsortreeoptions.data = 'getsponsortree';
        oc.init(sponsortreeoptions);
        new PNotify({
            text: 'Resetting tree',
            delay: 1000,
            // styling: 'brighttheme',
            // icon: 'fa fa-file-image-o',
            nonblock: {
                nonblock: true
            }
        });
    });
}
if ($('#btn-restart-sponsortreenode').length) {
    $('#btn-restart-sponsortreenode').on('click', function () {
        sponsortreeoptions.data = 'getsponsortree';
        oc.init(sponsortreeoptions);

    });
}





$('#treediv').on('click', '.invite-button', function() {
    var accessid = $(this).data('accessid');
    var user_role = $(this).data('userrole');
    if(user_role == 'admin'  ){
        var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
    }else{
        var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/' + accessid;
    }
    // console.log(redirectPath);
    window.location = redirectPath
});

// NOT NEEDED BECAUSE SPONSOR TREE DOESNT SHOW INVITE BUTTON
// $('#sponsortreediv').on('click', '.invite-button', function() {
//     var accessid = $(this).data('accessid');
//     if( CLOUDMLMSOFTWARE.admin == true ){
//         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
//     }else{
//         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/' + accessid;
//     }
//     // console.log(redirectPath);
//     window.location = redirectPath
// });

// $('#treediv').on('click', '.node.vacant .title', function(e) {
//     e.preventDefault();
//     var accessid = $(this).parent('.node').find('.content img').data('accessid');
//     var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/' + accessid;
//     window.location = redirectPath
// });


$('#lowestleftuser').on('click', '#btn-filter-node', function () {
    genealogy_orgchart_options.data = 'getChildrenGenealogyByUserName/lowestleftuser/' + levellimit;
    genealogy_orgchart_options.createNode = function ($node, data) {
    var info_box = `
        <div class="hoverouter">

            <div class="user-card-inner">
                <div class="text-center pt-3">
                    <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                </div>
                <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                    <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                </div>
                <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                    <div class="d-flex justify-content-center">
                        <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                            <div class="pfcard-user_name"> 
                                `+data.first_name+' '+data.last_name+`
                            </div>                              
                        </div>
                        <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                    </div>
                
                    <hr class="pfcard-details-divider m-1">
                    <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                            <dl class="row w-100">
                                <dt class="col-sm-6 mb-0">
                                    <div class="pfcard-package-box text-center">  
                                        <div>                       
                                            Package 
                                        </div><div class="badge badge-success text-sm">`+data.package_name+`</div>
                                    </div>
                                </dt>                          
                                <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                    <div class="pfcard-rank-box">  
                                        <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                        
                                    </div>
                                </dd>                 
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                            
                                        </div>
                                </dd>   
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                            
                                        </div>
                                </dd>  
                            </dl>
                    </div>

                    
                   
                    <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                        <div class="row mb-0">              
                            <dd class="col-sm-12 text-center">                        
                                <div class="ml-auto font-weight-bold"> 
                                    
                                </div>
                            </dd>                    
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        `;
      
        // var secondMenuIcon = $('<i>', {
        //     'class': 'icon-info22 second-menu-icon show-pop',
        //     'data-title': data.name,
        //     'data-content': data.info,
        //     click: function () {
        //         $('.show-pop').webuiPopover({
        //             backdrop: true,
        //             trigger: 'hover'
        //         });
        //     }
        // });
        // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
        // $node.append(secondMenuIcon).append(secondMenu);
        if (data.usertype == 'root') {
            if (data.id !== data.currentuserid) {
                  $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                  $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                  $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
            }
        }
        else{
              $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
              $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(genealogy_orgchart_options);
});
$('#lowestrightuser').on('click', '#btn-filter-node', function () {
    genealogy_orgchart_options.data = 'getChildrenGenealogyByUserName/lowestrightuser/' + levellimit;
    genealogy_orgchart_options.createNode = function ($node, data) {
    var info_box = `
        <div class="hoverouter">

            <div class="user-card-inner">
                <div class="text-center pt-3">
                    <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                </div>
                <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                    <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                </div>
                <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                    <div class="d-flex justify-content-center">
                        <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                            <div class="pfcard-user_name"> 
                                `+data.first_name+' '+data.last_name+`
                            </div>                              
                        </div>
                        <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                    </div>
                
                    <hr class="pfcard-details-divider m-1">
                    <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                            <dl class="row w-100">
                                <dt class="col-sm-6 mb-0">
                                    <div class="pfcard-package-box text-center">  
                                        <div>                       
                                            Package 
                                        </div><div class="badge badge-success text-sm">`+data.package_name+`</div>
                                    </div>
                                </dt>                          
                                <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                    <div class="pfcard-rank-box">  
                                        <div>Rank</div><div class="badge badge-info text-sm">`+data.rank_name+`</div>
                                        
                                    </div>
                                </dd>                 
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                            
                                        </div>
                                </dd>   
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                            
                                        </div>
                                </dd>  
                            </dl>
                    </div>

                    
                   
                    <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                        <div class="row mb-0">              
                            <dd class="col-sm-12 text-center">                        
                                <div class="ml-auto font-weight-bold"> 
                                    
                                </div>
                            </dd>                    
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        `;
      
        // var secondMenuIcon = $('<i>', {
        //     'class': 'icon-info22 second-menu-icon show-pop',
        //     'data-title': data.name,
        //     'data-content': data.info,
        //     click: function () {
        //         $('.show-pop').webuiPopover({
        //             backdrop: true,
        //             trigger: 'hover'
        //         });
        //     }
        // });
        // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
        // $node.append(secondMenuIcon).append(secondMenu);
        if (data.usertype == 'root') {
            if (data.id !== data.currentuserid) {
                  $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                  $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                  $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
            }
        }
        else{
              $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
              $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(genealogy_orgchart_options);
});


$('#searchtreeholder').on('click', '#btn-filter-node', function () {
    if (!($('#key_user_hidden').val()).length) {
        window.alert('Please type keyword to find user!');
        return;
    } 
    genealogy_orgchart_options.data = 'getChildrenGenealogyByUserName/' + $('#key_user_hidden').val() + '/' + levellimit;
    genealogy_orgchart_options.createNode = function ($node, data) {
    var info_box = `
        <div class="hoverouter">

            <div class="user-card-inner">
                <div class="text-center pt-3">
                    <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                </div>
                <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                    <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                </div>
                <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                    <div class="d-flex justify-content-center">
                        <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                            <div class="pfcard-user_name"> 
                                `+data.first_name+' '+data.last_name+`
                            </div>                              
                        </div>
                        <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                    </div>
                
                    <hr class="pfcard-details-divider m-1">
                    <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                            <dl class="row w-100">
                                <dt class="col-sm-6 mb-0">
                                    <div class="pfcard-package-box text-center">  
                                        <div>                       
                                            Package 
                                        </div><div class="badge badge-success text-sm">`+data.package_name+`</div>
                                    </div>
                                </dt>                          
                                <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                    <div class="pfcard-rank-box">  
                                        <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                        
                                    </div>
                                </dd>                 
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>L</div><div class="badge badge-primary text-sm">`+data.total_left_users+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>R</div><div class="badge badge-primary text-sm">`+data.total_right_users+`</div>
                                            
                                        </div>
                                </dd>   
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Left BV</div><div class="badge badge-primary text-sm">`+data.left_carry+`</div>
                                            
                                        </div>
                                </dd>
                                <dd class="col-sm-3 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Right BV</div><div class="badge badge-primary text-sm">`+data.right_carry+`</div>
                                            
                                        </div>
                                </dd>  
                            </dl>
                    </div>

                    
                   
                    <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                        <div class="row mb-0">              
                            <dd class="col-sm-12 text-center">                        
                                <div class="ml-auto font-weight-bold"> 
                                    
                                </div>
                            </dd>                    
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        `;
      
        // var secondMenuIcon = $('<i>', {
        //     'class': 'icon-info22 second-menu-icon show-pop',
        //     'data-title': data.name,
        //     'data-content': data.info,
        //     click: function () {
        //         $('.show-pop').webuiPopover({
        //             backdrop: true,
        //             trigger: 'hover'
        //         });
        //     }
        // });
        // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
        // $node.append(secondMenuIcon).append(secondMenu);
        if (data.usertype == 'root') {
            if (data.id !== data.currentuserid) {
                  $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                  $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                  $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
            }
        }
        else{
              $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
              $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(genealogy_orgchart_options);
});
$('.orgchart').addClass('noncollapsable');


 $('#searchsponsortreeholder').on('click', '#btn-filter-node', function() {
            if (!($('#key_user_hidden').val()).length) {
                window.alert('Please type keyword to find user!');
                return;
            }
            sponsortreeoptions.data = 'getsponsorchildrenByUserName/' + $('#key_user_hidden').val();
            console.log(sponsortreeoptions.data);
            sponsortreeoptions.createNode = function($node, data) {
                console.log(data.member_type);
                if(data.member_type == 'no'  )
                    { var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
        var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-4 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                                Member Type
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd> 
                                    <dd class="col-sm-4 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Group sale Count</div><div class="badge badge-info text-sm">`+data.pv+`</div>
                                            
                                        </div>
                                    </dd>                      
                                </dl>
                        </div>
    
                        
    
                        <hr class="pfcard-details-divider m-1">


                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;
           
                // var secondMenuIcon = $('<i>', {
                //     'class': 'fa fa-info-circle second-menu-icon show-pop',
                //     'data-title': data.name,
                //     'data-content': data.info,
                //     click: function() {
                //         $('.show-pop').webuiPopover({
                //             // backdrop: true
                //         });
                //     }
                // });
                // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                // $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                         $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                         $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                         $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
                else{
                     $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                     $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                }
            }
            oc.init(sponsortreeoptions);
    });


//http://suggestqueries.google.com/complete/search?client=chrome&q=%QUERY
if ($('#key-word').length) {
    $(function () {
        $("#key-word").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word').val(ui.item.value);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word_influencer').length) {
    $(function () {
        $("#key-word_influencer").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/influencerautocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word_influencer').val(ui.item.value);
                console.log($('#key-word_influencer').val(ui.item.value));
                $('#key_user_hidden_influencer').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word1').length) {
    $(function () {
        $("#key-word1").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word1').val(ui.item.value);
                $('#key_user_hidden1').val(ui.item.username);
            }
        });
    });
}



if ($('#key-word-user-binary').length) {
    $(function () {
        $("#key-word-user-binary").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/binary/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user-binary').val(ui.item.value);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word-user-sponsor').length) {
    $(function () {
        $("#key-word-user-sponsor").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/userautocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user-sponsor').val(ui.item.value);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word-user-influencer').length) {

    $(function () {
        $("#key-word-user-influencer").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/userautocompleteinfluencer",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user-influencer').val(ui.item.value);
                $('#key_user_hidden_influencer').val(ui.item.username);
            }
        });
    });
}
if ($('.autocompleteusers').length) {
    $(function () {
        $(".autocompleteusers").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('.autocompleteusers').val(ui.item.value);
                $('.key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word-user').length) {
    $(function () {
        $("#key-word-user").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user').val(ui.item.value);
                // console.log(ui.item.username);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word-placement').length) {

    $(function () {
        var sponsor;
        sponsor = $("#sponsor").val();
        $("#sponsor").change(function(){
          sponsor = $("#sponsor").val();
        });
        $("#key-word-placement").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/placement/autocomplete/" + sponsor,
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user').val(ui.item.value);
                // console.log(ui.item.username);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}
if ($('#key-word-user-placement').length) {

    $(function () {
        var sponsor;
        sponsor = $("#sponsor").val();
        $("#sponsor").change(function(){
          sponsor = $("#sponsor").val();
        });
        $("#key-word-user-placement").autocomplete({
            source: CLOUDMLMSOFTWARE.siteUrl + "/search/placement/autocomplete/" + sponsor,
            minLength: 2,
            select: function (event, ui) {
                $('#key-word-user').val(ui.item.value);
                // console.log(ui.item.username);
                $('#key_user_hidden').val(ui.item.username);
            }
        });
    });
}

if ($('#btn-cancel').length) {
    $('#btn-cancel').on('click', function () {
        $('#key-word').val('');
        $('#key_user_hidden').val('');
        $('#key-word-user-sponsor').val('');

    });
}
if ($('#btn-cancel_influencer').length) {
    $('#btn-cancel_influencer').on('click', function () {
        $('#key-word_influencer').val('');
        $('#key_user_hidden_influencer').val('');
        $('#key-word-user').val('');
        $('#key-word-user-influencer').val('');
        

    });
}
if ($('#btn-canceled').length) {
    $('#btn-canceled').on('click', function () {
        $('#key-word-user').val('');
        $('#key_user_hidden').val('');
    });
}
if ($('#btn-cancel1').length) {
    $('#btn-cancel1').on('click', function () {
        $('#key-word1').val('');
        $('#key_user_hidden1').val('');
    });
}


// function filterNodes(keyWord) {
//     if ($('.orgchart').length) {
//         if (!keyWord.length) {
//             window.alert('Please type key word firstly.');
//             return;
//         } else {
//             var $chart = $('.orgchart');
//             // disalbe the expand/collapse feture
//             // $chart.addClass('noncollapsable');
//             // distinguish the matched nodes and the unmatched nodes according to the given key word
//             $chart.removeClass('noncollapsable').find('.node').removeClass('matched retained').end().find('.hidden').removeClass('hidden').end().find('.slide-up, .slide-left, .slide-right').removeClass('slide-up slide-right slide-left');
//             $chart.find('.node').filter(function(index, node) {
//                 return $(node).text().toLowerCase().indexOf(keyWord) > -1;
//             }).addClass('matched').closest('table').parents('table').find('tr:first').find('.node').addClass('retained');
//             // hide the unmatched nodes
//             $chart.find('.matched,.retained').each(function(index, node) {
//                 $(node).removeClass('slide-up').closest('.nodes').removeClass('hidden').siblings('.lines').removeClass('hidden');
//                 var $unmatched = $(node).closest('table').parent().siblings().find('.node:first:not(.matched,.retained)').closest('table').parent().addClass('hidden');
//                 $unmatched.parent().prev().children().slice(1, $unmatched.length * 2 + 1).addClass('hidden');
//             });
//             // hide the redundant descendant nodes of the matched nodes
//             $chart.find('.matched').each(function(index, node) {
//                 if (!$(node).closest('tr').siblings(':last').find('.matched').length) {
//                     $(node).closest('tr').siblings().addClass('hidden');
//                 }
//             });
//         }
//     }
// }
// function clearFilterResult() {
//     if ($('.orgchart').length) {
//         $('.orgchart').removeClass('noncollapsable').find('.node').removeClass('matched retained').end().find('.hidden').removeClass('hidden').end().find('.slide-up, .slide-left, .slide-right').removeClass('slide-up slide-right slide-left');
//     }
// }
// if ($('#btn-filter-node').length) {
//     $('#btn-filter-node').on('click', function() {
//         filterNodes($('#key-word').val());
//     });
// }
// if ($('#btn-cancel').length) {
//     $('#btn-cancel').on('click', function() {
//         clearFilterResult();
//     });
// }
// if ($('#key-word').length) {
//     $('#key-word').on('keyup', function(event) {
//         if (event.which === 13) {
//             filterNodes(this.value);
//         } else if (event.which === 8 && this.value.length === 0) {
//             clearFilterResult();
//         }
//     });
// }
$(document).ready(function() {
    if ($('#toggle-more-details').length) {
        $('#toggle-more-details').bootstrapSwitch();
        if (typeof $.cookie("tree_images") != 'undefined') {
            if ($.cookie("tree_images") === 'true') {
                $('#treediv').removeClass('no-images');
                $('#sponsortreediv').removeClass('no-images');
                $('#toggle-more-details').bootstrapSwitch('state', true);
            } else {
                $('#treediv').addClass('no-images');
                $('#sponsortreediv').addClass('no-images');
                $('#toggle-more-details').bootstrapSwitch('state', false);
            }
        } else {
            $.cookie("toggle-more-details", "true");
            $('#treediv').removeClass('no-images');
            $('#sponsortreediv').removeClass('no-images');
            $('#toggle-more-details').bootstrapSwitch();
        }
    }
});
$('#toggle-more-details').on('switchChange.bootstrapSwitch', function() {
    var state = $('#toggle-more-details').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie("tree_images", "true");
            $('#treediv').removeClass('no-images'); // activate     
            $('#sponsortreediv').removeClass('no-images');
            $('#toggle-more-details').removeClass('no-images'); // activate     
        } else {
            $.cookie("tree_images", "false");
            $('#treediv').addClass('no-images'); // deactivate
            $('#sponsortreediv').addClass('no-images'); // deactivate
        }
    } else {
        $.cookie("toggle-more-details", "true");
        $('#treediv').removeClass('no-images'); // activate  
        $('#sponsortreediv').removeClass('no-images');
    }
});


// $(document).ready(function () {
//     if ($('#toggle-more-details').length) {
//         $('#toggle-more-details').bootstrapSwitch({
//             'onColor': 'success',
//             'offColor': 'default'
//         });
//         if (typeof $.cookie(cookie_prefix + "tree_more_details") != 'undefined') {
//             if ($.cookie(cookie_prefix + "tree_more_details") === 'true') {
//                 $('#treediv').removeClass('no-more-details');
//                 $('#sponsortreediv').removeClass('no-more-details');
//                 $('#toggle-more-details').bootstrapSwitch('state', true);
//             } else {
//                 $('#treediv').addClass('no-more-details');
//                 $('#sponsortreediv').addClass('no-more-details');
//                 $('#toggle-more-details').bootstrapSwitch('state', false);
//             }
//         } else {
//             $.cookie(cookie_prefix + "tree_more_details", $('#toggle-more-details').bootstrapSwitch('state'));
//             $('#treediv').removeClass('no-more-details');
//             $('#sponsortreediv').removeClass('no-more-details');
//             $('#toggle-more-details').bootstrapSwitch();
//         }
//     }
// });
// $('#toggle-more-details').on('switchChange.bootstrapSwitch', function () {
//     var state = $('#toggle-more-details').bootstrapSwitch('state');
//     if (typeof state != 'undefined') {
//         if (state == true) {
//             $.cookie(cookie_prefix + "tree_more_details", "true");
//             $('#treediv').removeClass('no-more-details'); // activate     
//             $('#sponsortreediv').removeClass('no-more-details'); // activate     
//         } else {
//             $.cookie(cookie_prefix + "tree_more_details", "false");
//             $('#treediv').addClass('no-more-details'); // deactivate
//             $('#sponsortreediv').addClass('no-more-details'); // deactivate
//         }
//     } else {
//         $.cookie(cookie_prefix + "tree_more_details", "true");
//         $('#treediv').removeClass('no-more-details'); // activate  
//         $('#sponsortreediv').removeClass('no-more-details'); // activate  
//     }
// });



$(document).ready(function () {
    if ($('#toggle-grid').length) {
        $('#toggle-grid').bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'default'
        });
        if (typeof $.cookie(cookie_prefix + "tree_grid") != 'undefined') {
            if ($.cookie(cookie_prefix + "tree_grid") === 'true') {
                $('#treediv').removeClass('no-grid');
                $('#sponsortreediv').removeClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', true);
            } else {
                $('#treediv').addClass('no-grid');
                $('#sponsortreediv').addClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', false);
            }
        } else {
            $.cookie(cookie_prefix + "tree_grid", $('#toggle-grid').bootstrapSwitch('state'));
            $('#treediv').removeClass('no-grid');
            $('#sponsortreediv').removeClass('no-grid');
            $('#toggle-grid').bootstrapSwitch();
        }
    }
});
$('#toggle-grid').on('switchChange.bootstrapSwitch', function () {
    var state = $('#toggle-grid').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie(cookie_prefix + "tree_grid", "true");
            $('#treediv').removeClass('no-grid'); // activate     
            $('#sponsortreediv').removeClass('no-grid'); // activate     
        } else {
            $.cookie(cookie_prefix + "tree_grid", "false");
            $('#treediv').addClass('no-grid'); // deactivate
            $('#sponsortreediv').addClass('no-grid'); // deactivate
        }
    } else {
        $.cookie(cookie_prefix + "tree_grid", "true");
        $('#treediv').removeClass('no-grid'); // activate  
        $('#sponsortreediv').removeClass('no-grid'); // activate  
    }
});



if ($('#treemap_influencer').length) {

    pagemap(document.querySelector('#treemap_influencer'), {
        viewport: document.querySelector('.treemapholder_influencer'),
        styles: {
            'header,footer,section,article': 'rgba(0,0,0,0.08)',
            'h1,a': 'rgba(0,0,0,0.10)',
            'h2,h3,h4': 'rgba(0,0,0,0.08)',
            'img': 'rgba(0,0,0,0.08'

        },
        back: 'rgba(0,0,0,0.08',
        view: 'rgba(0,0,0,0.07)',
        drag: 'rgba(0,0,0,0.10)',
        interval: 0
    });
    $('#treemap_influencer').hide();

}

if ($('#treemap').length) {

    pagemap(document.querySelector('#treemap'), {
        viewport: document.querySelector('.treemapholder'),
        styles: {
            'header,footer,section,article': 'rgba(0,0,0,0.08)',
            'h1,a': 'rgba(0,0,0,0.10)',
            'h2,h3,h4': 'rgba(0,0,0,0.08)',
            'img': 'rgba(0,0,0,0.08'

        },
        back: 'rgba(0,0,0,0.08',
        view: 'rgba(0,0,0,0.07)',
        drag: 'rgba(0,0,0,0.10)',
        interval: 0
    });
    $('#treemap').hide();

}


$(document).ready(function () {
    if ($('#toggle-treemap').length) {
        $('#toggle-treemap').bootstrapSwitch({
            'onColor': 'success',
            'offColor': 'default'
        });
        if (typeof $.cookie(cookie_prefix + "tree_treemap") != 'undefined') {
            if ($.cookie(cookie_prefix + "tree_treemap") === 'true') {
                $('#treediv').removeClass('no-treemap');
                $('#sponsortreediv').removeClass('no-treemap');
                $('#toggle-treemap').bootstrapSwitch('state', true);
                $('#treemap').show();
            } else {
                $('#treediv').addClass('no-treemap');
                $('#sponsortreediv').addClass('no-treemap');
                $('#toggle-treemap').bootstrapSwitch('state', false);
            }
        } else {
            $.cookie(cookie_prefix + "tree_treemap", $('#toggle-treemap').bootstrapSwitch('state'));
            $('#treediv').removeClass('no-treemap');
            $('#sponsortreediv').removeClass('no-treemap');
            $('#toggle-treemap').bootstrapSwitch();
            $('#treemap').show();
        }
    }
});
$('#toggle-treemap').on('switchChange.bootstrapSwitch', function () {
    var state = $('#toggle-treemap').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie(cookie_prefix + "tree_treemap", "true");
            $('#treediv').removeClass('no-treemap'); // activate     
            $('#sponsortreediv').removeClass('no-treemap'); // activate     
            $('#treemap').show();
        } else {
            $.cookie(cookie_prefix + "tree_treemap", "false");
            $('#treediv').addClass('no-treemap'); // deactivate
            $('#sponsortreediv').addClass('no-treemap'); // deactivate
            $('#treemap').hide();
        }
    } else {
        $.cookie(cookie_prefix + "tree_treemap", "true");
        $('#treediv').removeClass('no-treemap'); // activate  
        $('#sponsortreediv').removeClass('no-treemap'); // activate  
        $('#treemap').hide();
    }
});

    // Load sponsor tree init ******************************
    influencertreeoptions = {
        'data': 'getinfluencertree',
        'ajaxURL': ajaxURLs,
        'nodeTitle': 'name',
        'parentNodeSymbol': 'fa fa-user',
        'nodeContent': 'content',
        'depth': 500,
        'pan': tree_pan_flag,
        'zoom': tree_zoom_flag,
        'zoominLimit': 2,
        'exportButton': !0,
        'exportFilename': "cloud-mlm-software-tree-screenshot",
        'nodeTemplate': function (data) {
            return generateLayoutForInfluencerTreeNodeTemplate(data);
        },
        'createNode': function ($node, data) {
            // console.log(data);
            console.log(data.member_type);
             if(data.member_type == 'no'  ){ var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
            var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-6 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                                Member Type 
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd> 
                                                       
                                </dl>
                        </div>
    
                       
                        <hr class="pfcard-details-divider m-1">

                       
                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;
            $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
            $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
            // var secondMenuIcon = $('<i>', {
            //     'class': 'icon-info22 second-menu-icon show-pop',
            //     'data-title': 'data.name',
            //     'data-content': 'data.info',
            //     hover: function () {
            //         $('.show-pop').webuiPopover({
            //             //backdrop: true
            //         });
            //     }
            // });
            // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
            // $node.append(secondMenuIcon).append(secondMenu);
        },
        'initCompleted': function ($chart) {
               window.setTimeout(function () {
                    $('.tree-holder').unblock();
                }, 2000); 
        }
    }
function generateLayoutForInfluencerTreeNodeTemplate(data){ //FOR EMBEDDED ON CLICK EVENT
    console.log(data);
    // return `hiii`;
     if(data.class_name == 'active'){
        var style_data = 'background-color:  #4baf43 ;'; //green
     }
     if(data.class_name == 'inactive') {
         var style_data = 'background-color:  #cdd0d1;';  //red
     }
   if(data.class_name == "vacant"){
    return `
    <div class="content tree-invite">
        <div class="p-1">
            <a href="#" class="invite-button" data-accessid="`+data.placement_accessid+`" data-userrole="`+data.user_role+`">
                <div class="invite-box">
                    <i class="icon-plus-circle2 mr-1"></i>
                    <span class="invite-text">Invite</span>
                </div>
            </a>
        </div>
   </div>`;
   }
    if(data.user_role == "admin"){
        return `<div class="content" style="`+style_data+`">
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div>   
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>                         
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-6 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        fff 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-6 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.member_count+`</div>
                                    <div>Member Count</div>
                                </div>
                            </dd>   
                                            
                        </dl>
                    </div>


                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <a href="`+CLOUDMLMSOFTWARE.siteUrl+`/`+data.user_role+`/inbox#/u/mail/compose?usnm=`+data.user_name+`" target="_blank" class="list-icons-item flex-fill p-1 btn btn-link text-pink-600" data-popup="tooltip" data-container="body" title="" data-original-title="Send Mail">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#mail"></use></svg>
                </a> 
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;
    }
    if(data.user_role == "user"){
        return  `<div class="content"style="`+style_data+`"
            <div class="tree-node-box">
                <div class="">
                    <div class="tree-cover-img-holder" style="background-image: url('`+data.user_cover_photo+`" ); '></div>
                    <div class="tree-img-holder">
                        <img src="`+data.user_photo+`" class="up tree-user" data-accessid="`+data.access_id+`" alt="`+data.user_name+`">                            
                    </div>
                    <div class="pt-1 pb-1 col-md-12 text-center user_name" title="`+data.user_name+`">
                        <div class="tree-user_name">`+data.user_name+`</div>    
                        <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>                        
                            <a href="#" class="toggle-more-content btn" data-popup="tooltip" data-container="body" title="" data-original-title="More Details" data-target="#more-`+data.user_name+`">
                                <i class="icon-circle-down2 tree-node-expand" style="color: #e91e63;"></i>
                                <i class="icon-circle-up2 tree-node-collpase" style="color: #e91e63;"></i>
                            </a>
                    </div>
                    <div class="tree-user-more-details overflow-hidden" id="more-`+data.user_name+`" style="display:none">
                    <div class="tree-fullname">`+data.first_name+' '+data.last_name+`</div>
                    <div class="tree-timestamp">Since `+data.date_of_joining+`</div>
                    <hr class="tree-node-details-divider">
                    <div class="m-0 pl-2 pr-2 info-box-levels">
                        <dl class="row">
                            <dt class="col-sm-6 mb-0">
                                <div class="package-box">  
                                    <div class="badge badge-success">`+data.package_name+`</div><div>                       
                                        Package 
                                    </div>
                                </div>
                            </dt>                          
                            <dd class="col-sm-6 mb-0">                        
                                <div class="rank-box">  
                                    <div class="badge badge-info">`+data.member_count+`</div>
                                    <div>Member Count</div>
                                </div>
                            </dd>  
                                         
                        </dl>
                    </div>


                </div>
            </div>
            <div class="d-flex justify-content-around text-center p-0 btn-group tree-node-box-tools">            
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-focus" data-popup="tooltip" data-container="body" title="" data-original-title="Focus" data-access-id="`+data.access_id+`">
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#eye"></use> </svg>
                </button>  
                <button class="list-icons-item flex-fill p-1 btn text-indigo-400 btn-link btn-copy" data-popup="tooltip" data-container="body" title="" data-original-title="Copy Username To Clipboard" data-clipboard-content="`+data.user_name+`">                                   
                    <svg class="feather"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#copy"></use> </svg>
                </button>        
            </div>
        </div>`;  
    }
}

if ($('#influencertreediv').length) {
    var oc = $('#influencertreediv').orgchart(influencertreeoptions);

}

// if ($('#btn-restart-node').length) {
//     $('#btn-restart-node').on('click', function () {
//         // $('.orgchart').css('transform','');
//         influencertreeoptions.data = 'getinfluencertree';
//         oc.init(influencertreeoptions);
//         new PNotify({
//             text: 'Resetting tree',
//             delay: 1000,
//             // styling: 'brighttheme',
//             // icon: 'fa fa-file-image-o',
//             nonblock: {
//                 nonblock: true
//             }
//         });
//     });
// }
if ($('#btn-restart-influencertreenode').length) {
    $('#btn-restart-influencertreenode').on('click', function () {
        influencertreeoptions.data = 'getinfluencertree';
        oc.init(influencertreeoptions);

    });
}

 $('#searchinfluencertreeholder').on('click', '#btn-filter-node_influencer', function() {
            if (!($('#key_user_hidden_influencer').val()).length) {
                window.alert('Please type keyword to find user!');
                return;
            }
            influencertreeoptions.data = 'getinfluencerchildrenByUserName/' + $('#key_user_hidden_influencer').val();
            console.log(influencertreeoptions.data);
            influencertreeoptions.createNode = function($node, data) {
                console.log(data.member_type);
                if(data.member_type == 'no'  )
                    { var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
        var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-6 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                                Member Type
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd> 
                                                      
                                </dl>
                        </div>
    
                        
    
                        <hr class="pfcard-details-divider m-1">


                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;
           
                // var secondMenuIcon = $('<i>', {
                //     'class': 'fa fa-info-circle second-menu-icon show-pop',
                //     'data-title': data.name,
                //     'data-content': data.info,
                //     click: function() {
                //         $('.show-pop').webuiPopover({
                //             // backdrop: true
                //         });
                //     }
                // });
                // var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                // $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                         $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                         $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                         $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
                else{
                     $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
                     $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                }
            }
            oc.init(influencertreeoptions);
    });
 
$('#influencertreediv').on('click', '#tree-user-up', function () {

    $('.tree-holder').block({ 
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

    influencertreeoptions.data = 'influencer-up/' + $(this).data('access_id');
    // options.createNode = function ($node, data) {
    //     var secondMenuIcon = $('<i>', {
    //         'class': 'icon-info22 second-menu-icon show-pop',
    //         'data-title': data.name,
    //         'data-content': data.info,
    //         click: function () {
    //             $('.show-pop').webuiPopover({
    //                 // backdrop: true
    //                 trigger: 'hover'
    //             });
    //         }
    //     });
    //     var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
    //     $node.append(secondMenuIcon).append(secondMenu);
    //     if (data.usertype == 'root') {
    //         if (data.id !== data.currentuserid) {
    //             $node.prepend('<i id="tree-user-up" data-access_id="' + data.access_id + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#000"></i>');
    //         }
    //     }
    // }
    oc.init(influencertreeoptions);
});

$('#influencertreediv').on('click', '.orgchart .node .btn-focus', function (e) {
    
    
     
            $('.tree-holder').block({ 
                message: '<i class="icon-spinner2 spinner"></i>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait',
                    'box-shadow': '0 0 0 1px #ddd'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });

            // // For demo purposes
            // window.setTimeout(function () {
            //     $('.tree-holder').unblock();
            // }, 2000); 

    $('#influencertreediv [data-popup="tooltip"]').tooltip('dispose');    
    influencertreeoptions.data = 'influencer-child/' +  $(this).data('access-id');
    influencertreeoptions.createNode = function ($node, data) {

console.log(data.member_type);
        if(data.member_type == 'no'  ){ var member_type = 'Admin'; }
             else{ var member_type=data.member_type; }
        var info_box = `
            <div class="hoverouter">
    
                <div class="user-card-inner">
                    <div class="text-center pt-3">
                        <div class="pfcard-pp" style="background-image:url('`+data.user_photo+`')"></div>
                    </div>
                    <div class="text-center font-weight-bold m-2 text-lg" title="`+data.user_name+`">
                        <div class="pfcard-user_name"> `+data.user_name+`</div>                              
                    </div>
                    <div class="pfcard-user-more-details overflow-hidden" id="more-mckenzieedgar">
                        <div class="d-flex justify-content-center">
                            <div class="pfcard-fullname text-right mr-2 text-xs text-muted">
                                <div class="pfcard-user_name"> 
                                    `+data.first_name+' '+data.last_name+`
                                </div>                              
                            </div>
                            <div class="pfcard-timestamp ml-2 text-xs text-muted">Since `+data.date_of_joining+`</div>
                        </div>
                    
                        <hr class="pfcard-details-divider m-1">
                        <div class="m-0 pl-2 pr-2 info-box-levels d-flex justify-content-center">
                                <dl class="row w-100">
                                    <dt class="col-sm-6 mb-0">
                                        <div class="pfcard-package-box text-center">  
                                            <div>                       
                                               Member Type
                                            </div><div class="badge badge-success text-sm">`+member_type+`</div>
                                        </div>
                                    </dt>                          
                                    
                                    <dd class="col-sm-6 mb-0 text-center border-left-1 border-rank-split">                        
                                        <div class="pfcard-rank-box">  
                                            <div>Member Count</div><div class="badge badge-info text-sm">`+data.member_count+`</div>
                                            
                                        </div>
                                    </dd>  
                                                      
                                </dl>
                        </div>
    
         
    
                        <hr class="pfcard-details-divider m-1">

                        
                            
                        <div class="m-0 pl-3 pr-3 pt-1 pb-1 ">
                            <div class="row mb-0">              
                                <dd class="col-sm-12 text-center">                        
                                    <div class="ml-auto font-weight-bold"> 
                                        
                                    </div>
                                </dd>                    
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
            `;

        // console.log(data);
        if (data.user_type == 'root') {
            // console.log(data);
            if (data.id !== data.current_user_id) {
              $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
        $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
                $node.prepend('<svg class="feather" id="tree-user-up" data-access_id="' + data.access_id + '"> <use xlink:href="/backend/icons/feather/feather-sprite.svg#corner-left-up"></use> </svg>');
            }
        }
        else{
                         $node.find(".user_name").wrapInner("<div class='show-pop'></div>");
        $node.find(".user_name").append("<div class='show-pop-content' style='display:none'>"+info_box+"</div>");
        }
    }
    oc.init(influencertreeoptions);
});