  <ul class="nav nav-sidebar" data-nav-type="accordion">
        @foreach($primary_menu_items as $menuitem)
        <li class="nav-item {{set_active($menuitem->href)}}">
            <a class="nav-link" href="{{ $menuitem->href }}" class="nav-link active">                           
                <i class="icon-home4"></i>
                <span class="text" >{{ $menuitem->text }}</span>
            </a>
            @if(isset($menuitem->children))
                @include('app.admin.partials.submenu', ['menuitems' => $menuitem->children])
            @endif
        </li>
        @endforeach
    </ul>
