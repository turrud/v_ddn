@php $editing = isset($contactPartner) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $contactPartner->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="brand"
            label="Brand"
            :value="old('brand', ($editing ? $contactPartner->brand : ''))"
            maxlength="255"
            placeholder="Brand"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="bidang_bisnis"
            label="Bidang Bisnis"
            :value="old('bidang_bisnis', ($editing ? $contactPartner->bidang_bisnis : ''))"
            maxlength="255"
            placeholder="Bidang Bisnis"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
