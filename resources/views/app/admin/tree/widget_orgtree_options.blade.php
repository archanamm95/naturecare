<!DOCTYPE html> 
<html> 

<head> 
    <title> 
    </title> 

    <!-- Include from the CDN -->
    <script src= 
"https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"> 
    </script> 

</head> 

<body> 

    <div id="output" style="visibility: hidden;    width: 0px;
    height: 0px;
    overflow: hidden;"></div> 

    <script type="text/javascript"> 

        // Define the function 
        // to screenshot the div 
        function takeshot() { 
            let div = 
                document.getElementById('treediv'); 

            // Use the html2canvas 
            // function to take a screenshot 
            // and append it 
            // to the output div 
            html2canvas(div).then( 
                function (canvas) { 
                    document 
                    .getElementById('output') 
                    .appendChild(canvas); 
                }) 
        } 
    </script> 
</body> 

</html> 

<a class="btn btn-default btn-md" data-popup="tooltip" data-original-title="{{trans('tree.export_png')}}" data-placement="bottom" id="btn_save_scrht" title="{{trans('tree.export_png')}}"  onclick="takeshot()">
    <i aria-hidden="true" class="icon-stack-picture">
    </i>
</a>

<a class="btn btn-default btnPrevious btn-md zoom-in" data-popup="tooltip" data-original-title="{{trans('tree.zoom_in')}}" data-placement="bottom" id="aZIn" title="{{trans('tree.zoom_in')}}">
    <i aria-hidden="true" class="icon-zoomin3">
    </i>
</a>
<a class="btn btn-default btnPrevious btn-md reset" data-popup="tooltip" data-original-title="{{trans('tree.reset')}}" data-placement="bottom" id="btn-restart-tree" title="{{trans('tree.reset')}}">
    <i aria-hidden="true" class="icon-reset">
    </i>
</a>
<a class="btn btn-default btnNext btn-md zoom-out" data-popup="tooltip" data-original-title="{{trans('tree.zoom_out')}}" data-placement="bottom" id="aZOut" title="{{trans('tree.zoom_out')}}">
    <i aria-hidden="true" class="icon-zoomout3">
    </i>
</a>
<!-- <a class="btn btn-default btnNext btn-md" data-popup="tooltip" data-original-title="Switch vertical" data-placement="bottom" id="btn_l2r_tree" title="Switch left to right view">
    <i aria-hidden="true" class="icon-flip-vertical3">
    </i>
</a>
<a class="btn btn-default btnNext btn-md" data-popup="tooltip" data-original-title="Switch Horizontal" data-placement="bottom" id="btn_vertical_tree_switch" title="Switch to vertical view">
    <i aria-hidden="true" class="icon-flip-horizontal2">
    </i>
</a>
<a class="btn btn-default btnNext btn-md" data-popup="tooltip" data-original-title="Switch vertical" data-placement="bottom" id="btn_r2l_tree" title="Switch right to left view">
    <i aria-hidden="true" class="icon-flip-vertical3">
    </i>
</a> -->