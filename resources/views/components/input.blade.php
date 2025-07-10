@props([
    'name',
    'label',
    'required',
    'placeholder',
    'type' => 'text',
    'errorMessage' => null
])

<div class="text-black flex flex-col gap-0.5">
    <p class="text-gray-700 text-[14px] font-medium">{{ $label }} {{ $required ? '*' : '' }}</p>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
        @class([
            'border outline-none p-2 pl-3 rounded focus:border-blue-link invalid:border-red-500',
            'border-gray-300' => !$errorMessage,
            'border-red-300' => $errorMessage,
        ])>
    @if($errorMessage)
        <span class="text-red-500 text-[13px]">{{ $errorMessage }}</span>
    @endif
</div>
