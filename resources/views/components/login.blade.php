<div class="bg-gray-100 flex-1 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Your Account</h2>

    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
        @csrf
      <!-- Email -->
      @error('email')
          <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
      @enderror
      @error('password')
          <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
      @enderror
      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('value') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" id="password" name="password" placeholder="********"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>

      <!-- Remember Me -->
      <div class="flex items-center justify-between">
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-600">
          <span class="text-gray-700">Remember me</span>
        </label>
        <a href="{{ route('forgotPassword') }}" class="text-blue-600 hover:underline text-sm">Forgot password?</a>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
        Login
      </button>
    </form>

    <!-- Signup Link -->
    <p class="mt-6 text-center text-gray-600">
      Don’t have an account?
      <a href="{{ route('signup') }}" class="text-blue-600 hover:underline">Sign up</a>
    </p>
  </div>

</div>