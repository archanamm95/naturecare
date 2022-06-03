/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

moment.locale("en");
$('body').tooltip({
    selector: '[data-popup="tooltip"]'
});

/* ------------------------------------------------------------------------------
 *
 *  # Layout - fixed navbar and sidebar with custom scrollbar
 *
 *  Demo JS code for layout_fixed_sidebar_custom.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var FixedSidebarCustomScroll = function () {


    //
    // Setup module components
    //

    // Perfect scrollbar
    var _componentPerfectScrollbar = function () {
        if (typeof PerfectScrollbar == 'undefined') {
            console.warn('Warning - perfect_scrollbar.min.js is not loaded.');
            return;
        }

        // Initialize
        var ps = new PerfectScrollbar('.sidebar-fixed .sidebar-content', {
            wheelSpeed: 2,
            wheelPropagation: true
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentPerfectScrollbar();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    FixedSidebarCustomScroll.init();
});


$('.daterange-single').daterangepicker({
    singleDatePicker: true
});



var clipboard = new Clipboard('.btn-copy', {
    text: function (trigger) {
        return $(trigger).data('clipboard-content');
    }
});

clipboard.on('success', function (e) {
    new PNotify({
        text: 'Copied to clipboard!',
        delay: 1000,
        // styling: 'brighttheme',
        modules: {
            Animate: {
              animate: true,
              inClass: 'fadeInRight',
              outClass: 'bounceOut'
            }
          },
        icon: 'fa fa-file-image-o',
        nonblock: {
            nonblock: true
        }
    });
});
clipboard.on('error', function (e) {
    new PNotify({
        text: 'Not Copied to clipboard!!',
        delay: 1000,
        // styling: 'brighttheme',
        icon: 'fa fa-file-image-o',
        nonblock: {
            nonblock: true
        }
    });
});

var clipboard = new Clipboard('.btn-copy1', {
    text: function (trigger) {
        return $(trigger).data('clipboard-content');
    }
});

clipboard.on('success', function (e) {
    new PNotify({
        text: 'Copied to clipboard!',
        delay: 1000,
        // styling: 'brighttheme',
        modules: {
            Animate: {
              animate: true,
              inClass: 'fadeInRight',
              outClass: 'bounceOut'
            }
          },
        icon: 'fa fa-file-image-o',
        nonblock: {
            nonblock: true
        }
    });
});
clipboard.on('error', function (e) {
    new PNotify({
        text: 'Not Copied to clipboard!!',
        delay: 1000,
        // styling: 'brighttheme',
        icon: 'fa fa-file-image-o',
        nonblock: {
            nonblock: true
        }
    });
});

/*
 * Detect if mobile
 * jQuery.browser.mobile 
 */
(function (a) {
    (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
})(navigator.userAgent || navigator.vendor || window.opera);


/**
 * Register page
 */
$(document).ready(function () {
    if ($(".steps-validation").length) {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    }
});
/**
 * Wizard with validation
 */


/**
 * Show form
 */

if ($(".steps-validation").length) {
    var form = $(".steps-validation").show();
    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        enableFinishButton: false,

        onStepChanging: function (event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            // if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            //     return false;
            // }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            var validateForm = form.parsley().whenValidate({
                group: 'block-' + currentIndex
            });
            validateForm.then(function () {}, function () {});
            if (validateForm.state() === "resolved") {
                return true;
            }
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            // Used to skip the "Warning" step if the user is old enough.
            // if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
            //     form.steps("next");
            // }
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3) {
            //     form.steps("previous");
            // }
        },
        onFinishing: function (event, currentIndex) {
            // form.validate().settings.ignore = ":disabled";
            // return form.valid();
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        }
    });
    Parsley.addValidator('sponsor', {
        validateString: function (value, country) {
            $('span.sponsor-name').text(value);
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/validatesponsor/?sponsor=' + value,
                type: "GET",
                async: false,
                success: function (e) {
                    if (e.valid === true) {
                        $.ajax({
                            url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/getRegisterPoint/?sponsor=' + value,
                            type: "GET",
                            async: false,
                            success: function (e) {
                                $('span.register-point').text(e.point);
                                // $('span.register-point-used').text(e.used_point);
                            }
                        });
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function () {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'No such sponsor exists!'
        }
    });

    Parsley.addValidator('email', {
        validateString: function (value, country) {
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/validateemail/?email=' + value,
                type: "GET",
                async: false,
                success: function (e) {
                    if (e.valid === true) {
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function () {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'Oopz..Sorry, email is not available..!'
        }
    });
    Parsley.addValidator('stateAndZip', {
        validateString: function (_ignoreValue, country, instance) {
            $("#ziplocation span").html('');
            var country = $('[name="country"]').val();
            var state = $('[name="state"]').val();
            var zip = $('[name="zip"]').val();
            fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + zip + '&region=' + country, {
                method: 'get'
            }).then(function (response) {
                return response.json();
            }).then(function (response) {
                if (response.status === "OK") {
                    $("#ziplocation span").html('');
                    $("#ziplocation span").html(response.results[0].formatted_address + '<br/>');
                    return true;
                }
            }).catch(function (err) {
                $("#ziplocation span").html('');
                console.log("Error: ", err);
                return true;
            });
            // var xhr = $.get('https://maps.googleapis.com/maps/api/geocode/json?address='+zip);
            // When Zippopotam.us returns the info of the given zip, check it:
            // return xhr.then(function(json) {
            // console.log(json);
            // var actualState = json.places[0]['state abbreviation'];
            // if (actualState !== state) {
            // We could return `false`, but for an even better result
            // we can fail the promise with a custom error message:
            // return $.Deferred().reject("The zip code " + zip + " is in " + actualState + ", not in " + state);
            // Note: in jQuery 3.0+, you can `throw('my custom error')` for the same result
            // }
            // })
        },
        // The following error message will still show if the xhr itself fails
        // (404 because zip does not exist, network error, etc.)
        messages: {
            en: 'There is no such zip for the country "%s"'
        }
    });

    Parsley.addValidator('package', {
        validateString: function (value, country) {
            var quantity = document.getElementById('quantity').value;
            var amount   = document.getElementById('price').innerHTML; 
            var bv       = document.getElementById('bv').innerHTML; 
            var total_rp = quantity * bv ;
            var total_amount = quantity * amount ;
            
            document.cookie = "total_amount = " + total_amount ;
            $('span.total-amount').text(total_amount);
            $('span.register-point-used').text(total_rp);
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/checkBv',
                type: "post",
                data: {
                    'package' : value,
                    'quantity': quantity
                },
                async: false,
                success: function (e) {
                    if (e.valid === true) {
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function () {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'Oopz..Sorry, Please Purchase more quantity..!'
        }
    });
    Parsley.addValidator('username', {
        validateString: function (value, country) {
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/validateusername/?username=' + value,
                type: "GET",
                async: false,
                success: function (e) {
                    if (e.valid === true) {
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function () {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'Oopz..Sorry, username is not available..!'
        }
    });
}
// Bind change function to the select
// jQuery(document).ready(function() {
//     if (jQuery("#country").length) {
//         jQuery("#country").change(onCountryChange);
//     }
// });

// function onCountryChange() {
//     var countryId = jQuery(this).val();
//     $.ajax({
//         url: CLOUDMLMSOFTWARE.siteUrl+"api/country-state/get-states/" + countryId,
//         dataType: "json",
//         type: "GET",
//         success: onStatesRecieveSuccess,
//         error: onStatesRecieveError
//     });
// }

// function onStatesRecieveSuccess(data) {
//     // Target select that we add the states to
//     var jTargetSelect = jQuery("#state");
//     // Clear old states
//     jTargetSelect.children().remove();
//     var i = 0;
//     for (var propertyName in data.states) {
//         jTargetSelect.append('<option value="' + propertyName + '">' + data.states[propertyName] + '</option>');
//     }
// }

// function onStatesRecieveError(data) {
//     alert("Could not get states. Select the country again.");
// }


$("#sponsor").change(function(){
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/register/placement_data',
        type: "post",
        async: false,
        dataType: "json",
        data: {
            sponsor: $("#sponsor").val()
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            $(".leg option:contains('Left')").attr("disabled",false);
            $(".leg option:contains('Right')").attr("disabled",false);
            $(".placementUser").val(data.placement_user);
            $(".sponsordata").text(data.value);
            $(".placementdata").text(data.placementvalue);
            $(".leg").val(data.leg);
            if(data.vaccant_count == 1){
                if(data.leg == 'L') 
                    var variable = "Right"
                else
                    var variable = "Left"

                $(".leg option:contains('" + variable + "')").attr("disabled","disabled");
            }
            else{
                $(".leg option:contains('Left')").attr("disabled",false);
                $(".leg option:contains('Right')").attr("disabled",false);
            }
        }
    });
});
$(".placementUser").change(function(){
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/register/change_placement',
        type: "post",
        async: false,
        dataType: "json",
        data: {
            placementUser: $(".placementUser").val(),
            sponsor: $("#sponsor").val()
        },
        success: function (data, textStatus, jqXHR) {
            $(".leg option:contains('Left')").attr("disabled",false);
            $(".leg option:contains('Right')").attr("disabled",false);
            $(".placementUser").val(data.placement_user);
            $(".placementdata").text(data.placementvalue);
            $(".leg").val(data.leg);
            if(data.vaccant_count == 1){
                if(data.leg == 'L') 
                    var variable = "Right"
                else
                    var variable = "Left"

                $(".leg option:contains('" + variable + "')").attr("disabled","disabled");
            }
            else{
                $(".leg option:contains('Left')").attr("disabled",false);
                $(".leg option:contains('Right')").attr("disabled",false);
            }
        }
    });
});
if ($("#package").length) {
    $('#package').change(function () {
        var product = document.getElementById("package");
        var amount = product.options[product.selectedIndex].getAttribute('amount');
        var pv = product.options[product.selectedIndex].getAttribute('pv');
        var rs = product.options[product.selectedIndex].getAttribute('rs');
        $('#joiningfee').html(amount);
        $('#paypal_joining').html(amount);
        $('#voucher_joining').html(amount);
        $('.ewallet_joining').html(amount);
    });
}
$(document).ready(function () {
    if ($("#conf").length) {
        $("#conf").hide();
    }
    var voucherbalance = 0;
    var voucher = [];
    if ($("table#resulttable").length) {
        $("table#resulttable").hide();
    }
    $('body').on('click', '#verify', function (e) {

        if ($("#err").length) {
            $("#err").hide();
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (jQuery.inArray($('#key').val(), voucher) == -1) {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/register/data',
                type: "post",
                async: false,
                dataType: "json",
                data: {
                    key: $('#key').val()
                },
                success: function (data, textStatus, jqXHR) {
                    if (data[0] == undefined) {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Invalid voucher code";
                    }
                    voucher.push(data[0].voucher_code);
                    sel = document.getElementById('package');
                    joiningfe = sel.options[sel.selectedIndex].getAttribute('amount');
                    if (data[0].total_amount >= joiningfe) {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                    }
                    if (voucherbalance < joiningfe) {
                        voucherbalance += parseInt(data[0].total_amount);
                        $("table#resulttable").show();
                        drawTable(data);
                        payable_vouchers.push(data[0]);
                    } else {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                        voucherbalance -= parseInt(data[0].total_amount);
                    }
                }
            });
        } else {
            if ($("#err").length) {
                $("#err").show();
            }
            document.getElementById("err").innerHTML = "<strong> Error!</strong> Voucher code is already used ";
        }
    });
});

function drawTable(data) {
    for (var i = 0; i < data.length; i++) {
        drawRow(data[i]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />");
    if ($("#resulttable").length) {
        $("#resulttable").append(row);
    }
    row.append($("<td><input type='hidden' name='payable_vouchers[]' value='" + rowData.voucher_code + "'>" + rowData.voucher_code + "</td>"));
    row.append($("<td>" + rowData.total_amount + "</td>"));
    row.append($("<td>" + rowData.balance_amount + "</td>"));
}


$.fn.bootstrapSwitch.defaults.size = 'large';
$.fn.bootstrapSwitch.defaults.onColor = 'warning';
$.fn.bootstrapSwitch.defaults.offColor = 'warning';


require("./genealogy-tree.js");



// $.cookie(cookie_prefix+"online", "true"); 
//------------------------------------//
//Wow Animation//
//------------------------------------// 
if ($('.wow').length) {
    wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false // trigger animations on mobile devices (true is default)
    });
    wow.init();
}
$(function () {
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 100, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationSpeed: 200, // Animation speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
        scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
        scrollText: '<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required.
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
    });
});
if ($("#scrollUp").length) {
    $("#scrollUp").mPageScroll2id();
}
// if ($("a[href*='#']").length) {
//     $("a[href*='#']").mPageScroll2id();
// }
// Initialize plugins
// ------------------------------
// Select2 selects
// if ($('.select').length) {
//     $('.select').select2({
//         minimumResultsForSearch: Infinity
//     });
// }
if ($('.select2').length) {
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });
}
// Simple select without search
if ($('.select-simple').length) {
    $('.select-simple').select2({
        minimumResultsForSearch: Infinity
    });
}
// Format icon
function colorFormat(color) {
    var originalOption = color.element;
    if (!color.id) {
        return color.text;
    }
    var $color = "<span class='priorityround' style='background-color:" + $(color.element).data('color') + "'>&nbsp;</span>&nbsp;" + color.text;
    return $color;
}
if ($('.select-priority').length) {
    $(".select-priority").select2({
        templateResult: colorFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: colorFormat,
        escapeMarkup: function (m) {
            return m;
        }
    }).on('change', function () {
        $(this).closest('select').selectedIndex = 1;
    }).trigger('change');
}
// Styled checkboxes and radios
if ($('.styled').length) {
    $('.styled').uniform({
        radioClass: 'choice'
    });
}
// Styled file input
if ($('.file-styled').length) {
    $('.file-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });
}

$(document).ready(function () {
    // $(document).ajaxComplete(function () {
    //     $('.show-pop').webuiPopover({
    //         trigger: 'hover'
    //     });
    // });

    if ($('.btn-ladda-spinner').length) {
        ladda.bind('.btn-ladda-spinner', {
            dataSpinnerSize: 16,
            timeout: 2000,
        });
    }
    // if ($('.switch').length) {
    //     $(".switch").bootstrapSwitch({'onColor' : 'success','offColor' : 'default'});
    // }
});


$(document).ready(function () {
    var interval = setInterval(function () {
        var momentNow = moment();
        momentNow.locale('en')
        if ($('#year-part').length) {
            $('#year-part').html(momentNow.format('YYYY').toUpperCase());
        }
        if ($('#month-part').length) {
            $('#month-part').html(momentNow.format('MMMM').toUpperCase());
        }
        if ($('#date-part').length) {
            $('#date-part').html(momentNow.format('DD').toUpperCase());
        }
        if ($('#day-part').length) {
            $('#day-part').html(momentNow.format('dddd').substring(0, 3).toUpperCase());
        }
        if ($('#time-part').length) {
            $('#time-part').html(momentNow.format('hh:mm:ss').toUpperCase());
        }
        if ($('#ampm-part').length) {
            $('#ampm-part').html(momentNow.format('A').toUpperCase());
        }
        // $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
    if ($('#stop-interval').length) {
        $('#stop-interval').on('click', function () {
            clearInterval(interval);
        });
    }
});
$(document).ready(function () {
    if ($('#toggleOnlineStatus').length) {
        // console.log('found');
        $('#toggleOnlineStatus').on('switchChange.bootstrapSwitch', function () {
            var state = $('#toggleOnlineStatus').bootstrapSwitch('state');
            if (state == false) {
                $.ajax({
                    type: "POST",
                    url: '/chat/setPresence',
                    data: {
                        'status': false
                    }
                });
                new PNotify({
                    text: 'Presence set to "offline"',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'danger',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: '/chat/setPresence',
                    data: {
                        'status': true
                    }
                });
                new PNotify({
                    text: 'Presence set to "online"',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
            }
        });
    }
    if ($('#toggleOnlineStatus').length) {
        if ($('#toggleOnlineStatus').is(":checked")) {
            $("#toggleOnlineStatus").bootstrapSwitch('state', true)
        } else {
            $("#toggleOnlineStatus").bootstrapSwitch('state', false)
            // console.log('got unchecked');
        }
    }
});
// $(document).ready(function(){
// if ($('select').length) {
//     $('select').select2({
//         containerCssClass: 'select-md'
//     });
// }
// });
$(document).ready(function () {
    if (CLOUDMLMSOFTWARE.idleTimeout === true) {
        $.sessionTimeout({
            heading: 'h5',
            title: 'Session expiration',
            message: 'Your session is about to expire. Do you want to stay connected and extend your session?',
            keepAlive: false,
            // keepAliveInterval: 5000,
            redirUrl: CLOUDMLMSOFTWARE.LockUrl,
            logoutUrl: CLOUDMLMSOFTWARE.LockUrl,
            warnAfter: CLOUDMLMSOFTWARE.idleTimeoutTime, //5 minutes default
            redirAfter: CLOUDMLMSOFTWARE.idleTimeoutTime + 60000, //+1 minute
            keepBtnClass: 'btn btn-success',
            keepBtnText: 'Extend session',
            logoutBtnClass: 'btn btn-default',
            logoutBtnText: 'Log me out',
            ignoreUserActivity: false,
        });
    }
});
handleJstreeAjax = function () {
        $("#jstree-ajax").jstree({
            core: {
                themes: {
                    responsive: !1
                },
                check_callback: !0,
                data: {
                    url: function (e) {
                        // alert(e.id);
                        return "#" === e.id ? "treedata" : e.original.file
                    },
                    data: function (e) {
                        if ("#" === e.id) return {
                            id: $('meta[name="root-id"]').attr('content')
                        }
                        else return {
                            id: e.id
                        }
                    },
                    dataType: "json",
                    type: "GET"
                }
            },
            types: {
                "default": {
                    icon: "icon-user text-warning fa-lg"
                },
                file: {
                    icon: "fa fa-file text-warning fa-lg"
                }
            },
            plugins: ["state", "types"]
        })
    },
    TreeView = function () {
        "use strict";
        return {
            init: function () {
                handleJstreeAjax()
            }
        }
    }();
if ($('#jstree-ajax').length) {
    handleJstreeAjax();
}
$(document).ready(function () {
    if ($('.passy').length) {
        // $( '.passy input' ).passy( 'generate', 16 );
        // Passy - password generator
        // ------------------------------
        // Input labels
        var $inputLabelAbsolute = $('.label-indicator-absolute input');
        //Output lables
        var $outputLabelAbsolute = $('.password-indicator-label-abs');
        // Min input length
        $.passy.requirements.length.min = 4;
        // Strength meter
        var feedback = [{
            color: '#D55757',
            text: 'Weak',
            textColor: '#fff'
        }, {
            color: '#EB7F5E',
            text: 'Normal',
            textColor: '#fff'
        }, {
            color: '#3BA4CE',
            text: 'Good',
            textColor: '#fff'
        }, {
            color: '#40B381',
            text: 'Strong',
            textColor: '#fff'
        }];
        //
        // Setup strength meter
        //
        // Absolute positioned label
        $inputLabelAbsolute.passy(function (strength) {
            $outputLabelAbsolute.text(feedback[strength].text);
            $outputLabelAbsolute.css('background-color', feedback[strength].color).css('color', feedback[strength].textColor);
        });
        //
        // Initialize
        //
        // Absolute label
        $('.generate-pass').click(function () {
            $inputLabelAbsolute.passy('generate', 13);
        });
    }
});
//LOGO UPDATION
$("#logo").change(function () {
    $("#logoform").submit();
});
$(document).ready(function () {
    $("#logoform").submit(function (evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#logoform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function (response) {
                // console.log(response);
                $('#logopreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/logo/' + response.filename + ')');
                setTimeout(function () {}, 2000);
            },
        });
        return false;
    });
});
//LOGO icon UPDATION
$("#logoicon").change(function () {
    $("#logoiconform").submit();
});
$(document).ready(function () {
    $("#logoiconform").submit(function (evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#logoiconform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function (response) {
                // console.log(response);
                $('#logoiconpreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/logo/' + response.filename + ')');
                setTimeout(function () {}, 2000);
            },
        });
        return false;
    });
});
//PROFILE PIC UPDATION
$("#profile").change(function () {
    $("#profilepicform").submit();
});
$(document).ready(function () {
    $("#profilepicform").submit(function (evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#profilepicform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function (response) {
                // console.log(response);
                $('#profilephotopreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/profile/' + response.filename + ')');
                setTimeout(function () {}, 2000);
            },
        });
        return false;
    });
});
//PROFILE COVER UPDATION
$("#cover").change(function () {
    $("#coverpicform").submit();
});
$(document).ready(function () {
    $("#coverpicform").submit(function (evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#coverpicform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function (response) {
                $('.profile-cover-img').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename + ')');
                setTimeout(function () {}, 2000);
            },
        });
        return false;
    });
});
if ($("#note-color").length) {
    $("#note-color :input").change(function () {
        var color = $(this).attr('value');
        $(this).parent().parent().parent().parent().parent().parent().attr('class', '');
        $(this).parent().parent().parent().parent().parent().parent().addClass(color + ' panel panel-flat');
    });
};
if ($(".colorpicker-basic").length) {
    $(".colorpicker-basic").spectrum({
        preferredFormat: "hex",
        showInput: true,
        showPalette: true,
        palette: [
            ["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]
        ],
        move: function (color) {
            // console.log(color.toHexString()); // #ff0000
        }
    });
}
$('.submit-note').click(function () {
    $('.notesform').submit();
});
$(".notesform").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.notesform').parsley().validate();
    if ($('.notesform').parsley().isValid()) {
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/post-note',
            data: new FormData($('.notesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(block).block({
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
            },
            success: function (response) {
                $(block).unblock();
                $('.notesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('.notes').length) {
                    $newNote = '<div class="each-note col-sm-3"><div class="card ' + response.color + '"><div class="card-body"><h6 class="text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6><p>' + response.description + '</p></div></div>';
                    $('.notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        // console.log('not valid');
    }
});
$(document).ready(function () {
    if ($(".btn-delete-note").length) {
        $('.notes').on('click', '.btn-delete-note', function (e) {
            var id = $(this).data('id');
            var this_context = $(this);
            // confirm('Are you sure you want to delete the note?','confirmation','yes','no');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this note!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                //console.log(id);
                $.ajax({
                    url: CLOUDMLMSOFTWARE.siteUrl + '/admin/remove-note',
                    data: {
                        'note_id': id
                    },
                    dataType: 'json',
                    async: true,
                    type: 'post',
                    beforeSend: function () {
                        this_context.closest('.each-note')
                    },
                    success: function (response) {
                        this_context.closest('.each-note').remove();
                        swal('Deleted!');
                        setTimeout(function () {}, 2000);
                    },
                    error: function (response) {
                        swal('Something went wrong!');
                    }
                });
            });
        });
    }
});
$(function () {
    // Table setup
    // ------------------------------
    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        // columnDefs: [{ 
        //     orderable: false,
        //     // width: '100px',
        //     targets: [ 5 ]
        // }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            // paginate: {
            //     'first': 'First',
            //     'last': 'Last',
            //     'next': '&rarr;',
            //     'previous': '&larr;'
            // }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    if ($('#ewallet-table').length) {
        $(document).ready(function () {
            oTable = $('#ewallet-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/ewallet/",
                "columnDefs": [{
                    "targets": 3,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        // if (cellData < 0) {
                        //     $(td).css('color', 'red')
                        // } else {
                        //     $(td).css('color', 'green')
                        // }
                    }
                }],
                "columns": [{
                        "data": "username"
                    },
                    {
                        "data": "fromuser"
                    },
                    {
                        "data": "payment_type"
                    },
                    {
                        "data": "payable_amount"
                    },
                    {
                        "data": "created_at"
                    }
                ],

                // ...

                // ...

                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                }
            });
        });
    }

    if ($('#users-list-table').length) {
        $(document).ready(function () {


            oTable = $('#users-list-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/users/data",
                "columns": [{
                        "data": 'rownum',
                        "searchable": false
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "username"
                    },
                    {
                        "data": "sponsor"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "user_type"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "actions"
                    }

                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }

    if ($('#user-cart').length) {
        $(document).ready(function () {


            oTable = $('#user-cart').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/sales/data",
                "columns": [

                    {
                        "data": "invoice_id"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "total_amount"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "invoice"
                    }

                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }

    if ($('#approvepayment-table').length) {
        $(document).ready(function () {


            oTable = $('#approvepayment-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/approve_payments/data",
                "columns": [

                    {
                        "data": 'rownum',
                        "searchable": false
                    },
                    {
                        "data": "order_id"
                    },
                    // {
                    //     "data": "username"
                    // },
                    {
                        "data": "sponsor"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "placement_under"
                    },
                    {
                        "data": "position"
                    }, 
                    {
                        "data": "payment_type"
                    },
                    {
                        "data": "amount"
                    }, 
                    {
                        "data": "invoice"
                    },
                    {
                        "data": "download"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "actions"
                    }



                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }


if ($('#approveusers-table').length) {
        $(document).ready(function () {


            oTable = $('#approveusers-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/approve_users/data",
                "columns": [

                    {
                        "data": 'rownum',
                        "searchable": false
                    },
                 
                    {
                        "data": "username"
                    },
                  
                    {
                        "data": "email"
                    },
                   
                    {
                        "data": "actions"
                    }



                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }

















    if ($('#sales-table').length) {
        $(document).ready(function () {


            oTable = $('#sales-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/sales/data",
                "columns": [


                    {
                        "data": "invoice_id"
                    },
                    {
                        "data": "username"
                    },
                    {
                        "data": "fname",
                        render: function (data, type, row) {
                            return row.fname + '<br>' + row.city + '<br>' + row.state + '<br>' +
                                row.country + '<br>Pin:' + row.pincode + '<br>' + row.email + '<br>Ph:' + row.contact;
                        }
                    },
                    {
                        "data": "total_count"
                    },
                    {
                        "data": "total_amount"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "invoice"
                    }



                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }




    if ($('#ewallet-user-table').length) {
        $(document).ready(function () {
            oTable = $('#ewallet-user-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/wallet/data/",
                "columnDefs": [{
                    "targets": 4,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        // if (cellData < 0) {
                        //     $(td).css('color', 'red')
                        // } else {
                        //     $(td).css('color', 'green')
                        // }
                    }
                }],
                "columns": [{
                        "data": "username"
                    },
                    {
                        "data": "fromuser"
                    },
                
                    {
                        "data": "payment_type"
                    },
                
                    {
                        "data": "payable_amount"
                    },
                    {
                        "data": "created_at"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }
    if ($('#rs-wallet-table').length) {
        $(document).ready(function () {
            oTable = $('#rs-wallet-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/rs-data/",
                "columns": [{
                        "data": "username"
                    },
                    {
                        "data": "fromuser"
                    },
                    {
                        "data": "rs_debit"
                    },
                    {
                        "data": "rs_credit"
                    },
                    {
                        "data": "created_at"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
    }

    if ($('#ticket-departments-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-departments-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/departments/data/",
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-categories-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-categories-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/categories/data/",
                "columns": [{
                        "data": "category"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }

    if ($('#ticket-status-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-status-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/ticket-status/data/",

                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }

    if ($('#ticket-priority-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-priority-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/priorities/data/",
                "columns": [{
                        "data": "priority"
                    },
                    {
                        "data": "priority_desc"
                    },
                    {
                        "data": "priority_color"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-canned-response-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-canned-response-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/canned-responses/data/",
                "columns": [{
                        "data": "title"
                    },
                    {
                        "data": "subject"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#kb-category-table').length) {
        $(document).ready(function () {
            oTable = $('#kb-category-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/kb/categories/data/",
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "slug"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#kb-article-table').length) {
        $(document).ready(function () {
            oTable = $('#kb-article-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/kb/articles/data/",
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "publish_time"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-types-table').length) {
        $(document).ready(function () {
            oTable = $('#ticket-types-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/ticket-types/data/",
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "action"
                    }
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-table').length) {
        var priority = $('#ticket-table').attr('data-priority');
        var department = $('#ticket-table').attr('data-department');
        var category = $('#ticket-table').attr('data-category');
        var status = $('#ticket-table').attr('data-status');
        var overdue = $('#ticket-table').attr('data-overdue');
        var deleted = $('#ticket-table').attr('data-deleted');
        var deleted = $('#ticket-table').attr('data-deleted');
        var pass1 = $("#ticket-number").val();
        var pass2 = $('#ticket-table').attr('data-ticketnumber');
        var username = $('#ticket-table').attr('data-username');
        var userkeyword = $('#ticket-table').attr('data-userkeyword');


        $(document).ready(function () {
            oTable = $('#ticket-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/data/?priority=" + priority + "&department=" + department + "&category=" + category + "&status=" + status + "&overdue=" + overdue + "&deleted=" + deleted + "&ticketnum=" + pass2 + "&username=" + username + "&userkeyword=" + userkeyword,
                "columns": [{
                        "data": "ticket_number"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "subject"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "priority"
                    },
                    {
                        "data": "department"
                    },
                    {
                        "data": "action"
                    }
                ],

                "fnDrawCallback": function (oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
});
//Category
$(function () {
    if ($('#categories .category').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.category').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_categories',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
// $(function(){
//     if ($('#faq_enable').length) {
//          $('#faq .faq').editable('toggleDisabled');
//          $('#faq_enable').click(function() {
//              $('#faq .faq').editable('toggleDisabled');
//               $('#faq_enable').text(function(i, text){
//                  return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
//             });
//         });
//     $.fn.editable.defaults.mode = 'popup';
//     $.fn.editable.defaults.params = function (params) {
//         params._token = $("meta[name=csrf-token]").attr("content");
//         return params;
//     };
//     $('.faq').editable({
//         validate: function(value) {
//     },        
//     type: 'text',
//     url:CLOUDMLMSOFTWARE.siteUrl+'/admin/update_ticket_faq', 
//     placement: 'top', 
//     send:'always',
//     disabled:true,
//     ajaxOptions: {
//     dataType: 'json'
//     },
//     success: function(response, newValue) {
//         $(this).html(newValue);
//         }        
//  });
// }
//  });
$(document).ready(function () {
    $('.content').on('click', '.btn-delete-category', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related tickets will be unlinked from this category",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/categories/destroy/' + id;
        });
    });
    if ($(".btn-delete-tag").length) {
        $('#ticket-tags').on('click', '.btn-delete-tag', function (e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this category",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_tags/' + id;
            });
        });
    }
    if ($(".btn-delete-status").length) {
        $('#ticket-statuses').on('click', '.btn-delete-status', function (e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this status",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_status/' + id;
            });
        });
    }
    if ($(".btn-delete-priority").length) {
        $('#ticket-priorities').on('click', '.btn-delete-priority', function (e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this priority",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_priority/' + id;
            });
        });
    }
    $('.content').on('click', '.btn-delete-kb-category', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related articles will be unlinked from this category",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/kb/category/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-kb-article', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This article will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/kb/article/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-kb-article2', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This article will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/user/helpdesk/kb/article/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-canned-response', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This canned reponse will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/canned-responses/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-priority', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This priority will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/priorities/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-ticket-type', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This ticket type will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket-types/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-ticket', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This ticket will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/ticket/delete/' + id;
        });
    });
});
$(function () {
    if ($('#ticket-priorities .priority').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.priority').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_priority',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function () {
    if ($('#ticket-statuses .status').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.status').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_status',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function () {
    if ($('#ticket-tags .tag').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.tag').editable({
            validate: function (value) {},
            type: 'text',
            url: 'http://preset.cloudmlmsoftware.com/admin/save_ticket_tags',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function () {
    if ($('#ticket-departments-table').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        // $('#ticket-departments-table').on('click', '.btn-enable-table-edit', function(e) {
        //   e.stopPropagation();
        //   console.log( $(this).parent('tr').find('.table-element-editable'));
        //   $(this).parents('tr').find('.table-element-editable').editable('toggle');
        // alert('aaaaa');
        // $('.table-element-editable').editable({
        //             validate: function(value) {
        //         },        
        //         type: 'text',               
        //         placement: 'top', 
        //         send:'always',
        //         disabled:false,
        //         ajaxOptions: {
        //         dataType: 'json'
        //         },
        //         success: function(response, newValue) {
        //             $(this).html(newValue);
        //             }        
        //      });
        //          $('.department').editable({
        //             validate: function(value) {
        //         },        
        //         type: 'text',        
        //         placement: 'top', 
        //         send:'always',
        //         disabled:false,
        //         ajaxOptions: {
        //             dataType: 'json',
        //         },
        //         success: function(response, newValue) {
        //             $(this).html(newValue);
        //             }        
        //      });
        // });
    }
});
//  $(function(){
// if ($('#kb-category-table').length) {
//         $.fn.editable.defaults.mode = 'popup';
//         $.fn.editable.defaults.params = function (params) {
//             params._token = $("meta[name=csrf-token]").attr("content");
//             return params;
//         };
//   $('#kb-category-table').on('click', '.btn-enable-table-edit', function(e) {
//     e.stopPropagation();
//     console.log( $(this).closest('tr').find('.table-element-editable'));
//     $(this).closest('tr').find('.table-element-editable').editable({
//             validate: function(value) {
//         },        
//         type: 'text',        
//         placement: 'right', 
//         send:'always',
//         disabled:false,
//         ajaxOptions: {
//             dataType: 'json',
//         },
//         success: function(response, newValue) {
//             $(this).html(newValue);
//             }        
//      });
// });
//     }
//      });
if ($("#ticket-departments-table").length) {
    $('#ticket-departments-table').on('click', '.btn-delete-department', function (e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related tickets will be unlinked from this department",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/departments/destroy/' + id;
        });
    });
}
if ($(".changestatuswrapper").length) {
    $('.changestatuswrapper').on('click', '.changestatusdropdownitem', function (e) {
        var status = $(this).data('status');
        var id = $(this).data('ticketid');
        var statusid = $(this).data('statusid');
        var this_context = $(this).closest('.statusdropbtn');
        buttonClasses = [];
        buttonClasses = {
            'Open': 'btn-danger',
            'Resolved': 'btn-success',
            'Closed': 'btn-grey',
            'Archived': 'btn-grey',
            'Deleted': 'btn-grey',
            'Unverified Status': 'btn-danger',
            'Request approval': 'btn-danger'
        };
        swal({
            title: "",
            text: "Change status?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + status,
            closeOnConfirm: true
        }, function () {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket/change-status/', {
                ticketid: id,
                statusid: statusid
            }, function (response) {
                this_context.parent().find('.statusname').text(status);
                this_context.parent().find('.statusname').removeClass('');
                this_context.parent().find('.statusname').attr('class', 'statusname btn-xs btn ' + buttonClasses[status]);
                this_context.parent().find('.statusdrop').removeClass('');
                this_context.parent().find('.statusdrop').attr('class', 'statusdrop btn-xs btn dropdown-toggle ' + buttonClasses[status]);
                // console.log(buttonClasses[status]);
            });
        });
    });
}


// if ($("#changestatus").length) {
//   $('#changestatus').on('click', '.changestatusdropdownitem', function(e) {
//       var status = $(this).data('status');
//       var id = $(this).data('ticketid');
//       var statusid = $(this).data('statusid');
//        swal({
//         title: "",
//         text: "Change status?",
//         type: "warning",
//         animation: false,
//         customClass: 'animated bounceOutLeft',
//         showCancelButton: true,
//         confirmButtonClass: "btn-danger",
//         confirmButtonText: "Yes, change status to "+status,
//         closeOnConfirm: true
//       }, function() {
//         $.get(
//         CLOUDMLMSOFTWARE.siteUrl+'/admin/helpdesk/tickets/ticket/change-status/',
//         { ticketid: id, statusid:statusid },
//         function(response) {
//                     location.reload();
//         });
//       });
//   });
// }
if ($("#ticket-table").length) {
    $('#ticket-table').on('click', '.changeprioritydropdownitem', function (e) {
        var priority = $(this).data('priority');
        var id = $(this).data('ticketid');
        var priorityid = $(this).data('priorityid');
        var prioritycolor = $(this).data('prioritycolor');
        var this_context = $(this).closest('.prioritydropbtn');
        swal({
            title: "",
            text: "Change priority?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + priority,
            closeOnConfirm: true
        }, function () {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket/change-priority/', {
                ticketid: id,
                priorityid: priorityid
            }, function (response) {
                this_context.parent().find('.priorityname').text(priority);
                this_context.parent().find('.priorityname').attr('style', 'color:white;background-color:' + prioritycolor + '');
                this_context.parent().find('.prioritydrop').attr('style', 'color:white;background-color:' + prioritycolor + '');
            });
        });
    });
}
if ($('.mailcomposer').length) {
    $('.mailcomposer').summernote({
        callbacks: {
            onImageUpload: function (image) {
                that = $(this);
                uploadImage(image[0], that);
            }
        }
    });
}

function uploadImage(image, that) {
    var data = new FormData();
    data.append("file", image);
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
        data: data,
        dataType: 'json',
        async: true,
        type: 'post',
        processData: false,
        contentType: false,
        beforeSend: function () {
            // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
        },
        success: function (response) {
            var image = $('<img>').attr('src', CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename);
            var ImageUrl = CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename;
            $(that).summernote('insertImage', ImageUrl)
            setTimeout(function () {}, 2000);
        },
    });
    return false;
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: 'Your url to deal with your image',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function (url) {
            var image = $('<img>').attr('src', 'http://' + url);
            $('#summernote').summernote("insertNode", image[0]);
        },
        error: function (data) {
            // console.log(data);
        }
    });
}
if ($(".colorpicker-priority").length) {
    $(".colorpicker-priority").spectrum({
        preferredFormat: "hex",
        showInput: true,
        showPalette: true,
        palette: [
            ["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]
        ]
    });
}
if ($('#cannedchooser').length) {
    $('#cannedchooser').on("select2:selecting", function (e) {
        var id = $(e.currentTarget).find("option:selected").val();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/canned-responses/get-canned-response',
            data: {
                id: id
            },
            dataType: 'json',
            type: 'post',
            processData: true,
            beforeSend: function () {},
            success: function (response) {
                $('#ticket_title').val(response.subject);
                $('#ticket_body').summernote('code', response.message);
            },
            error: function (response) {
                // console.log(response);
            }
        });
    });
}
if ($('#resetFilter').length) {
    $('#resetFilter').on("click", function () {
        $('.filter, #assigned-to-filter, #departments-filter, #sla-filter, #priority-filter, #source-filter').val(null).trigger("change");
        clearlist += 1;
        clearfilterlist();
    });
}
if ($('#selector').length) {}
/*Dashboard */
// if ($('#pie_gender_legend').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/gender.json', function(data) {
//         animatedPieWithLegend("#pie_gender_legend", 120 ,data);
//     });
// }        
//  function animatedPieWithLegend(element, size,data) {
//         // Add data set
//         // var data = pie_gender_legend_data;
//         // Main variables
//         var d3Container = d3.select(element),
//             distance = 2, // reserve 2px space for mouseover arc moving
//             radius = (size/2) - distance,
//             sum = d3.sum(data, function(d) { return d.value; });
//         // Create chart
//         // ------------------------------
//         // Add svg element
//         var container = d3Container.append("svg");
//         // Add SVG group
//         var svg = container
//             .attr("width", size)
//             .attr("height", size)
//             .append("g")
//                 .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  
//         // Construct chart layout
//         // ------------------------------
//         // Pie
//         var pie = d3.layout.pie()
//             .sort(null)
//             .startAngle(Math.PI)
//             .endAngle(3 * Math.PI)
//             .value(function (d) { 
//                 return d.value;
//             }); 
//         // Arc
//         var arc = d3.svg.arc()
//             .outerRadius(radius);
//         //
//         // Append chart elements
//         //
//         // Group chart elements
//         var arcGroup = svg.selectAll(".d3-arc")
//             .data(pie(data))
//             .enter()
//             .append("g") 
//                 .attr("class", "d3-arc")
//                 .style({
//                     'stroke': '#fff',
//                     'stroke-width': 2,
//                     'cursor': 'pointer'
//                 });
//         // Append path
//         var arcPath = arcGroup
//             .append("path")
//             .style("fill", function (d) {
//                 return d.data.color;
//             });
//         // Add interactions
//         arcPath
//             .on('mouseover', function (d, i) {
//                 // Transition on mouseover
//                 d3.select(this)
//                 .transition()
//                     .duration(500)
//                     .ease('elastic')
//                     .attr('transform', function (d) {
//                         d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
//                         var x = Math.sin(d.midAngle) * distance;
//                         var y = -Math.cos(d.midAngle) * distance;
//                         return 'translate(' + x + ',' + y + ')';
//                     });
//                 // Animate legend
//                 $(element + ' [data-slice]').css({
//                     'opacity': 0.3,
//                     'transition': 'all ease-in-out 0.15s'
//                 });
//                 $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
//             })
//             .on('mouseout', function (d, i) {
//                 // Mouseout transition
//                 d3.select(this)
//                 .transition()
//                     .duration(500)
//                     .ease('bounce')
//                     .attr('transform', 'translate(0,0)');
//                 // Revert legend animation
//                 $(element + ' [data-slice]').css('opacity', 1);
//             });
//         // Animate chart on load
//         arcPath
//             .transition()
//                 .delay(function(d, i) { return i * 500; })
//                 .duration(500)
//                 .attrTween("d", function(d) {
//                     var interpolate = d3.interpolate(d.startAngle,d.endAngle);
//                     return function(t) {
//                         d.endAngle = interpolate(t);
//                         return arc(d);  
//                     }; 
//                 });
//         //
//         // Append counter
//         //
//         // Append element
//         d3Container
//             .append('h2')
//             .attr('class', 'mt-15 mb-5 text-semibold');
//         // Animate counter
//         d3Container.select('h2')
//             .transition()
//             .duration(1500)
//             .tween("text", function(d) {
//                 var i = d3.interpolate(this.textContent, sum);
//                 return function(t) {
//                     this.textContent = d3.format(",d")(Math.round(i(t)));
//                 };
//             });
//         //
//         // Append legend
//         //
//         // Add element
//         var legend = d3.select(element)
//             .append('ul')
//             .attr('class', 'chart-widget-legend')
//             .selectAll('li').data(pie(data))
//             .enter().append('li')
//             .attr('data-slice', function(d, i) {
//                 return i;
//             })
//             .attr('style', function(d, i) {
//                 return 'border-bottom: 2px solid ' + d.data.color;
//             })
//             .text(function(d, i) {
//                 return d.data.gender + ': ';
//             });
//         // Add value
//         legend.append('span')
//             .text(function(d, i) {
//                 return d.data.value;
//             });
//     }
if ($('#users_join').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json', function (data) {
        users_join(data);
    });
}

function users_join(data) {
    var dom = document.getElementById("users_join");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            backgroundColor: 'white',
            borderColor: '#76b6e7',
            borderWidth: 1,
            extraCssText: 'box-shadow: 0 2px 4px 0 rgba(0,0,0,0.05);',
            textStyle: {
                color: 'rgb(118, 182, 231)',
                fontWeight: 'bold'
            }
        },

        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Members',
            id: 'members-chart-1',
            name: 'Members',
            type: 'line',
            smooth: true,
            color: "#76b6e7",
            symbol: 'circle',
            symbolSize: '6',
            sampling: 'average',
            
            areaStyle: {
                opacity: 0.1,
                color: {
                    type: "linear",
                    x: 1,
                    y: 0,
                    x: 1,
                    y2: 1,
                    colorStops: [{
                        "offset": 0,
                        "color": "#76b6e7" //0% 
                    }, {
                        "offset": 1,
                        "color": "#76b6e7" // 100% 
                    }],
                    "globalCoord": false //  false
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}

if ($('#users_join_vs_sales').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json', function (data) {
        users_join_vs_sales(data);
    });
}

function users_join_vs_sales(data) {

    var dom = document.getElementById("users_join_vs_sales");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            backgroundColor: 'white',
            borderColor: '#76b6e7',
            borderWidth: 1,
            extraCssText: 'box-shadow: 0 2px 4px 0 rgba(0,0,0,0.05);',
            textStyle: {
                color: 'rgb(118, 182, 231)',
                fontWeight: 'bold'
            }
        },
        grid: {
            left: '1%',
            right: '1%',
            bottom: '15%',
            top: '15%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: true,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisPointer: {
                type: "shadow",
                shadowStyle: {
                    color: "blue",
                    opacity: 0.05
                }
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '8'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#f5f5f5'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#76b6e7',
            fillerColor: '#f1f8fd',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Members',
            id: 'members-chart-1',
            name: 'Members',
            type: 'line',
            smooth: true,
            color: "#76b6e7",
            symbol: 'circle',
            symbolSize: '3',
            sampling: 'average',
            
            areaStyle: {
                opacity: 0.1,
                color: {
                    type: "linear",
                    x: 1,
                    y: 0,
                    x: 1,
                    y2: 1,
                    colorStops: [{
                        "offset": 0,
                        "color": "#76b6e7" //0% 
                    }, {
                        "offset": 1,
                        "color": "#76b6e7" // 100% 
                    }],
                    "globalCoord": false //  false
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}



if ($('#users_sales_graph').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_sales.json', function (data) {
    
        users_sales_graph(data);
        console.log(data);
    });
}



function users_sales_graph(data) {
    
    var dom = document.getElementById("users_sales_graph");
    var userssaleChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            backgroundColor: 'white',
            borderColor: '#76b6e7',
            borderWidth: 1,
            extraCssText: 'box-shadow: 0 2px 4px 0 rgba(0,0,0,0.05);',
            textStyle: {
                color: 'rgb(118, 182, 231)',
                fontWeight: 'bold'
            }
        },
        grid: {
            left: '1%',
            right: '1%',
            bottom: '15%',
            top: '15%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: true,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisPointer: {
                type: "shadow",
                shadowStyle: {
                    color: "#228B22 ",
                    opacity: 0.05
                }
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '8'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#228B22'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#228B22   ',
            fillerColor: '#f1f8fd',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Sales',
            id: 'members-chart-1',
            name: 'Sales',
            type: 'line',
            smooth: true,
            color: "#228B22 ",
            symbol: 'circle',
            symbolSize: '3',
            sampling: 'average',
            
            areaStyle: {
                opacity: 0.1,
                color: {
                    type: "linear",
                    x: 1,
                    y: 0,
                    x: 1,
                    y2: 1,
                    colorStops: [{
                        "offset": 0,
                        "color": "#228B22" //0% 
                    }, {
                        "offset": 1,
                        "color": "#228B22" // 100% 
                    }],
                    "globalCoord": false //  false
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        userssaleChart.resize();
    });
    userssaleChart.on('dataZoom', updatePosition);

    function updatePosition() {
        userssaleChart.resize();
    }
    if (option && typeof option === "object") {
        userssaleChart.setOption(option, true);
    }
}




if ($('#users_join_over_time').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/usersjoining.json', function (data) {
    
        users_join_over_time(data);
        console.log(data);
    });
}


function users_join_over_time(data) {
    
    var dom = document.getElementById("users_join_over_time");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            backgroundColor: 'white',
            borderColor: '#76b6e7',
            borderWidth: 1,
            extraCssText: 'box-shadow: 0 2px 4px 0 rgba(0,0,0,0.05);',
            textStyle: {
                color: 'rgb(118, 182, 231)',
                fontWeight: 'bold'
            }
        },
        grid: {
            left: '1%',
            right: '1%',
            bottom: '15%',
            top: '15%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: true,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisPointer: {
                type: "shadow",
                shadowStyle: {
                    color: "blue",
                    opacity: 0.05
                }
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '8'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#f5f5f5'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#76b6e7',
            fillerColor: '#f1f8fd',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Members',
            id: 'members-chart-1',
            name: 'Members',
            type: 'line',
            smooth: true,
            color: "#76b6e7",
            symbol: 'circle',
            symbolSize: '3',
            sampling: 'average',
            
            areaStyle: {
                opacity: 0.1,
                color: {
                    type: "linear",
                    x: 1,
                    y: 0,
                    x: 1,
                    y2: 1,
                    colorStops: [{
                        "offset": 0,
                        "color": "#76b6e7" //0% 
                    }, {
                        "offset": 1,
                        "color": "#76b6e7" // 100% 
                    }],
                    "globalCoord": false //  false
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}

























// Select2
var _componentSelect2 = function () {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    };

    // Initialize
    $('.form-control-select2').select2({
        minimumResultsForSearch: Infinity
    });
};

_componentSelect2();




if ($('#pie_gender_legend').length) {
    pie_gender(pie_gender_legend_data);
}

function pie_gender(data) {
    var dom = document.getElementById("pie_gender_legend");
    var genderPieChart = echarts.init(dom);
    var app = {};
    option = null;;
    option = {
        // title: {
        //     text: 'Gender statistics',
        //     left: 'center',
        //     top: 20,
        //     textStyle: {
        //         color: '#000'
        //     }
        // },

        color: ["rgba(92, 107, 192, 0.71)", "rgba(239, 83, 80, 0.76)"],
        tooltip: {
            trigger: 'item',
            formatter: "{b} : {c} ({d}%)"
        },
        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: data.sort(function (a, b) {
                return a.value - b.value;
            })
        },
        series: [{
            selectedMode: 'single',
            name: 'Gender statistics',
            type: 'pie',
            radius: '55%',
            center: ['50%', '50%'],
            data: data.sort(function (a, b) {
                return a.value - b.value;
            }),
            roseType: 'radius',
            smooth: true,
            itemStyle: {
                normal: {
                    borderColor: '#fff',
                    borderWidth: '3',
                    shadowColor: 'rgba(0,0,0,0.2)',
                    shadowBlur: 15,
                    shadowOffsetY: 5
                }
            },
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
                return Math.random() * 200;
            }
        }]
    };
    if (option && typeof option === "object") {
        genderPieChart.setOption(option, true);
    }
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        genderPieChart.resize();
    });
    genderPieChart.on('dataZoom', updatePosition);

    function updatePosition() {
        genderPieChart.resize();
    }
}





if ($('#monthly-join').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/monthly-join.json', function (data) {
        monthly_join(data);
    });
}

function monthly_join(data) {
    var dom = document.getElementById("monthly-join");
    var monthlyJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            formatter: "{b} : {c}"
        },
        xAxis: {
            type: 'category',
            show: false,
            data: dates
        },
        yAxis: {
            type: 'value',
            show: false,
            data: values
        },
        color: ['#58b358'],
        series: [{
            name: 'Monthly Join',
            type: 'line',
            symbol: 'none',
            smooth: true,
            lineStyle: {
                normal: {
                    width: 2,
                }
            },
            data: values
        }]
    };;
    if (option && typeof option === "object") {
        monthlyJoinChart.setOption(option, true);
    }
}
// if ($('#weekly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/yearly-join.json', function(data) {
//         var dom = document.getElementById("weekly-join");
//         sparkline(dom, data, "line", 30, 50, "basis", 750, 2000, "#26A69A");
//     });
// }     
// if ($('#monthly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/monthly-join.json', function(data) {
//         sparkline("#monthly-join",data, "line", 30, 50, "basis", 750, 2000, "#FF7043");
//     });
// }     
// if ($('#yearly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/yearly-join.json', function(data) {
//         sparkline("#yearly-join", data,"line", 30, 50, "basis", 750, 2000, "#5C6BC0");
//     });
// }     
// function sparkline(dom,data){
//     var myChart = echarts.init(dom);
//     var app = {};
//     option = null;
//      var dates = [],
//             values = [];
//         for (var property in data) {
//            if ( ! data.hasOwnProperty(property)) {
//               continue;
//            }
//            dates.push(data[property].date);
//            values.push(data[property].value);
//         }
//     option = {
//         tooltip: {
//             trigger: 'axis',
//             formatter: "{b} : {c}"
//         },
//         xAxis: {
//             type: 'category',
//             show:false,
//             data: dates
//         },
//         yAxis: {
//              type: 'value',
//             show:false,
//             data: values
//         },
//         color:['#58b358'],
//         series: [
//             {
//                 name: 'Monthly Join',
//                 type: 'line',
//                 symbol :'none',
//                 smooth: true,
//                 lineStyle: {
//                     normal: {
//                         width: 2,                   
//                     }
//                 },
//                 data:values
//             }
//         ]
//     };;
//     if (option && typeof option === "object") {
//         myChart.setOption(option, true);
//     }
// }
Array.prototype.unique = function () {
    return this.reduce(function (previous, current, index, array) {
        previous[current.toString() + typeof (current)] = current;
        return array.length - 1 == index ? Object.keys(previous).reduce(function (prev, cur) {
            prev.push(previous[cur]);
            return prev;
        }, []) : previous;
    }, {});
};

if ($('#package_sales_graph').length) {

    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/package-sales.json', function (data) {
        // console.log(111111111);
        var dom = document.getElementById("package_sales_graph");
        package_sales_graph(data);
    });

}

function package_sales_graph(data) {

    var EchartsLines = function () {

        var _lineChartExamples = function () {

            var line_zoom_element = document.getElementById('package_sales_graph');

            if (line_zoom_element) {

                var line_zoom = echarts.init(line_zoom_element);
                var series = [];

                $.each(data, function (key, datain) {

                    series.push({
                        name: datain.pack,
                        type: 'line',
                        smooth: true,
                        smoothness: 0.2,
                        data: datain.purchase_count,
                    });
                });

                line_zoom.setOption({
                    color: ["#424956", "#d74e67", '#0092ff'],
                    textStyle: {
                        fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                        fontSize: 13
                    },
                    animationDuration: 750,
                    grid: {
                        left: 0,
                        right: 40,
                        top: 35,
                        bottom: 60,
                        containLabel: true
                    },
                    legend: {
                        data: ['Software', 'Hardware', 'Accessories'],
                        itemHeight: 8,
                        itemGap: 20
                    },
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Roboto, sans-serif'
                        }
                    },
                    xAxis: [{
                        type: 'category',
                        boundaryGap: false,
                        axisLabel: {
                            show: false
                        },
                        axisLine: {
                            show: false
                        },
                        axisLabel: {
                            textStyle: {
                                color: '#333',
                                fontStyle: 'normal',
                                fontSize: '9'
                            }
                        },
                        data: data.dates
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            textStyle: {
                                color: '#333',
                                fontStyle: 'normal',
                                fontSize: '9'
                            }
                        },
                        axisLine: {
                            show: false
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#f1f1f1',
                                type: 'solid',
                                width: 1,
                                shadowColor: 'rgba(0,0,0,0)',
                                shadowBlur: 5,
                                shadowOffsetX: 3,
                                shadowOffsetY: 3,
                            },
                        },
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                            }
                        }
                    }],
                    dataZoom: [{
                        type: 'inside',
                        start: 0,
                        end: 60
                    }, {
                        height: 10,
                        backgroundColor: '#ffffff',
                        dataBackgroundColor: '#ddd',
                        handleColor: '#dddddd',
                        fillerColor: '#f5f5f5',
                        handleSize: 20,
                        start: 0,
                        end: 10,
                    }],
                    series: series
                });
            }


            // var resizeCharts;
            // window.onresize = function () {
            //     clearTimeout(resizeCharts);
            //     resizeCharts = setTimeout(function () {
            //         triggerChartResize();
            //     }, 200);
            // };
        };

        return {
            init: function () {
                _lineChartExamples();
            }
        }
    }();
    EchartsLines.init();
}
if ($('#package_purchase_graph').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/package-sales.json', function (data) {
        // var groupBy = function(xs, key) {
        //   return xs.reduce(function(rv, x) {
        //     (rv[x[key]] = rv[x[key]] || []).push(x);
        //     return rv;
        //   }, {});
        // };
        // var groubedByTeam=groupBy(data, 'package')
        // console.log(groubedByTeam);
        var dom = document.getElementById("package_purchase_graph");
        package_purchase_graph(data, dom);
    });
}

function package_purchase_graph(data, dom) {
    var PackageSalesChart = echarts.init(dom);
    var app = {};
    option = null;
    var graphDataDates = [];
    var graphDataValues = [];
    // data.forEach(function(entry) {
    //   entry.purchase_history_r.forEach(function(entryin){
    //    graphDataDates.push(entryin.date);        
    //   })
    // });    
    // console.log(graphDataDates);
    // var date_array = [];
    // var value_array = [];
    var data_array = [];
    // data_array['package'] = [];
    // data_array['dates'] = [];
    // data_array['values'] = [];
    // console.log(data);
    for (var i = 0; i < data.length; i++) {
        //check if the index exists in the outer array (row)
        if (!(i in data_array)) {
            //if it doesn't exist, we need another array to fill
            data_array[i] = [];
            data_array[i]['dates'] = [];
            data_array[i]['values'] = [];
        }
        row = data_array[i];
        // console.log(data[i].purchase_history_r);
        for (var j = 0; j < data[i].purchase_history_r.length; j++) {
            //check if the index exists in the inner array (column)
            if (!(i in row)) {
                //if it doesn't exist, we need to fill it with `0`
                row[j] = 0;
            }
            data_array[i]['package'] = data[i].package;
            data_array[i]['dates'].push(data[i].purchase_history_r[j].date);
            data_array[i]['values'].push(data[i].purchase_history_r[j].value);
            // graphDataDates[i].push(data[i].purchase_history_r[j].date); 
            // console.log(sub_array);
            // data[i].purchase_history_r.forEach(function(entry) {
            // console.log(entry);
            // graphDataDates.push(entry[x].date);
            // entry.purchase_history_r.forEach(function(entryin){
            //  graphDataDates.push(entryin.date);        
            // })
            // }); 
            // data[i].purchase_history_r.forEach(function(entryin){
            // console.log(entryin.date);
            // console.log(i+'xx  '+entryin.date);
            // var graphDataDates[i] = [];
            // graphDataDates.push(entryin.date);        
            // })
        }
        // graphDataDates.push(data_array.concat());
        // graphDataValues.push(data_array);
        // entry.purchase_history_r.forEach(function(entryin){
        //  graphDataDates.push(entryin.date);        
        // })
    };
    // console.log(data_array);
    // console.log(graphDataValues);
    var series = [];
    echarts.util.each(data_array, function (datain) {
        // console.log(datain.package);
        series.push({
            name: datain.package,
            type: 'line',
            smooth: true,
            smoothness: 0.2,
            data: datain.values,
        });
    });
    var dates = [];
    echarts.util.each(data_array, function (datain) {
        // console.log(datain.dates);
        dates.push(datain.dates);
    });
    graphDataDates = [].concat.apply([], dates).unique();
    // console.log(graphDataDates);
    // console.log(series);
    // for (var i = 0; i < data.length; i++) {
    //    linearray : {
    //        name:'Elite',
    //        type:'line',
    //        smooth:true,
    //        sampling: 'average',
    //        color:['#58b358'],
    //        itemStyle: {
    //            normal: {
    //                color: 'rgba(4, 177, 255, 0.9411764705882353)'
    //            }
    //        }, 
    //        lineStyle: {
    //        normal: {
    //            color: 'rgb(76, 175, 80)',
    //            width: 2,
    //        },
    //        xAxisIndex: 1,
    //        yAxisIndex: 1,
    //    },
    //        data: graphDataValues
    //    }
    // }
    // var graphDataSets = [];
    //  data.forEach(function(entry) {
    //    entry.purchase_history_r.forEach(function(entryin){
    //     graphDataSets.push(entryin.date);        
    //    })
    // });
    // vip.forEach(function(entry) {
    //   vip_dates.push(entry.date);
    //    vip_values.push(entry.value);
    // });
    // // console.log(elite_values);
    // for (var property in premium) {
    //    if ( ! data.hasOwnProperty(property)) {
    //       continue;
    //    }
    //    premium_dates.push(data[property].date);
    //    premium_values.push(data[property].value);
    // }
    // for (var property in vip) {
    //    if ( ! data.hasOwnProperty(property)) {
    //       continue;
    //    }
    //    vip_dates.push(data[property].date);
    //    vip_values.push(data[property].value);
    // }
    // console.log(elite_dates);
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'dotted',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        xAxis: {
            type: 'category',
            position: 'top',
            offset: 0,
            boundaryGap: false,
            axisLabel: {
                textStyle: {
                    color: '#ddd',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: graphDataDates
        },
        yAxis: {
            type: 'value',


            // boundaryGap: [0, '100%'],
            //         axisTick: {show: true},
            //         axisLine: {show: false},
            //         axisLabel: {show: true},
            //         splitLine: {
            //             lineStyle: {
            //             color: '#f1f1f1',
            //             type: 'solid',
            //             width: 1,
            //             shadowColor: 'rgba(0,0,0,0)',
            //             shadowBlur: 5,
            //             shadowOffsetX: 3,
            //             shadowOffsetY: 3,
            //             },  
            // },
        },
        color: ["rgb(76, 175, 80)", "rgb(92, 107, 192)", "rgb(255, 87, 34)", ],
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 40
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: series
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        PackageSalesChart.resize();
    });
    PackageSalesChart.on('dataZoom', updatePosition);

    function updatePosition() {
        PackageSalesChart.resize();
    }
    if (option && typeof option === "object") {
        PackageSalesChart.setOption(option, true);
    }
}
if ($('#graph_tickets_legend').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/tickets-status.json/0/0', function (data) {
        var dom = document.getElementById("graph_tickets_legend");
        graph_tickets_legend(data, dom);
    });
}

function graph_tickets_legend(data, dom) {
    var TicketsChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        open = [],
        closed = [],
        reopened = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        open.push(data[property].open);
        closed.push(data[property].closed);
        reopened.push(data[property].reopened);
    }
    option = {
        //     title: {
        //     text: 'Ticket Status Overview',
        //     subtext: 'Showing open,closed and reopened tickets',
        //     x: 'left'
        // },
        grid: {
            top: 110,
            left: 15,
            right: 15,
            bottom: 30
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'solid',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
            // formatter: function (params) {
            //     console.log(params);            
            //     return params[0].seriesName + ': ' + params[0].value;
            // }
        },
        legend: {
            // right:10,
            // top:0,
            itemGap: 16,
            itemWidth: 18,
            itemHeight: 10,
            data: ['Open', 'Closed', 'Reopened'],
            animation: true,
            textStyle: {
                color: '#ccc'
            },
            // selectedMode: 'single',
            backgroundColor: 'rgb(243,243,243)',
            borderRadius: 5
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        series: [{
            name: 'Open',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#F44336",
                }
            },
            data: open
        }, {
            name: 'Closed',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#4CAF50",
                }
            },
            data: closed
        }, {
            name: 'Reopened',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#f39c11",
                }
            },
            data: reopened
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        TicketsChart.resize();
    });
    TicketsChart.on('dataZoom', updatePosition);

    function updatePosition() {
        TicketsChart.resize();
    }
    if (option && typeof option === "object") {
        TicketsChart.setOption(option, true);
    }
    // Daterange picker
    // ------------------------------
    $('.daterange-ranges-tickets').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 360
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        applyClass: 'btn-small bg-slate-600 btn-block',
        cancelClass: 'btn-small btn-default btn-block',
        format: 'MM/DD/YYYY'
    }, function (start, end) {
        var DisplayStart = start.format('MMMM D');
        var DisplayEnd = end.format('MMMM D');
        var ServerStart = start.format('MMMM D');
        var ServerEnd = end.format('MMMM D');
        $('.daterange-ranges-tickets span').html(DisplayStart + ' - ' + DisplayEnd);
        var dom = document.getElementById("graph_tickets_legend");
        let existInstance = echarts.getInstanceByDom(dom);
        if (existInstance) {
            if (true) {
                echarts.dispose(TicketsChart);
            }
        }
        $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/tickets-status.json/' + ServerStart + '/' + ServerEnd, function (data) {
            var dom = document.getElementById("graph_tickets_legend");
            graph_tickets_legend(data, dom);
        });
    });
}
$('.daterange-ranges-tickets span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
$(document).ready(function () {
    $(".selectall").focus(function () {
        $(this).select();
    });
});
if ($('#enable_settings').length) {
    $(function () {
        $('#enable_settings').click(function () {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable_settings').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updatesettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#enable-package-edit').length) {
    $(function () {
        $('#enable-package-edit').click(function () {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable-package-edit').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/plansettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#leadership').length) {
    $(function () {
        $('#leadership').click(function () {
            $('#leadership-form .leadership').editable('toggleDisabled');
            $('#leadership').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.leadership').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'Value is required.';
                if (!$.isNumeric(value)) return 'Value should be numeric.';
            },
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updateleadership',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#settings .directrefer').length) {
    $(function () {
        $('#enable').click(function () {
            $('#settings .directrefer').editable('toggleDisabled');
            $('#enable').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.directrefer').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/direct-referbonus',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#matching-enable').length) {
    $(function () {
        $('#matching-enable').click(function () {
            $('#matching .matching').editable('toggleDisabled');
            $('#matching-enable').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.matching').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/groupsales',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#reorder .reorder').length) {
    $(function () {
        $('#enable-reorder').click(function () {
            $('#reorder .reorder').editable('toggleDisabled');
            $('#enable-reorder').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.reorder').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/reorder',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#reorder-pv .reorder-pv').length) {
    $(function () {
        $('#enable-reorder-pv').click(function () {
            $('#reorder-pv .reorder-pv').editable('toggleDisabled');
            $('#enable-reorder-pv').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.reorder-pv').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/reorder-pv',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#settings .currency').length) {
    $(function () {
        $('#enable').click(function () {
            $('#settings .currency').editable('toggleDisabled');
            $('#enable').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.currency').editable({
            validate: function (value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/currency',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}

if ($('#enable-ranksettings-edit').length) {

    $(function () {
        $('#enable-ranksettings-edit').click(function () {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable-ranksettings-edit').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.settings').editable({
            validate: function (value) {
                if ($.trim(value) == '')
                    return 'Value is required.';
            },
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updateranksettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}

if ($('#enable-email-settings-edit').length) {
    $(function () {
        $('#enable-email-settings-edit').click(function () {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable-email-settings-edit').text(function (i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.settings').editable({
            validate: function (value) {

            },
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/emailsettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function (response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}

//shilpa-start

$(document).on('click', '.approvepayment', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function () {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_approve',
                type: "post",

                data: {
                    id: id
                },
                success: function (data) {
                    swal("Good job!", "Successfully deleted!", "success");

                    $('#approvepayment-table').DataTable().ajax.reload();

                }

            })


        });
});


$(document).on('click', '.leaddelete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function () {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/deletelead',
                type: "post",

                data: {
                    id: id
                },
                success: function (data) {
                    swal("Good job!", "Successfully Deleted!", "success");
                    $('#lead').DataTable().ajax.reload();


                }

            })


        });
});


$(document).on('click', '.leadcomplete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure, you want to change the status to Complete? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function () {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/lead-update',
                type: "post",

                data: {
                    id: id,
                    status: 'complete'
                },
                success: function (data) {
                    swal("Good job!", "Successfully Completed!", "success");
                    $('#lead').DataTable().ajax.reload();


                }

            })


        });
});


$(document).on('click', '.leadpending', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure, you want to change the status to Pending?? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function () {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/lead-update',
                type: "post",

                data: {
                    id: id,
                    status: 'pending'
                },
                success: function (data) {
                    swal("Good job!", "Successfully decativated!", "success");
                    $('#lead').DataTable().ajax.reload();



                }

            })


        });
});

$(document).on('click', '.deactivatelist', function (e) {
    e.preventDefault();
    var username = $(this).data('id');
    swal({
            title: "Are you sure? ",
            type: "error",
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function () {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/userprofiles_deactivate',

                type: "post",

                data: {
                    username: username
                },
                success: function (data) {
                    swal("Good job!", "Successfully decativated!", "success");
                    $('#users-list-table').DataTable().ajax.reload();



                }

            })


        });
});





//shilpa-end


/* campaign js */

$(document).ready(function () {

    $('#campaign-date-time').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

    $('#campaign-email').datepicker({
        height: 300,
        format: "yyyy-mm-dd",
        minHeight: 300,
    });
});






var FileUpload = function () {
    var _componentFileUpload = function () {
        if (!$().fileinput) {
            console.warn('Warning - fileinput.min.js is not loaded.');
            return;
        }
        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };

        //
        // Basic example
        //

        $('.file-input').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });





    };

    return {
        init: function () {
            _componentFileUpload();
        }
    }
}();

// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    FileUpload.init();
});


if ($(".steps-planpurchase").length) {
    $(".steps-planpurchase").parsley();

    $(".steps-planpurchase").steps({

        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) {
                return true;
            }
            if (currentIndex < newIndex) {
                // To remove error styles
                $(".steps-planpurchase").find(".body:eq(" + newIndex + ") label.error").remove();
                $(".steps-planpurchase").find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            var validateForm = $(".steps-planpurchase").parsley().whenValidate({
                group: 'block-' + currentIndex
            });
            validateForm.then(function () {}, function () {});
            if (validateForm.state() === "resolved") {
                return true;
            }


        },
        onStepChanged: function (event, currentIndex, priorIndex) {

        },
        onFinishing: function (event, currentIndex) {
            $(".steps-planpurchase").submit();
        },
        onFinished: function (event, currentIndex) {
            $(".steps-planpurchase").submit();
        }
    });
}


if ($(".steps-planpurchase").length) {

    $('.steps-plan-payment').click(function (e) {
        $('input[name="steps_plan_payment"]').val($(this).attr('data-payment'));
        if ($(this).attr('data-payment') == 'cheque' || $(this).attr('data-payment') == 'paypal' || $(this).attr('data-payment') == 'bitaps' || $(this).attr('data-payment') == 'skrill' || $(this).attr('data-payment') == 'authorize' || $(this).attr('data-payment') == 'ipaygh' || $(this).attr('data-payment') == 'rave') {
            $(".steps-planpurchase a[href='#finish']").show();
        } else {
            $(".steps-planpurchase a[href='#finish']").hide();
        }
    })

    $('input[name="plan"]').css("display", "none");

    $('.ribbon-container').css("display", "none");

    $("input").on("click", function () {

        $('.ribbon-container').css("display", "none");
        $('.' + $('input[name="plan"]:checked').attr('badge-class')).css("display", "block");
        $('.table-vouher-payment').find("td span.remaining").html($('input[name="plan"]:checked').attr('plan-amount'));
    });
}


if ($(".table-vouher-payment").length) {

    voucherObj = [];



    $(document).on('click', '.validatevoucher', function (e) {

        totalamount = $('input[name="plan"]:checked').attr('plan-amount');
        balanceamount = totalamount;

        $(this).html('Validating please wait <i class="icon-spinner2 spinner"></i>').prop('disabled', true);
        validVoucher = true;
        $.each(voucherObj, function (i, obj) {

            balanceamount = balanceamount - obj.balance_amount;

            if (obj.voucher_code === $('.validatevoucher').closest('tr').find("td input:text").val()) {
                alert('Voucher already used, please use a new voucher');
                $('.validatevoucher').html('Validate').prop('disabled', false);
                validVoucher = false;
                return false;
            }
        });

        if (validVoucher) {

            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + "/voucher_validate/" + $(this).closest('tr').find("td input:text").val(),
                dataType: "json",
                type: "GET",
                data: "{balance:" + balanceamount + "}",
                success: onVoucherRecieveSuccess,
                error: onVoucherRecieveError
            });

        }

        function onVoucherRecieveSuccess(data) {
            if (!data['error']) {
                item = {}
                item["voucher_code"] = data['voucher_code'];
                item["balance_amount"] = data['balance_amount'];
                voucherObj.push(item);

                // balanceamount = parseInt(balanceamount) - parseInt(data['balance_amount']);

                // if(balanceamount <= 0){
                //     balanceamount = 0;
                // }



                //  $('.validatevoucher').closest('tr').find("td span.amount").html(data['balance_amount']);
                // $('.validatevoucher').closest('tr').find("td span.balance").html(data['balance_amount']);


                if (data['balance_amount'] > balanceamount) {
                    amount = balanceamount;
                    balance = data['balance_amount'] - balanceamount;
                    newbalance = 0;
                } else if (data['balance_amount'] < balanceamount) {
                    amount = data['balance_amount'];
                    balance = 0;
                    newbalance = balanceamount - data['balance_amount'];
                } else {
                    amount = balanceamount;
                    balance = 0;
                    newbalance = 0;
                }



                $('.validatevoucher').closest('tr').find("td span.amount").html(amount);
                $('.validatevoucher').closest('tr').find("td span.balance").html(balance);
                // $('.validatevoucher').closest('tr').find("td span.remaining").html(balanceamount);
                $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');
                var markup = "<tr>" +
                    '<td>1</td>' +
                    "<td><input type='text' name='voucher[]' class='form-control'></td>" +
                    "<td><span class='amount'></span></td><td><span class='balance'></span></td>" +
                    "<td><span class='remaining'>" + newbalance + "</span></td> " +
                    "<td class='td-validate-voucher'><button class='btn btn-info validatevoucher'  onclick='return false;' >Validate</button></td>" +
                    "</tr>";
                if (newbalance > 0) {
                    $(".table-vouher-payment tbody").append(markup);
                    // $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');                             
                } else {
                    $(".steps-planpurchase a[href='#finish']").show();
                }

            } else {
                alert(data['error']);
                $('.validatevoucher').html('Validate').prop('disabled', false);
            }
        }

        function onVoucherRecieveError(data) {
            alert(data['error']);
        }


    });




}



// use kb article

if ($('#kb-article-table-user').length) {
    $(document).ready(function () {
        oTable = $('#kb-article-table-user').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/helpdesk/kb/articles/data/",
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "publish_time"
                },
                {
                    "data": "action"
                }
            ],

            "fnDrawCallback": function (oSettings) {}
        });
    });

    function reloadDataTable() {
        oTable.ajax.reload();
    }
}
// use tickets 

if ($('#user-ticket-table').length) {
    var priority = $('#user-ticket-table').attr('data-priority');
    var department = $('#user-ticket-table').attr('data-department');
    var category = $('#user-ticket-table').attr('data-category');
    var status = $('#user-ticket-table').attr('data-status');
    var overdue = $('#user-ticket-table').attr('data-overdue');
    var deleted = $('#user-ticket-table').attr('data-deleted');
    var pass1 = $("#ticket-number").val();
    var pass2 = $('#user-ticket-table').attr('data-ticketnumber');
    $(document).ready(function () {
        oTable = $('#user-ticket-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/helpdesk/tickets/data/?priority=" + priority + "&department=" + department + "&category=" + category + "&status=" + status + "&overdue=" + overdue + "&deleted=" + deleted + "&ticketnum=" + pass2,
            "columns": [{
                    "data": "ticket_number"
                },
                {
                    "data": "user_id"
                },
                {
                    "data": "subject"
                },
                {
                    "data": "status"
                },
                {
                    "data": "priority"
                },
                {
                    "data": "department"
                },
                {
                    "data": "action"
                }
            ],

            "fnDrawCallback": function (oSettings) {}
        });
    });

    function reloadDataTable() {
        oTable.ajax.reload();
    }
}

if ($('.campaign-list').length) {

    $('.campaign-list').on('click', '.changecampaignstatus', function (e) {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var this_context = $(this).closest('.statusdropbtn');
        buttonClasses = [];
        buttonClasses = {
            'complete': 'bg-danger-400',
            'pending': 'bg-success-400',
        };
        swal({
            title: "",
            text: "Change status?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + status,
            closeOnConfirm: true
        }, function () {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/lists/change-status/', {
                id: id,
                status: status
            }, function (response) {
                this_context.parent().find('.statusname').text(status);
                this_context.parent().find('.statusname').removeClass('');
                this_context.parent().find('.statusname').attr('class', 'label  statusname dropdown-toggle ' + buttonClasses[status]);
                this_context.parent().find('.statusdrop').removeClass('');
                this_context.parent().find('.statusdrop').attr('class', 'statusdrop btn-xs btn dropdown-toggle ' + buttonClasses[status]);
                // console.log(buttonClasses[status]);
            });
        });
    });


}


if ($('#contact-lists-table').length) {
    $(document).ready(function () {
        oTable = $('#contact-lists-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contactlist/data/",
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "description"
                },
                {
                    "data": "action"
                }
            ],
            "fnDrawCallback": function (oSettings) {}
        });
    });

    function reloadDataTable() {
        oTable.ajax.reload();
    }

    $('.content').on('click', '.btn-delete-contactlist', function (e) {
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "All related contacts  will be deleted from this group",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contactlist/destroy/' + id;
        });
    });
}


if ($('#lead').length) {
    $(document).ready(function () {
        oTable = $('#lead').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/lead/data",
            "columns": [{
                    "data": 'rownum',
                    "searchable": false
                },
                {
                    "data": "username"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "mobile"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "status"
                },
                {
                    "data": "actions"
                }

            ],
            "fnDrawCallback": function (oSettings) {}
        });
    });
}



// if ($('#contact-list-table').length) {
//     $(document).ready(function() {
//        var id = $("[name='id']").val();
//            oTable = $('#contact-list-table').DataTable({
//                "processing": true,
//                "serverSide": true,
//                "ordering": false,
//                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contactslist/"+id,
//                "columns": [
//                    { "data": "firstname" },
//                    { "data": "lastname" },
//                    { "data": "email" },
//                    { "data": "mobile" },
//                    { "data": "address" },
//                    { "data": "created_at" },
//                    { "data": "action" }
//                ],
//                "fnDrawCallback": function(oSettings) {}
//            });
//        });
//        function reloadDataTable() {
//            oTable.ajax.reload();
//        } 

//    $('.content').on('click', '.btn-delete-contactist', function(e) {
//        var id = $(this).data('id');       
//        swal({
//            title: "Are you sure?",
//            text: "All related contacts  will be deleted from this group",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonClass: "btn-danger",
//            confirmButtonText: "Yes, delete it!",
//            closeOnConfirm: false
//        }, function() {
//            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contactlist/destroy/' + id;
//        });
//    }); 
// }


if ($('.map-choropleth').length) {

    $.get(CLOUDMLMSOFTWARE.siteUrl + "/ajax/globalview", function (data) {
        // console.log(data);
        $('.map-choropleth').vectorMap({
            map: 'world_mill_en',
            backgroundColor: '#fff',
            regionStyle: {
                initial: {
                    fill: '#4c4f5d',
                    stroke: 'none',
                }
            },

            series: {
                regions: [{
                    values: data,
                    scale: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial'
                }],
            },
            onRegionLabelShow: function (e, el, code) {
                
                var ccode = code.toLowerCase();
                if (typeof data[code] === 'undefined') {
                    el.html(`
                        <div class="country-popup">
                            <div class="d-flex">
                                <div class="flag-icon flag-icon-`+ccode+`" style="width: 20px;height: 20px;"></div>
                                <div class="country-name ml-2 font-weight-bold">`+ el.html() +`</div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="map-info-special">No users registerd from `+el.html()+`</div>
                            </div>
                        </div>                   
                    `);
                } else {
                    
                    el.html(`
                        
                    <div class="country-popup">
                        <div class="d-flex">
                            <div class="flag-icon flag-icon-`+ccode+`" style="width: 20px;height: 20px;"></div>
                            <div class="country-name ml-2 font-weight-bold">`+ el.html() +`</div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="map-info-special">Registered users : <b>`+data[code]+` </b></div>
                        </div>
                    </div>  


                    `
                    
                    );
                }

            }
        });

    });
}

if ($('.map-choropleth-user').length) {

    $.get(CLOUDMLMSOFTWARE.siteUrl + "/ajax/globalview_user", function (data) {

        $('.map-choropleth-user').vectorMap({
            map: 'world_mill_en',
            backgroundColor: '#fff',
            regionStyle: {
                initial: {
                    fill: '#4c4f5d',
                    stroke: 'none',
                }
            },

            series: {
                regions: [{
                    values: data,
                    scale: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial'
                }],
            },
            onRegionLabelShow: function (e, el, code) {
                if (typeof data[code] === 'undefined') {
                    el.html(el.html());
                } else {
                    el.html(el.html() + '<br>' + 'User  - ' + data[code]);
                }

            }
        });

    });
}



//UTILS
//BOOTSTRAP TABS PERSISTANT

const anchor = window.location.hash;
$(`a[href="${anchor}"]`).tab('show');



$('.content').on('click', '.btn-delete-tickets', function (e) {
    var id = $(this).data('id');
    var this_context = $(this);
    swal({
        title: "Are you sure?",
        text: "This ticket will be deleted!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/user/helpdesk/ticket/delete/' + id;
    });
});

//online store dashboard graphs

// Basic area chart area_basic


if ($('#area_basic').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/categorysale.json', function (data) {
        sales_graph_dates(data);
    });
}

function sales_graph_dates(data) {
    var dom = document.getElementById("area_basic");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'solid',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
            formatter: function (params) {
                return params[0].name + ': ' + params[0].value;
            }
        },
        legend: {
            data: ['Line', 'Bar', 'Dotted', 'Bubble'],
            animation: true,
            textStyle: {
                color: '#ccc'
            },
            selectedMode: 'single',
            top: 10,
            itemGap: 5,
            backgroundColor: 'rgb(243,243,243)',
            borderRadius: 5
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Line',
            type: 'line',
            smooth: true,
            // symbol: 'circle',
            // effect :{
            //     color :'#000'
            // },
            sampling: 'average',
            color: ['#58b358'],
            itemStyle: {
                normal: {
                    color: 'rgba(4, 177, 255, 0.9411764705882353)'
                }
            },
            lineStyle: {
                normal: {
                    color: '#3e84f7',
                    width: 3,
                    type: 'solid'
                },
                xAxisIndex: 1,
                yAxisIndex: 1,
            },
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(59, 132, 251, 0.22)'
                    }, {
                        offset: 1,
                        color: 'rgba(59, 132, 251, 0.5803921568627451)'
                    }])
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }, {
            name: 'Bar',
            type: 'bar',
            barWidth: 10,
            itemStyle: {
                normal: {
                    barBorderRadius: 5,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#14c8d4'
                    }, {
                        offset: 1,
                        color: '#43eec6'
                    }])
                }
            },
            barWidth: 2,
            data: values
        }, {
            name: 'Dotted',
            type: 'pictorialBar',
            symbol: 'rect',
            itemStyle: {
                normal: {
                    color: 'rgba(102, 187, 106, 0.72)',
                    opacity: 0.8
                }
            },
            symbolRepeat: true,
            symbolSize: [2, 1],
            symbolMargin: 1,
            z: -10,
            data: values
        }, {
            name: 'Bubble',
            type: 'scatter',
            symbolSize: function (values) {
                return Math.sqrt(values * 50);
            },
            label: {
                emphasis: {
                    show: true,
                    formatter: function (param) {
                        return param.data[3];
                    },
                    position: 'top'
                }
            },
            itemStyle: {
                normal: {
                    shadowBlur: 10,
                    shadowColor: 'rgba(120, 36, 50, 0.5)',
                    shadowOffsetY: 5,
                    // color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    //     offset: 0,
                    //     color: 'rgba(59, 132, 251, 0.7)'
                    // }, {
                    //     offset: 1,
                    //     color: 'rgba(59, 132, 251, 0.9)'
                    // }])
                    color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                        offset: 0,
                        color: 'rgb(59, 132, 251)'
                    }, {
                        offset: 1,
                        color: 'rgb(59, 132, 251)'
                    }])
                }
            },
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}



if ($('#pie_donut').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/category.json', function (data) {
        console.log(data);
        categorySaleGraph(data);
    });
}

function categorySaleGraph(datas) {

    var pie_donut_element = document.getElementById('pie_donut');

    // Basic donut chart
    if (pie_donut_element) {

        // Initialize chart
        var pie_donut = echarts.init(pie_donut_element);

        console.log(datas);
        console.log(datas.length);
        //
        // Chart config
        //




        // Options
        pie_donut.setOption({

            // Colors
            color: [
                '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
            ],

            // Global text styles
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 13
            },

            // Add title
            title: {
                text: 'Category Product Sales',
                subtext: 'Product sale information',
                left: 'center',
                textStyle: {
                    fontSize: 17,
                    fontWeight: 500
                },
                subtextStyle: {
                    fontSize: 12
                }
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                backgroundColor: 'rgba(0,0,0,0.75)',
                padding: [10, 15],
                textStyle: {
                    fontSize: 13,
                    fontFamily: 'Roboto, sans-serif'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            // Add legend
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['IE', 'Opera', 'Safari', 'Firefox', 'Chrome'],
                itemHeight: 8,
                itemWidth: 8
            },

            // Add series
            series: [{
                name: 'sales',
                type: 'pie',
                radius: ['50%', '70%'],
                center: ['50%', '57.5%'],
                itemStyle: {
                    normal: {
                        borderWidth: 1,
                        borderColor: '#fff'
                    }
                },

                data: datas
            }]
        });
    }
}
// Resize function

/*  var triggerChartResize = function() {
pie_donut_element && pie_donut.resize();

};*/

window.onresize = function () {
    $("#pie_donut").each(function () {
        var id = $(this).attr('_echarts_instance_');
        window.echarts.getInstanceById(id).resize();
    });
};


//voucher registeration payment
$(document).ready(function () {
    if ($(".steps-validation").length) {
        $("#resulttable").hide();



        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");

            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    }
});
//validation
if ($(".steps-validation").length) {

    $('.bhoechie-tab-content').click(function (e) {

        $('input[name="col-lg-9 col-md-9 col-sm-9 col-xs-9"]').val($(this).attr('payment'));
        if ($(this).attr('payment') == 'cheque' || $(this).attr('payment') == 'ewallet') {
            $(".steps-validation a[href='#finish']").show();
        } else {
            $(".steps-validation a[href='#finish']").hide();
            $("#resulttable").hide();

        }
    })

    $("input").on("click", function () {
        // var product = document.getElementById("package");
        var product = document.getElementById("joiningfee");
        // var totalamount =  product.options[product.selectedIndex].getAttribute('amount');
        var totalamount = product.getAttribute('amount');
        console.log(totalamount);
        // $('.table-vouher-regpayment').find("td span.remaining").html( product.options[product.selectedIndex].getAttribute('amount'));
        $('.table-vouher-regpayment').find("td span.remaining").html(product.getAttribute('amount'));
    });


}





if ($(".table-vouher-regpayment").length) {

    voucherObj = [];

    $(document).on('click', '.validatevoucher', function (e) {


        var product = document.getElementById("joiningfee");
        console.log(product);

        var totalamount = product.getAttribute('amount');

        console.log(totalamount);




        balanceamount = totalamount;

        $(this).html('Validating please wait <i class="icon-spinner2 spinner"></i>').prop('disabled', true);
        validVoucher = true;

        $.each(voucherObj, function (i, obj) {

            balanceamount = balanceamount - obj.balance_amount;

            if (obj.voucher_code === $('.validatevoucher').closest('tr').find("td input:text").val()) {
                alert('Voucher already used, please use a new voucher');
                $('.validatevoucher').html('Validate').prop('disabled', false);
                validVoucher = false;
                return false;
            }
        });

        if (validVoucher) {

            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + "/voucher_validate/" + $(this).closest('tr').find("td input:text").val(),
                dataType: "json",
                type: "GET",
                data: "{balance:" + balanceamount + "}",
                success: onVoucherRecieveSuccessReg,
                error: onVoucherRecieveError
            });

        }

        function onVoucherRecieveSuccessReg(data) {

            // console.log(data);
            if (!data['error']) {
                item = {}
                item["voucher_code"] = data['voucher_code'];
                item["balance_amount"] = data['balance_amount'];
                voucherObj.push(item);

                if (data['balance_amount'] > balanceamount) {
                    amount = balanceamount;
                    balance = data['balance_amount'] - balanceamount;
                    newbalance = 0;
                } else if (data['balance_amount'] < balanceamount) {
                    amount = data['balance_amount'];
                    balance = 0;
                    newbalance = balanceamount - data['balance_amount'];
                } else {
                    amount = balanceamount;
                    balance = 0;
                    newbalance = 0;
                }



                $('.validatevoucher').closest('tr').find("td span.amount").html(amount);
                $('.validatevoucher').closest('tr').find("td span.balance").html(balance);
                // $('.validatevoucher').closest('tr').find("td span.remaining").html(balanceamount);
                $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');
                var markup = "<tr>" +
                    '<td>1</td>' +
                    "<td><input type='text' name='voucher[]' class='form-control'></td>" +
                    "<td><span class='amount'></span></td><td><span class='balance'></span></td>" +
                    "<td><span class='remaining'>" + newbalance + "</span></td> " +
                    "<td class='td-validate-voucher'><button class='btn btn-info validatevoucher'  onclick='return false;' >Validate</button></td>" +
                    "</tr>";
                if (newbalance > 0) {
                    $(".table-vouher-regpayment tbody").append(markup);
                    // $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');                             
                } else {

                    $("#resulttable").show();

                }

            } else {
                alert(data['error']);
                $('.validatevoucher').html('Validate').prop('disabled', false);
            }
        }

        function onVoucherRecieveError(data) {
            alert(data['error']);
        }


    });


}


$('.login100-form').submit(function () {
    $("input[type='submit']", this)
        .val("Please Wait...")
        .attr('disabled', 'disabled');

    return true;
});



$('.metric .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.metric');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json?period=' + range, function (data) {
        users_join_bar(data);
        var total = 0;
        var i = 0;
        for (i = 0; i < data.length; i++) {
            total += data[i].value;
        }
        $metric.find('.count').html(total);
    });
});
$('.metric_user .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.metric_user');
    $metric.find('.total').html('<i class="icon-spinners fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_mnth.json?period=' + range, function (data) {
        // users_join_bar(data);
        console.log(data);
        var total_sale_amount = data.total_sale_amount;
        var sale_count = data.sale_count;
        var total_pur_amount = data.total_pur_amount;
        var pur_count = data.pur_count;
        var income = data.incom;
        var payout = data.payout;
        var groupsale = data.groupsale;
        var cashback = data.cashback;
         
         document.getElementById("total_users_bar_total").textContent="MYR " + total_sale_amount;
         document.getElementById("total_users_bar_count").textContent=sale_count+" ";
         document.getElementById("total_users_pur_total").textContent="MYR " + total_pur_amount;
         document.getElementById("total_users_pur_count").textContent=pur_count+" ";
         document.getElementById("total_users_income_total").textContent="MYR " + income;
         document.getElementById("total_users_payout_total").textContent="MYR " + payout;
         document.getElementById("total_users_grp_sale_total").textContent=groupsale + "set";
         document.getElementById("total_users_cashback_total").textContent=cashback ;
    });
});
// $('.metric_user .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     var $metric = $(this).closest('.metric_user');
//     $metric.find('.total').html('<i class="icon-spinners fa-spin"></i>');
//     console.log($metric);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_sales_mnth.json?period=' + range, function (data) {
//         // users_join_bar(data);
//         console.log(data);
//         var total = data.total;
//         var count = data.count;
         
//          document.getElementById("total_users_bar_total").textContent="MYR " + total;
//           document.getElementById("total_users_bar_count").textContent=count+" ";
//     });
// });
// $('.metric_user_pur .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_pur_mnth.json?period=' + range, function (data) {
//         // users_join_bar(data);
//         console.log(data);
//         var total = data.total;
//         var count = data.count;
         
//          document.getElementById("total_users_pur_total").textContent="MYR " + total;
//           document.getElementById("total_users_pur_count").textContent=count+" ";
//     });
// });
// $('.metric_user_income .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_income_mnth.json?period=' + range, function (data) {
//         console.log(data);
//         var income = data.incom;
        
         
//          document.getElementById("total_users_income_total").textContent="MYR " + income;
         
//     });
// });
// $('.metric_payout .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_payout_mnth.json?period=' + range, function (data) {
      
//         var payout = data.payout;
        
         
//          document.getElementById("total_users_payout_total").textContent="MYR " + payout;
         
//     });
// });
// $('.metric_grp_sale .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_grp_sale_mnth.json?period=' + range, function (data) {
      
//         var groupsale = data.groupsale;
        
         
//          document.getElementById("total_users_grp_sale_total").textContent=groupsale + "set";
         
//     });
// });
// $('.metric_cashback .dropdown .range').on('click', function () {
//     var range = $(this).data("range");
//     console.log(range);
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_cashback_mnth.json?period=' + range, function (data) {
      
//         var cashback = data.cashback;
        
         
//          document.getElementById("total_users_cashback_total").textContent=cashback ;
         
//     });
// });
$('.metric .dropdown .range').on('click', function () {count
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.metric');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json?period=' + range, function (data) {
        users_join_bar(data);
        var total = 0;
        var i = 0;
        for (i = 0; i < data.length; i++) {
            total += data[i].value;
        }
        $metric.find('.count').html(total);
    });
});
$('.metric .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.metric');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json?period=' + range, function (data) {
        users_join_bar(data);
        var total = 0;
        var i = 0;
        for (i = 0; i < data.length; i++) {
            total += data[i].value;
        }
        $metric.find('.count').html(total);
    });
});
$('.metric_user_level .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/users_level.json?period=' + range, function (data) {
        console.log(data);
        var level = data.level;
        
         
         document.getElementById("total_users_level_total").textContent="MYR " + level;
         
    });
});
$('.weeklyMaintainMembersIncome .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.weeklyMaintainMembersIncome');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/weekly-maintain.json?period=' + range, function (data) {
        $metric.find('.weeklyMaintainMembersIncome').html(data);
    });
});
$('.leadership_pool .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.leadership_pool');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/leadership_pool.json?period=' + range, function (data) {
        $metric.find('.leadership_pool').html(data);
    });
});
$('.company_pool .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.company_pool');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/company_pool.json?period=' + range, function (data) {
        $metric.find('.company_pool').html(data);
    });
});
$('.international_pool .dropdown .range').on('click', function () {
    var range = $(this).data("range");
    console.log(range);
    var $metric = $(this).closest('.international_pool');
    $metric.find('.count').html('<i class="icon-spinner2 fa-spin"></i>');
    console.log($metric);
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/international_pool.json?period=' + range, function (data) {
        $metric.find('.international_pool').html(data);
    });
});

// $('#dshbrd_crd_mem_select').on('change',function(){
//     var period = $('#dshbrd_crd_mem_select').select2("val");
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json?period='+period, function(data) {
//        users_join_bar(data);
//            var total = 0; 
//            var i = 0;
//            for (i = 0; i < data.length; i++) {  
//                total += data[i].value; 
//            }
//        $('body #total_users_bar_count').html(total)

//     }); 

// });


if ($('#users_join_bar').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json?period=year', function (data) {
        users_join_bar(data);
        var total = 0;
        var i = 0;
        for (i = 0; i < data.length; i++) {
            total += data[i].value;
        }
        $('body #total_users_bar_count').html(total)
    });
}


function users_join_bar(data) {
    var dom = document.getElementById("users_join_bar");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    // console.log(dates);
    option = {
        tooltip: {
            trigger: 'axis',
            backgroundColor: 'white',
            borderColor: '#76b6e7',
            borderWidth: 1,
            extraCssText: 'box-shadow: 0 2px 4px 0 rgba(0,0,0,0.05);',
            textStyle: {
                color: 'rgb(118, 182, 231)',
                fontWeight: 'bold'
            }
        },
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '20%',
            containLabel: false
        },
        xAxis: [{
            show: false,
            axisPointer: {
                type: "shadow",
                shadowStyle: {
                    color: "blue",
                    opacity: 0.05
                }
            },
            boundaryGap: false,
            data: dates
        }],
        yAxis: [{
            show: false,
            name: '',
            axisLine: {
                show: false
            },
            axisTick: {
                show: false
            },
            type: 'value',
            splitLine: {
                show: true,
                lineStyle: {
                    type: 'dashed'
                }
            },
        }],
        series: [{
            id: 'members-chart-1',
            name: 'Members',
            type: 'line',
            smooth: true,
            color: "#76b6e7",
            symbol: 'circle',
            symbolSize: '6',
            areaStyle: {
                opacity: 0.1,
                color: {
                    type: "linear",
                    x: 1,
                    y: 0,
                    x: 1,
                    y2: 1,
                    colorStops: [{
                        "offset": 0,
                        "color": "#76b6e7" //0% 
                    }, {
                        "offset": 1,
                        "color": "#76b6e7" // 100% 
                    }],
                    "globalCoord": false //  false
                }
            },
            data: values
        }]
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function () {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}

$('.totalincome .totalincome-dropdown .range').on('click', function () {
    var range = $(this).data("range");
    var total = $(this).closest('.totalincome');
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/totalincome-datas.json?period=' + range, function (data) {
        console.log(data);
          total.find('.incomedatavalue').html(data);       
      
    });
   
});

if ($('#all_request').length) {
        $(document).ready(function () {
            oTable = $('#all_request').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/allpayoutrequest/data",
                "columns": [{
                "data": 'rownum',
                "searchable": false
                }],
                "columnDefs": [{
                    "targets": 4,
                    "defaultContent": "-",
                    "targets": "_all",
                    "createdCell": function (td, cellData, rowData, row, col) {
                    }
                }],
                "columns": [{
                        "data": "rownum"
                    },
                    {
                        "data": "amount"
                    },
                
                    {
                        "data": "status"
                    },
                
                    {
                        "data": "released_date"
                    },
                    {
                        "data": "commissions"
                    }
                   
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
} 

if ($('#payout_details').length) {

        var payout_id="{{$payout_id}}";
        $(document).ready(function () {
            oTable = $('#payout_details').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],   
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/payout-details/data/"+payout_id,
                "columns": [{
                "data": 'rownum',
                "searchable": false
                }],
                "columnDefs": [{
                    "targets": 4,
                    "defaultContent": "-",
                    "targets": "_all",
                    "createdCell": function (td, cellData, rowData, row, col) {
                    }
                }],
                "columns": [{
                        "data": "rownum"
                    },
                    {
                        "data": "from_user"
                    },
                    {
                        "data": "payment_type"
                    },
                    {
                        "data": "total_amount"
                    },
                     {
                        "data": "request_date"
                    },  
                ],
                "fnDrawCallback": function (oSettings) {}
            });
        });
}
