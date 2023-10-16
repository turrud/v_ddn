@php $editing = isset($contactService) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="business_need" label="Business Need">
            @php $selected = old('business_need', ($editing ? $contactService->business_need : '')) @endphp
            <option value="design_build" {{ $selected == 'design_build' ? 'selected' : '' }} >Design & Build</option>
            <option value="furniture_only" {{ $selected == 'furniture_only' ? 'selected' : '' }} >Furniture only</option>
            <option value="design_only" {{ $selected == 'design_only' ? 'selected' : '' }} >Design only</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $contactService->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_number"
            label="Phone Number"
            :value="old('phone_number', ($editing ? $contactService->phone_number : ''))"
            maxlength="255"
            placeholder="Phone Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $contactService->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="company_name"
            label="Company Name"
            :value="old('company_name', ($editing ? $contactService->company_name : ''))"
            maxlength="255"
            placeholder="Company Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $contactService->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="luas" label="Luas">
            @php $selected = old('luas', ($editing ? $contactService->luas : '')) @endphp
            <option value="below_100m" {{ $selected == 'below_100m' ? 'selected' : '' }} >Below 100m</option>
            <option value="100m_200m" {{ $selected == '100m_200m' ? 'selected' : '' }} >100m 200m</option>
            <option value="above_200m" {{ $selected == 'above_200m' ? 'selected' : '' }} >Above 200m</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="project_value" label="Project Value">
            @php $selected = old('project_value', ($editing ? $contactService->project_value : '')) @endphp
            <option value="100_200_juta" {{ $selected == '100_200_juta' ? 'selected' : '' }} >100 200 juta</option>
            <option value="200_500_juta" {{ $selected == '200_500_juta' ? 'selected' : '' }} >200 500 juta</option>
            <option value="500_juta" {{ $selected == '500_juta' ? 'selected' : '' }} >500 juta</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="info" label="Info" maxlength="255"
            >{{ old('info', ($editing ? $contactService->info : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="rencana_meeting"
            label="Rencana Meeting"
            value="{{ old('rencana_meeting', ($editing ? optional($contactService->rencana_meeting)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="rencana_pembayaran"
            label="Rencana Pembayaran"
            value="{{ old('rencana_pembayaran', ($editing ? optional($contactService->rencana_pembayaran)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
