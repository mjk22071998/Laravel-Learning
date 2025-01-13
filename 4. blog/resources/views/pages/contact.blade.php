<x-public-master>
    <div class="max-w-2xl mx-auto p-6 bg-slate-200 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Contact Us</h2>

        <form action="#" method="POST">
            <!-- Name -->
            <x-input name="name" id="name" type="text" label="Name" />

            <!-- Email -->
            <x-input name="email" id="email" type="email" label="Email" />

            <!-- Subject -->
            <x-input name="subject" id="subject" type="text" label="Subject" />

            <!-- Message -->
            <x-multiline-input name="message" id="message" rows="6" label="Your Message" />

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Send Message" type="submit" extraClass="mx-auto" />
            </div>
        </form>
    </div>

</x-public-master>
