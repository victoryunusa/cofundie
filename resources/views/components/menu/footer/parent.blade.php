@if(!empty($menus))
    @foreach ($menus['data'] ?? [] as $key => $row)
        @if (isset($row->children))
            <li>
                <a href="{{ $row->href }}">
                    {{ $row->text }}
                    <i class="fas fa-angle-down"></i>
                </a>
                <ul class="sub-menu" id="submenu-{{ $key }}">
                    @foreach($row->children as $childrens)
                        @include('components.menu.header.child', ['childrens' => $childrens])
                    @endforeach
                </ul>
            </li>
        @else
            <li><a href="{{ url($row->href) }}" @if(!empty($row->target)) @endif target="{{ $row->target }}" class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                class="fas fa-angle-right mr-1"></i> {{ $row->text }}</a></li>
        @endif
    @endforeach
@endif
