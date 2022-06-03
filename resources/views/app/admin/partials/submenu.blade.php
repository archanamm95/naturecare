<ul class="sub-nav">
    @foreach($menuitems as $submenu)
        <li>
            <a href="{{ $submenu->href }}">{{ $submenu->text }}</a>
            @if (isset($submenu->children))
                @include('app.admin.partials.submenu', ['menuitems' => $submenu->children])
            @endif
        </li>
    @endforeach
</ul>