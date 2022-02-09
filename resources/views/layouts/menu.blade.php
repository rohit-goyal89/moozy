
<li class="nav-item">
    <a href="{{ route('home') }}"
       class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item has-treeview {{ Request::is('users*') ? 'menu-open' : '' }}" >
   <a href="#" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
     <i class="nav-icon fas fa-tachometer-alt"></i>
     <p>
       User Manager
       <i class="right fas fa-angle-left"></i>
     </p>
   </a>
   <ul class="nav nav-treeview">
     <li class="nav-item">
       <a href="{{ route('users.index') }}?role=2" class="nav-link {{ (Request::query('role') ==2) ? 'active' : '' }}">
         <p>Restaurant Owner</p>
       </a>
     </li>
     <li class="nav-item">
       <a href="{{ route('users.index') }}?role=3" class="nav-link {{ (Request::query('role') ==3) ? 'active' : '' }}">
         <p>Driver</p>
       </a>
     </li>
     <li class="nav-item">
       <a href="{{ route('users.index') }}?role=4" class="nav-link {{ (Request::query('role') ==4) ? 'active' : '' }}">
         <p>Customer</p>
       </a>
     </li>
   </ul>
 </li>

<li class="nav-item">
    <a href="{{ route('restaurants.index') }}"
       class="nav-link {{ Request::is('restaurants*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Restaurants</p>

    </a>
</li> 
<li class="nav-item">
    <a href="{{ route('pages.index') }}"
       class="nav-link {{ Request::is('pages*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Pages Manager</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Roles Manager</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('coupons.index') }}"
       class="nav-link {{ Request::is('coupons*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Coupons</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cuisines.index') }}"
       class="nav-link {{ Request::is('cuisines*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>

        <p>Cuisines</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('faqs.index') }}"
       class="nav-link {{ Request::is('faqs*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Faqs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('offers.index') }}"
       class="nav-link {{ Request::is('offers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Offers</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('supports.index') }}"
       class="nav-link {{ Request::is('supports*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Supports</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('menus.index') }}"
       class="nav-link {{ Request::is('menus*') ? 'active' : '' }}">
       <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Menus</p>
    </a>
</li>


