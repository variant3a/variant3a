<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1">
                <div>
                    <span class="relative z-0 inline-flex">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex items-center p-2 text-sm font-medium leading-5 rounded-full hover:bg-transparent text-neutral-400" aria-hidden="true">
                                        <i class="material-icons">chevron_left</i>
                                    </span>
                                </span>
                            @else
                                <button wire:click="previousPage('{{ $paginator->getPageName() }}')" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="relative inline-flex items-center p-2 text-sm font-medium leading-5 text-teal-400 rounded-full hover:bg-teal-600/20 active:bg-teal-600/30" aria-label="{{ __('pagination.previous') }}">
                                    <i class="material-icons">chevron_left</i>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center w-10 h-10 text-sm font-medium leading-5 rounded-full cursor-default select-none bg-neutral-800 text-neutral-700">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="flex items-center justify-center w-10 h-10 text-sm font-medium leading-5 text-teal-900 bg-teal-500 rounded-full cursor-default select-none">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="flex items-center justify-center w-10 h-10 text-sm font-medium leading-5 text-teal-400 rounded-full hover:bg-teal-600/20 active:bg-teal-600/30" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
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
                                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="relative inline-flex items-center p-2 -ml-px text-sm font-medium leading-5 text-teal-400 rounded-full hover:bg-teal-600/20 active:bg-teal-600/30" aria-label="{{ __('pagination.next') }}">
                                    <i class="material-icons">chevron_right</i>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex items-center p-2 -ml-px text-sm font-medium leading-5 rounded-full hover:bg-transparent text-neutral-400" aria-hidden="true">
                                        <i class="material-icons">chevron_right</i>
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
