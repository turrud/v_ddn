<x-app-layout>
    @section('title', 'Show Store3d Furniture')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.store3d_furniture.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('store3d-furnitures.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_furniture.inputs.name')
                        </h5>
                        <span>{{ $store3dFurniture->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_furniture.inputs.description')
                        </h5>
                        <span>{{ $store3dFurniture->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_furniture.inputs.price')
                        </h5>
                        <span>{{ $store3dFurniture->price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_furniture.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $store3dFurniture->image ? \Storage::url($store3dFurniture->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.store3d_furniture.inputs.file')
                        </h5>
                        @if($store3dFurniture->file)
                        <a
                            href="{{ \Storage::url($store3dFurniture->file) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('store3d-furnitures.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Store3dFurniture::class)
                    <a
                        href="{{ route('store3d-furnitures.create') }}"
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
