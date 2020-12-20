<!-- need to remove -->
@if (Auth::user()->isAdmin == '1')
    <li class="nav-item">
        <a href="{{ route('settings') }}" class="nav-link {{(\Route::current()->getName() == 'settings') ? 'active' : '' }}">
            <i class="nav-icon fas fa-wrench"></i>
            <p>Settings</p>
        </a>
    </li>
@elseif(Auth::user()->isAdmin == '0')


<li class="nav-item">
    <a href="{{ route('meals.index') }}" class="nav-link {{(\Route::current()->getName() == 'home') || (\Route::current()->getName() == 'meals.index') || (\Route::current()->getName() == 'meals.create') || (\Route::current()->getName() == 'meals.edit') || (\Route::current()->getName() == 'search-meals')? 'active' : '' }}">
        <i class="nav-icon fas fa-soap"></i>
        <p>Meals</p>
    </a>
</li>
@endif
