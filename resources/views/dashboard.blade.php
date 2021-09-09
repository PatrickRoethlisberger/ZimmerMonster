<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @teammember
                    <h1>Teammember</h1>
                @else
                    <h1>Not Teammember</h1>
                @endteammember

                @client
                    <h1>Client</h1>
                @else
                    <h1>Not Client</h1>
                @endclient

                @adminMember
                    <h1>Admin</h1>
                @else
                    <h1>Not Admin</h1>
                @endadminMember

                @touristAssociationMember
                    <h1>Tourist Association</h1>
                @else
                    <h1>Not Tourist Association</h1>
                @endtouristAssociationMember

                @hotelMember
                    <h1>Hotel</h1>
                @else
                    <h1>Not Hotel</h1>
                @endhotelMember
            </div>
        </div>
    </div>
</x-app-layout>
