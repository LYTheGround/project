<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu m-b-30">
            <ul>
                <li class="submenu btn-mobil">
                    <a href="#">
                        <img style="padding-bottom: 3px;"
                             src="{{ asset((app()->isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                             width="20"
                             alt=""> <span> {{__('pages.language.language')}}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;" id="lang-switcher">
                        <li><a href="#" data-lang="fr">{{ __('pages.language.fr') }}</a></li>
                        <li><a href="#" data-lang="fr">{{ __('pages.language.ar') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">Company</li>
                <li class="{{ (request()->is('token') || request()->is('token/*')) ? 'active' : '' }}">
                    <a href="{{ route('token.index') }}">{{ __('token.tokens') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
