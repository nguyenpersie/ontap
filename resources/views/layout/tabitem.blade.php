@php
    $navItems = [
        ['route' => 'product.list', 'label' => 'Sản phẩm', 'header' => 'MÀN HÌNH QUẢN LÝ SẢN PHẨM'],
        ['route' => 'customer.list', 'label' => 'Khách hàng', 'header' => 'MÀN HÌNH QUẢN LÝ KHÁCH HÀNG'],
        ['route' => 'user.list', 'label' => 'Users', 'header' => 'MÀN HÌNH QUẢN LÝ USERS'],
    ];

    $activeRoute = Route::currentRouteName(); // Get the current route name
    $headerTitle = '';
    foreach ($navItems as $item) {
        if ($item['route'] === $activeRoute) {
            $headerTitle = $item['header'];
            break;
        }
    }
@endphp

<div class="container">
    <div class="header text-center">
        <h2>{{ $headerTitle }}</h2>
    </div>
    <ul class="nav nav-tabs">
        @foreach($navItems as $item)
            <li class="nav-item">
                <a class="nav-link {{ $activeRoute === $item['route'] ? 'active' : '' }}" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
