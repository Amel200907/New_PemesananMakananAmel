<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Menu - SantapAja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Menu Baru</h2>
            
            <!-- Display Success or Error Messages -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-200 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="mb-4 p-4 bg-red-200 text-red-800 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form for creating menu -->
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Menu -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" rows="4" required></textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" required>
                    @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2">
                        <option value="Beverages">Beverages</option>
                        <option value="Snack">Snack</option>
                        <option value="Main Course">Main Course</option>
                        <!-- Add more categories if needed -->
                    </select>
                    @error('category')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Gambar Menu -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Menu</label>
                    <input type="file" name="image" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-2" accept="image/*" required>
                    @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-600 transition duration-300">
                        Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
