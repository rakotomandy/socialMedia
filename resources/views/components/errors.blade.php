<ul>
    @foreach ($errors->all() as $error)
    <li class="text-red-500 text-sm mb-2 bg-gray-50 rounded-md">{{ $error }}</li>
    @endforeach
</ul>
