<aside class="side-nav">
    <div class="logo">
        <img src="{{asset('img/logo.svg')}}" alt="">
        ADMIN PANEL
        </div>

        <ul>
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('adminpanel.products')}}">Products</a>
            </li>
            <li>
                <a href="{{route('adminpanel.categories')}}">Categories</a>
            </li>
            <li>
                <a href="{{route('adminpanel.colors')}}">Colors</a>
            </li>
            <li>
                <a href="{{route('adminpanel.orders')}}">Orders</a>
            </li>
        </ul>
        
        <div class="logout">
            <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h7v2H5v14h7v2H5Zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5l-5 5Z"/></svg>
            &nbsp; Logout
            </button>
            </form>
        </div>

</aside>