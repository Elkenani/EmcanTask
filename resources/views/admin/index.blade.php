<x-home-master> <!-- inheriting everything from admin-master.blade.php -->

    @section('content')

    @if(auth()->user()->userHasRole('Admin'))

    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    @endif
    @endsection

</x-home-master>