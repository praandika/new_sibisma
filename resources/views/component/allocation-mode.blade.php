<x-jet-action-section>
    <x-slot name="title">
        {{ __('Allocation Mode') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Allocation mode allows you input frame number to stocks.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if (Auth::user()->allocation_tools == 'yes')
                {{ __('Allocation tools is active.') }}
            @else
                {{ __('Allocation tools is not active.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When allocation mode is enabled, you will posible to input stocks with frame number.') }}
            </p>
        </div>

        <div class="mt-5">
            @if (Auth::user()->allocation_tools == 'no')
                <form action="{{ url('update-allocation-mode/'.Auth::user()->id.'/yes') }}" method="post">
                    @csrf
                    <button type="submit" style="background-color: #1f2937; color: #fff; padding: 5px 15px; border-radius: 7px;">
                        {{ __('Enable') }}
                    </button>
                </form>
            @else
                <form action="{{ url('update-allocation-mode/'.Auth::user()->id.'/no') }}" method="post">
                    @csrf
                    <button type="submit" style="background-color: #1f2937; color: #fff; padding: 5px 15px; border-radius: 7px;">
                        {{ __('Disable') }}
                    </button>
                </form>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
