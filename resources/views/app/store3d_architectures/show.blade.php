<x-app-layout>
    @section('title', 'Show Store3d Architecture')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.store3d_architecture.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('store3d-architectures.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_architecture.inputs.name')
                        </h5>
                        <span>{{ $store3dArchitecture->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_architecture.inputs.description')
                        </h5>
                        <span
                            >{{ $store3dArchitecture->description ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_architecture.inputs.price')
                        </h5>
                        <span>{{ $store3dArchitecture->price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_architecture.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $store3dArchitecture->image ? \Storage::url($store3dArchitecture->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_architecture.inputs.file')
                        </h5>
                        @if($store3dArchitecture->file)
                        <a
                            href="{{ \Storage::url($store3dArchitecture->file) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('store3d-architectures.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Store3dArchitecture::class)
                    <a
                        href="{{ route('store3d-architectures.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
