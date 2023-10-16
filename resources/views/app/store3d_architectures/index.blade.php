<x-app-layout>
    @section('title', 'Store3d Architectures')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.store3d_architecture.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create',
                            App\Models\Store3dArchitecture::class)
                            <a
                                href="{{ route('store3d-architectures.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.store3d_architecture.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.store3d_architecture.inputs.description')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.store3d_architecture.inputs.price')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.store3d_architecture.inputs.image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.store3d_architecture.inputs.file')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($store3dArchitectures as $store3dArchitecture)
                                <tr class="hover:bg-gray-50">
                                    <!-- ... your table row content ... -->
                                    <td class="px-4 py-3 text-left">
                                        {{ $store3dArchitecture->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $store3dArchitecture->description ?? '-'
                                        }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $store3dArchitecture->price ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        <x-partials.thumbnail
                                            src="{{ $store3dArchitecture->image ? \Storage::url($store3dArchitecture->image) : '' }}"
                                        />
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if($store3dArchitecture->file)
                                        <a
                                            href="{{ \Storage::url($store3dArchitecture->file) }}"
                                            target="blank"
                                            ><i
                                                class="mr-1 icon ion-md-download"
                                            ></i
                                            >&nbsp;Download</a
                                        >
                                        @else - @endif
                                    </td>
                                    <td
                                        class="px-4 py-3 text-center"
                                        style="width: 134px;"
                                    >
                                        <div
                                            role="group"
                                            aria-label="Row Actions"
                                            class="
                                                relative
                                                inline-flex
                                                align-middle
                                            "
                                        >
                                            @can('update', $store3dArchitecture)
                                            <a
                                                href="{{ route('store3d-architectures.edit', $store3dArchitecture) }}"
                                                class="mr-1"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i
                                                        class="icon ion-md-create"
                                                    ></i>
                                                </button>
                                            </a>
                                            @endcan @can('view',
                                            $store3dArchitecture)
                                            <a
                                                href="{{ route('store3d-architectures.show', $store3dArchitecture) }}"
                                                class="mr-1"
                                            >
                                                <button
                                                    type="button"
                                                    class="button"
                                                >
                                                    <i class="icon ion-md-eye"></i>
                                                </button>
                                            </a>
                                            @endcan @can('delete',
                                            $store3dArchitecture)
                                            <form
                                                action="{{ route('store3d-architectures.destroy', $store3dArchitecture) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                            >
                                                @csrf @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="button"
                                                >
                                                    <i
                                                        class="
                                                            icon
                                                            ion-md-trash
                                                            text-red-600
                                                        "
                                                    ></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="mt-10 px-4">
                                        {!! $store3dArchitectures->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
