<div class="overflow-y-auto space-x-8 -my-px pb-2 flex">
    @adminMember
        <x-jet-nav-link href="{{ route('manage.equipment.index') }}" :active="request()->routeIs('manage.equipment.index')">
            {{ __('Einrichtungen') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('manage.bedtype.index') }}" :active="request()->routeIs('manage.bedtype.index')">
            {{ __('Betten') }}
        </x-jet-nav-link>
        {{-- <x-jet-nav-link href="{{ route('manage.bedtype.index') }}" :active="request()->routeIs('manage.bedtype.index')">
            {{ __('Better') }}
        </x-jet-nav-link> --}}
        <x-jet-nav-link href="{{ route('manage.touristAssociation.index') }}" :active="request()->routeIs('manage.touristAssociation.index')">
            {{ __('Verkehrsvereine') }}
        </x-jet-nav-link>
    @else
        @touristAssociationMember
            <x-jet-nav-link href="{{ route('manage.touristAssociation.index') }}" :active="request()->routeIs('manage.touristAssociation.index')">
                {{ __('Verkehrsverein verwalten') }}
            </x-jet-nav-link>
        @endtouristAssociationMember
    @endadminMember
    @touristAssociationMember
        <x-jet-nav-link href="{{ route('manage.hotel.index') }}" :active="request()->routeIs('manage.hotel.index')">
            {{ __('Hotels') }}
        </x-jet-nav-link>
    @else
        <x-jet-nav-link href="{{ route('manage.hotel.index') }}" :active="request()->routeIs('manage.hotel.index')">
            {{ __('Hotel verwalten') }}
        </x-jet-nav-link>
    @endtouristAssociationMember
</div>
