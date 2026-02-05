<div class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Forgot Password</h2>

    <form action="{{ route('forgot-password.post') }}" method="POST" class="space-y-5">
        @csrf
      <!-- Email -->
      @error('email')
          <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
      @enderror
      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
        Verify Email
      </button>
    </form>
  </div>
</div>