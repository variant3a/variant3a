<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1">
                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow ring-1 ring-black ring-opacity-5">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white cursor-default text-neutral-300 dark:text-neutral-500 dark:bg-zinc-700 rounded-l-md" aria-hidden="true">
                                        <i class="bi bi-chevron-left"></i>
                                    </span>
                                </span>
                            @else
                                <button wire:click="previousPage('{{ $paginator->getPageName() }}')" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white rounded-l-md text-neutral-700 dark:text-neutral-200 dark:bg-zinc-700 hover:bg-teal-500 dark:hover:bg-teal-500 hover:text-neutral-200 active:bg-gray-100 active:text-neutral-700" aria-label="{{ __('pagination.previous') }}">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 bg-white cursor-default select-none text-neutral-700 dark:bg-zinc-700">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 bg-teal-500 cursor-default select-none text-neutral-200">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white text-neutral-700 dark:text-neutral-200 dark:bg-zinc-700 hover:bg-teal-500 dark:hover:bg-teal-500 hover:text-neutral-200 active:bg-gray-100 active:text-neutral-700" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white text-neutral-700 dark:text-neutral-200 dark:bg-zinc-700 rounded-r-md hover:text-neutral-200 hover:bg-teal-500 dark:hover:bg-teal-500" aria-label="{{ __('pagination.next') }}">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 bg-white cursor-default text-neutral-300 dark:text-neutral-500 dark:bg-zinc-700 rounded-r-md" aria-hidden="true">
                                        <i class="bi bi-chevron-right"></i>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
