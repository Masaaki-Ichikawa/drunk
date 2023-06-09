<nav x-data="{ open: false }" class=" rerative bottom-0 fixed w-full bg-black h-16 flex justify-around">
    <a class="m-auto" href="{{ route('dashboard') }}">
        <i class="icon glass fa-solid fa-martini-glass"></i>
    </a>

    <a class="m-auto" href="">
        <i class="icon crown fa-solid fa-crown"></i>
    </a>

    <a class="m-auto" href="{{ route('new_recipe') }}">
        <i class="icon plus fa-solid fa-plus"></i>
    </a>

    <a class="m-auto" href="{{ route('user_mypage') }}">
        <i class="icon user fa-solid fa-user"></i>
    </a>
</nav>