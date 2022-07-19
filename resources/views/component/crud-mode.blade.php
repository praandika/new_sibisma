<x-jet-action-section>
    <x-slot name="title">
        {{ __('Simple CRUD Mode') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change your input mode.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if (Auth::user()->crud == 'simple')
                {{ __('You have enabled simple mode.') }}
            @else
                {{ __('You have not enabled simple mode.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When simple mode is enabled, you will posible to input sale and out data without frame number.') }}
            </p>
        </div>

        <div class="mt-5">
            @if (Auth::user()->crud == 'normal')
                <form action="{{ url('update-crud/'.Auth::user()->id.'/simple') }}" method="post">
                    @csrf
                    <button type="submit" style="background-color: #1f2937; color: #fff; padding: 5px 15px; border-radius: 7px;">
                        {{ __('Enable') }}
                    </button>
                </form>
            @else
                <form action="{{ url('update-crud/'.Auth::user()->id.'/normal') }}" method="post">
                    @csrf
                    <button type="submit" style="background-color: #1f2937; color: #fff; padding: 5px 15px; border-radius: 7px;">
                        {{ __('Disable') }}
                    </button>
                </form>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
