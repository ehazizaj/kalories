<!-- need to remove -->
<li class="nav-item" >
    <a href="{{ route('home') }}"  class="nav-link {{(\Route::current()->getName() == 'home')  ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('settings') }}" class="nav-link {{(\Route::current()->getName() == 'settings') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wrench"></i>
        <p>Settings</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('meals.index') }}" class="nav-link {{(\Route::current()->getName() == 'meals.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-soap"></i>
        <p>Meals</p>
    </a>
</li>
