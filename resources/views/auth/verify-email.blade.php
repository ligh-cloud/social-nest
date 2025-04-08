



    <div class="container mx-auto max-w-lg p-6 bg-white shadow-md rounded-lg mt-10">
        <h2 class="text-2xl font-bold text-center mb-4">Verify Your Email Address</h2>

        <p class="text-gray-700 text-center mb-4">
            Before accessing your account, please check your email for a verification link.
        </p>

        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <p class="text-gray-700 text-center mb-4">
            If you did not receive the email, click the button below to request another verification link.
        </p>

        <form method="POST" action="{{ route('verification.send') }}" class="text-center">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Resend Verification Email
            </button>
        </form>
    </div>

