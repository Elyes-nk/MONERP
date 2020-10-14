<nav class="full-box navbar-info">
<div class="dropdown show" >
    <a href="#" class="float-left show-nav-lateral">
        <i class="fas fa-exchange-alt"></i>
    </a>
    @livewire('notifications-panel')
    <a href="/profile/{{ Auth::user()->id}}">
		<i class="fas fa-user-cog"></i>
	</a>
    <a href="#" class="btn-exit-system">
        <i class="fas fa-power-off"></i>
    </a>
</div>
</nav>
