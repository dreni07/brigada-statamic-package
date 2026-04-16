@if($section->formHeading)
    <{{ $section->headingTag }} class="text-3xl font-bold mb-8">
        {{ $section->formHeading }}
    </{{ $section->headingTag }}>
@endif

<form method="POST" action="/!/forms/{{ $section->formHandle }}" class="space-y-6 max-w-lg">
    @csrf

    <div style="display: none;">
        <label for="winnie">Don't fill this out</label>
        <input type="text" name="winnie" id="winnie" value="">
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
        <input type="text" name="phone" id="phone"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <div>
        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
        <textarea name="message" id="message" rows="5" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
    </div>

    <button type="submit"
            class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors">
        Send Message
    </button>
</form>
