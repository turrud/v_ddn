@php $editing = isset($home) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $home->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="text"
            label="Quote"
            :value="old('text', ($editing ? $home->text : ''))"
            maxlength="255"
            placeholder="Quote"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.url
            name="image"
            label="Video URL"
            :value="old('image', ($editing ? $home->image : ''))"
            maxlength="255"
            placeholder="Video URL"
        ></x-inputs.url>
    </x-inputs.group>
</div>
