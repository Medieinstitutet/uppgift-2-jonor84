<ul class="list-group list-group-flush mt-0" id="menuList">
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=profile" class="menu-link <?php if ($_GET['show'] == 'profile') echo 'text-dark'; ?>">
            <span><i class="fas fa-user-edit"></i> Profil</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=email" class="menu-link <?php if ($_GET['show'] == 'email') echo 'text-dark'; ?>">
            <span><i class="fa-fw fas fa-at"></i> E-postadress</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=mobile" class="menu-link <?php if ($_GET['show'] == 'mobile') echo 'text-dark'; ?>">
            <span><i class="fa-fw fas fa-mobile-alt"></i> Mobilnummer</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=image" class="menu-link <?php if ($_GET['show'] == 'image') echo 'text-dark'; ?>">
            <span><i class="fa-fw fas fa-user-circle"></i> Profilbild</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=password" class="menu-link <?php if ($_GET['show'] == 'password') echo 'text-dark'; ?>">
            <span><i class="fa-fw fas fa-user-lock"></i> Lösenord</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=settings" class="menu-link <?php if ($_GET['show'] == 'settings') echo 'text-dark'; ?>">
            <span><i class="fa-fw fas fa-user-cog"></i> Inställningar</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action bg-light">
        <a href="account" class="menu-link">
            <span class=" text-dark"><i class="fa-fw fas fa-user-circle"></i> Visa profil</span>
        </a>
    </li>
</ul>