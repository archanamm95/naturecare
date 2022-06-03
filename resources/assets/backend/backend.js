/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./themes/limitless/global_assets/js/plugins/loaders/blockui.min');
window.PerfectScrollbar = require('./themes/limitless/global_assets/js/plugins/ui/perfect_scrollbar.min');

// require('./themes/limitless/global_assets/js/plugins/forms/styling/switchery.min');
// require('./themes/limitless/global_assets/js/plugins/forms/styling/uniform.min');
// require('./themes/limitless/global_assets/js/plugins/forms/selects/bootstrap_multiselect');
require('./themes/limitless/global_assets/js/plugins/extensions/cookie');
// require('./themes/limitless/global_assets/js/plugins/forms/selects/select2.min');
require('./themes/limitless/global_assets/js/plugins/forms/wizards/steps.min');
require('./themes/limitless/global_assets/js/plugins/forms/validation/validate.min');
require('./themes/limitless/global_assets/js/plugins/extensions/session_timeout.min.js');
require('./themes/limitless/global_assets/js/plugins/forms/inputs/passy.js');
require('./themes/limitless/global_assets/js/plugins/forms/inputs/maxlength.min.js');

//require('./themes/limitless/global_assets/js/plugins/forms/inputs/formatter.min.js');

// require('./themes/limitless/global_assets/js/plugins/media/cropper.min.js');
// require('./themes/limitless/global_assets/js/plugins/pickers/color/spectrum.js');
// require('./themes/limitless/global_assets/js/plugins/pickers/daterangepicker.js');
require('./themes/limitless/global_assets/js/plugins/tables/datatables/datatables.min.js');

require('./themes/limitless/global_assets/js/plugins/editors/summernote/summernote.min.js');


require('./themes/limitless/global_assets/js/plugins/forms/tags/tagsinput.min.js');
require('./themes/limitless/global_assets/js/plugins/forms/tags/tokenfield.min.js');
require('./themes/limitless/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js');

//require('./themes/limitless/global_assets/js/plugins/forms/editable/editable.min.js');
//require('./themes/limitless/global_assets/js/plugins/social/sharer/sharer.js');
//require('./themes/limitless/global_assets/js/plugins/fileinput/fileinput.min.js');

require('./themes/limitless/global_assets/js/plugins/maps/jvectormap/jvectormap.min.js');
require('./themes/limitless/global_assets/js/plugins/maps/jvectormap/map_files/world.js');
require('bootstrap-datepicker');

require('orgchart');
require('webui-popover');
require('jstree');
require("jquery-ui/ui/widgets/autocomplete");
require("codemirror");
require("print-this");
require('bootstrap-fileinput');


window.moment = require('moment');
window.moment.locale('ru');
window.daterangepicker = require('daterangepicker');


window.sweetalert = require('bootstrap-sweetalert');
window.parsley = require('parsleyjs');
window.locationpicker = require('jquery-locationpicker');
// window.WOW = require('wowjs').WOW;
window.mPageScroll2id = require('page-scroll-to-id').mPageScroll2id;
window.ladda = require('ladda');
window.spin = require('spin');
// window.Switchery = require('switchery');
window.bootstrapSwitch = require('bootstrap-switch');
window.PNotify = require('pnotify');
window.Bloodhound = require('bloodhound-js');
window.typeahead = require('typeahead');
window.Clipboard = require('clipboard');
// window.IntroJs = require('intro.js');
// window.countdown = require('jquery-countdown');
// window.html2canvas = require('html2canvas');
// window.jspdf = require('jspdf');

window.echarts = require('./extra-aslamise/plugins/echarts/echarts-en.min.js');
window.pagemap = require('./extra-aslamise/plugins/pagemap/pagemap.js');
require('./extra-aslamise/plugins/scrollup/jquery.scrollUp.min');
require('./extra-aslamise/plugins/sharer/sharer.js');
window.FlipClock = require('./extra-aslamise/plugins/flipclock/flipclock.min.js');
// window.bootstrapToggle = require('./extra-aslamise/plugins/bootstraptoggle/bootstrap-toggle.min.js');
// window.html2canvas = require('./extra-aslamise/plugins/html2canvas-old/html2canvas.min.js');
// window.jspdf = require('./extra-aslamise/plugins/jspdf/jspdf.min.js');


require('./themes/limitless/js/app.js');

// TODO :Splitting extra.js to simple pages and global script for better debugging
// require('./cloudmlm-global.js');
// require('./cloudmlm-pages-admin.js');
// require('./cloudmlm-pages-user.js');

require('./themes/limitless/js/extra.js');