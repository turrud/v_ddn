@php $editing = isset($aboutAward) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tanggal"
            label="Tanggal"
            :value="old('tanggal', ($editing ? $aboutAward->tanggal : ''))"
            maxlength="255"
            placeholder="Tanggal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="award1"
            label="Award1"
            :value="old('award1', ($editing ? $aboutAward->award1 : ''))"
            maxlength="255"
            placeholder="Award1"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="award2"
            label="Award2"
            :value="old('award2', ($editing ? $aboutAward->award2 : ''))"
            maxlength="255"
            placeholder="Award2"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="award3"
            label="Award3"
            :value="old('award3', ($editing ? $aboutAward->award3 : ''))"
            maxlength="255"
            placeholder="Award3"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="award4"
            label="Award4"
            :value="old('award4', ($editing ? $aboutAward->award4 : ''))"
            maxlength="255"
            placeholder="Award4"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="award5"
            label="Award5"
            :value="old('award5', ($editing ? $aboutAward->award5 : ''))"
            maxlength="255"
            placeholder="Award5"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $aboutAward->image ? \Storage::url($aboutAward->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
</div>
