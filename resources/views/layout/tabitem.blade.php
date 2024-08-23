@php
    $productHeader = 'MÀN HÌNH QUẢN LÝ SẢN PHẨM';
    $customerHeader = 'MÀN HÌNH QUẢN LÝ KHÁCH HÀNG';
    $userHeader = 'MÀN HÌNH QUẢN LÝ USERS';

    $navItems = [];

    if (Auth::check() && Auth::user()->group_role == 1) {
        $navItems[] = ['route' => 'product.list', 'label' => 'Products', 'header' => $productHeader];
        $navItems[] = ['route' => 'customer.list', 'label' => 'Customers', 'header' => $customerHeader];
        $navItems[] = ['route' => 'user.list', 'label' => 'Users', 'header' => $userHeader];
    } else {
        $navItems[] = ['route' => 'product.list', 'label' => 'Products', 'header' => $productHeader];
        $navItems[] = ['route' => 'customer.list', 'label' => 'Customers', 'header' => $customerHeader];
    }

    Session::put('navItems', $navItems);

    $activeRoute = Route::currentRouteName();
    $headerTitle = '';
    foreach (Session::get('navItems') as $item) {
        if ($item['route'] === $activeRoute) {
            $headerTitle = $item['header'];
            break;
        }
    }
@endphp
<div class="container">
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
