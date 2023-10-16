@php $editing = isset($aboutEvent) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $aboutEvent->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tanggal"
            label="Tanggal"
            :value="old('tanggal', ($editing ? $aboutEvent->tanggal : ''))"
            maxlength="255"
            placeholder="Tanggal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="lokasi"
            label="Lokasi"
            :value="old('lokasi', ($editing ? $aboutEvent->lokasi : ''))"
            maxlength="255"
            placeholder="Lokasi"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
