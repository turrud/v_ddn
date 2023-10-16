@php $editing = isset($contactCourse) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $contactCourse->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="university"
            label="University"
            :value="old('university', ($editing ? $contactCourse->university : ''))"
            maxlength="255"
            placeholder="University"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="major"
            label="Major"
            :value="old('major', ($editing ? $contactCourse->major : ''))"
            maxlength="255"
            placeholder="Major"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="select_one" label="Select One">
            @php $selected = old('select_one', ($editing ? $contactCourse->select_one : '')) @endphp
            <option value="senin_selasa" {{ $selected == 'senin_selasa' ? 'selected' : '' }} >Senin-Selasa</option>
            <option value="rabu_kamis" {{ $selected == 'rabu_kamis' ? 'selected' : '' }} >Rabu-Kamis</option>
            <option value="jumat_sabtu" {{ $selected == 'jumat_sabtu' ? 'selected' : '' }} >Jum'at-Sabtu</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="time" label="Time">
            @php $selected = old('time', ($editing ? $contactCourse->time : '')) @endphp
            <option value="19.00_end" {{ $selected == '19.00_end' ? 'selected' : '' }} >19:00 - end</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $contactCourse->image ? \Storage::url($contactCourse->image) : '' }}')"
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
