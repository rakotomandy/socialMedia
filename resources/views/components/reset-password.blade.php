<div class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Reset Password</h2>

    <form action="{{ route('reset-password.post') }}" method="POST" class="space-y-5">
        @csrf
        <x-errors />
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">
      <!-- Email -->
      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">New Password</label>
        <input type="password" id="password" name="password" placeholder="Enter new password"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>
      <div>
        <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
        Reset Password
      </button>
    </form>
  </div>
</div>