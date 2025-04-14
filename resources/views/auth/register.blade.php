<x-layout>
    <x-slot:heading>
        Register User
    </x-slot:heading>

    <form method="POST" action="/register">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-lable for="name">Name</x-form-lable>
                        <div class="mt-2">
                            <x-form-input name="name" id="name" placeholder="Shift leader" required></x-form-input>
                            <x-form-error name="name"></x-form-error>
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-lable for="email">Email</x-form-lable>
                        <div class="mt-2">
                            <x-form-input type="email" name="email" id="email" required></x-form-input>
                            <x-form-error name="email"></x-form-error>
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-lable for="password">Password</x-form-lable>
                        <div class="mt-2">
                            <x-form-input type="password" name="password" id="password" required></x-form-input>
                            <x-form-error name="password"></x-form-error>
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-lable for="password_confirmation">Confirm password</x-form-lable>
                        <div class="mt-2">
                            <x-form-input type="password" name="password_confirmation" id="password_confirmation" required></x-form-input>
                            <x-form-error name="password_confirmation"></x-form-error>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <x-form-button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</x-form-button>
        </div>
    </form>

</x-layout>
