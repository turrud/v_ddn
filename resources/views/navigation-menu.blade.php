<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-mark class="block h-9 w-auto" /> --}}
                        <img src="{{ asset('images/icon-logo/logo.png') }}" alt="logo" style="width: 1.7cm;height: 1.7cm;">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>



                    @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                        Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                    <x-nav-dropdown title="Apps" align="right" width="48">
                            @can('view-any', App\Models\Home::class)
                            <x-dropdown-link href="{{ route('homes.index') }}">
                            Home
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\News::class)
                            <x-dropdown-link href="{{ route('all-news.index') }}">
                            News
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AboutAward::class)
                            <x-dropdown-link href="{{ route('about-awards.index') }}">
                            About Award
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AboutClient::class)
                            <x-dropdown-link href="{{ route('about-clients.index') }}">
                            About Client
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AboutEvent::class)
                            <x-dropdown-link href="{{ route('about-events.index') }}">
                            About Event
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\AboutPeople::class)
                            <x-dropdown-link href="{{ route('all-about-people.index') }}">
                            About People
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactCourse::class)
                            <x-dropdown-link href="{{ route('contact-courses.index') }}">
                            Contact Course
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactDonation::class)
                            <x-dropdown-link href="{{ route('contact-donations.index') }}">
                            Contact Donation
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactFreelance::class)
                            <x-dropdown-link href="{{ route('contact-freelances.index') }}">
                            Contact Freelance
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactInvest::class)
                            <x-dropdown-link href="{{ route('contact-invests.index') }}">
                            Contact Invest
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactPartner::class)
                            <x-dropdown-link href="{{ route('contact-partners.index') }}">
                            Contact Partner
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ContactService::class)
                            <x-dropdown-link href="{{ route('contact-services.index') }}">
                            Contact Service
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceArchitecture::class)
                            <x-dropdown-link href="{{ route('service-architectures.index') }}">
                            Service Architecture
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceBoothDesign::class)
                            <x-dropdown-link href="{{ route('service-booth-designs.index') }}">
                            Service Booth Design
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceInteriorDesign::class)
                            <x-dropdown-link href="{{ route('service-interior-designs.index') }}">
                            Service Interior Design
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceInteriorPublic::class)
                            <x-dropdown-link href="{{ route('service-interior-publics.index') }}">
                            Service Interior Public
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceVirtualOffice::class)
                            <x-dropdown-link href="{{ route('service-virtual-offices.index') }}">
                            Service Virtual Office
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\ServiceWeddingDecoration::class)
                            <x-dropdown-link href="{{ route('service-wedding-decorations.index') }}">
                            Service Wedding Decoration
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Store3dArchitecture::class)
                            <x-dropdown-link href="{{ route('store3d-architectures.index') }}">
                            Store3d Architecture
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Store3dBooth::class)
                            <x-dropdown-link href="{{ route('store3d-booths.index') }}">
                            Store3d Booth
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\Store3dFurniture::class)
                            <x-dropdown-link href="{{ route('store3d-furnitures.index') }}">
                            Store3d Furniture
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\StoreDecoration::class)
                            <x-dropdown-link href="{{ route('store-decorations.index') }}">
                            Store Decoration
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\StoreFlorist::class)
                            <x-dropdown-link href="{{ route('store-florists.index') }}">
                            Store Florist
                            </x-dropdown-link>
                            @endcan
                            @can('view-any', App\Models\StoreFurniture::class)
                            <x-dropdown-link href="{{ route('store-furnitures.index') }}">
                            Store Furniture
                            </x-dropdown-link>
                            @endcan
                    </x-nav-dropdown>

                    <x-nav-dropdown title="Access Management" align="right" width="48">

                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <x-dropdown-link href="{{ route('roles.index') }}">Roles</x-dropdown-link>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <x-dropdown-link href="{{ route('permissions.index') }}">Permissions</x-dropdown-link>
                        @endcan

                    </x-nav-dropdown>
                    @endif
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

                @can('view-any', App\Models\Home::class)
                <x-responsive-nav-link href="{{ route('homes.index') }}">
                Home
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AboutAward::class)
                <x-responsive-nav-link href="{{ route('about-awards.index') }}">
                About Award
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AboutClient::class)
                <x-responsive-nav-link href="{{ route('about-clients.index') }}">
                About Client
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AboutEvent::class)
                <x-responsive-nav-link href="{{ route('about-events.index') }}">
                About Event
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AboutPeople::class)
                <x-responsive-nav-link href="{{ route('all-about-people.index') }}">
                About People
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactCourse::class)
                <x-responsive-nav-link href="{{ route('contact-courses.index') }}">
                Contact Course
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactDonation::class)
                <x-responsive-nav-link href="{{ route('contact-donations.index') }}">
                Contact Donation
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactFreelance::class)
                <x-responsive-nav-link href="{{ route('contact-freelances.index') }}">
                Contact Freelance
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactInvest::class)
                <x-responsive-nav-link href="{{ route('contact-invests.index') }}">
                Contact Invest
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactPartner::class)
                <x-responsive-nav-link href="{{ route('contact-partners.index') }}">
                Contact Partner
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContactService::class)
                <x-responsive-nav-link href="{{ route('contact-services.index') }}">
                Contact Service
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceArchitecture::class)
                <x-responsive-nav-link href="{{ route('service-architectures.index') }}">
                Service Architecture
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceBoothDesign::class)
                <x-responsive-nav-link href="{{ route('service-booth-designs.index') }}">
                Service Booth Design
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceInteriorDesign::class)
                <x-responsive-nav-link href="{{ route('service-interior-designs.index') }}">
                Service Interior Design
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceInteriorPublic::class)
                <x-responsive-nav-link href="{{ route('service-interior-publics.index') }}">
                Service Interior Public
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceVirtualOffice::class)
                <x-responsive-nav-link href="{{ route('service-virtual-offices.index') }}">
                Service Virtual Office
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ServiceWeddingDecoration::class)
                <x-responsive-nav-link href="{{ route('service-wedding-decorations.index') }}">
                Service Wedding Decoration
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Store3dArchitecture::class)
                <x-responsive-nav-link href="{{ route('store3d-architectures.index') }}">
                Store3d Architecture
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Store3dBooth::class)
                <x-responsive-nav-link href="{{ route('store3d-booths.index') }}">
                Store3d Booth
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Store3dFurniture::class)
                <x-responsive-nav-link href="{{ route('store3d-furnitures.index') }}">
                Store3d Furniture
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\StoreDecoration::class)
                <x-responsive-nav-link href="{{ route('store-decorations.index') }}">
                Store Decoration
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\StoreFlorist::class)
                <x-responsive-nav-link href="{{ route('store-florists.index') }}">
                Store Florist
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\StoreFurniture::class)
                <x-responsive-nav-link href="{{ route('store-furnitures.index') }}">
                Store Furniture
                </x-responsive-nav-link>
                @endcan

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))

                    @can('view-any', Spatie\Permission\Models\Role::class)
                    <x-responsive-nav-link href="{{ route('roles.index') }}">Roles</x-responsive-nav-link>
                    @endcan

                    @can('view-any', Spatie\Permission\Models\Permission::class)
                    <x-responsive-nav-link href="{{ route('permissions.index') }}">Permissions</x-responsive-nav-link>
                    @endcan

                @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
