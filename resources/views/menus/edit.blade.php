<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - SantapAja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Menu</h2>
            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                    <input type="text" name="name" value="{{ $menu->name }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" rows="4" required>{{ $menu->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $menu->price }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2">
                        <option value="Beverages" {{ $menu->category == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                        <option value="Snack" {{ $menu->category == 'Snack' ? 'selected' : '' }}>Snack</option>
                        <option value="Main Course" {{ $menu->category == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                        <!-- Tambahkan kategori lain jika diperlukan -->
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Menu (Opsional)</label>
                    <input type="file" name="image" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" accept="image/*">
                    @if($menu->image_url)
                        <img src="{{ $menu->image_url }}" alt="Current Image" class="w-32 h-32 object-cover mt-4 rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-600 transition duration-300">
                        Update Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
