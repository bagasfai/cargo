{{-- Loading Spinner --}}
@if($loading)
    <svg class="animate-spin h-4 w-4 text-current"
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"/>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
    </svg>
@endif

{{-- Icon Left --}}
@if($iconLeft && !$loading)
    <i class="{{ $iconLeft }}"></i>
@endif

{{-- Label --}}
<span>{{ $slot }}</span>

{{-- Icon Right --}}
@if($iconRight && !$loading)
    <i class="{{ $iconRight }}"></i>
@endif
