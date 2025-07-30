<div class="container mx-auto px-4 py-8">
    @if ($user)
        <div class="flex items-center space-x-4">
            <img src="{{ $user['avatar_url'] }}" alt="{{ $user['name'] }}" class="w-24 h-24 rounded-full">
            <div>
                <h1 class="text-3xl font-bold">{{ $user['name'] }}</h1>
                <p class="text-gray-600">{{ $user['bio'] }}</p>
            </div>
        </div>

        @if (!empty($readmeSections))
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($readmeSections as $title => $content)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>
                        <ul class="list-disc list-inside">
                            @foreach ($content as $item)
                                <li class="text-gray-700">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Repositories</h2>
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($repos as $repo)
                    <li class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold"><a href="{{ $repo['html_url'] }}" class="text-blue-500 hover:underline">{{ $repo['name'] }}</a></h3>
                        <p class="text-gray-700 mt-2">{{ $repo['description'] }}</p>
                        <p class="text-gray-500 mt-4">Language: {{ $repo['language'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p>Loading...</p>
    @endif
</div>
