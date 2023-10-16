<x-app-layout>
    @section('title', 'Contact Service')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.contact_service.index_title')
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
                            @can('create', App\Models\ContactService::class)
                            <a
                                href="{{ route('contact-services.create') }}"
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
                                    @lang('crud.contact_service.inputs.business_need')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.phone_number')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.company_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.location')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.luas')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.project_value')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.info')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.rencana_meeting')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.contact_service.inputs.rencana_pembayaran')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($contactServices as $contactService)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->business_need ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->phone_number ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->company_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->location ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->luas ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->project_value ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->info ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->rencana_meeting ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $contactService->rencana_pembayaran ??
                                    '-' }}
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
                                        @can('update', $contactService)
                                        <a
                                            href="{{ route('contact-services.edit', $contactService) }}"
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
                                        @endcan @can('view', $contactService)
                                        <a
                                            href="{{ route('contact-services.show', $contactService) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $contactService)
                                        <form
                                            action="{{ route('contact-services.destroy', $contactService) }}"
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
                                <td colspan="12">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
                                    <div class="mt-10 px-4">
                                        {!! $contactServices->render() !!}
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
