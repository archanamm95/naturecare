<ul id="sitelanguages" class="animated fadeInLeft">
 <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <span class="lang-xs lang-lbl" lang="{{App::getLocale()}}"></span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                     @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        @endif

                        <li><a class="deutsch {{ $lang == App::getLocale() ? 'active' : '' }}" href="{{ route('lang.switch', $lang) }}"> <span class="lang-xs lang-lbl" lang="{{$language}}"></span></a></li>
                    @endforeach
                    </ul>
                </li>
     
</ul>
