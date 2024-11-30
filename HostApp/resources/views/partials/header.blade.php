<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="h-10">
        </a>
        <nav class="flex space-x-4">
            <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-blue-500">Home</a>
            <a href="{{ route('destinations') }}" class="text-gray-700 hover:text-blue-500">Destinations</a>
            <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-500">Contact</a>
        </nav>
    </div>
</header>
