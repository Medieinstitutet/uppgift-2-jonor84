<ul class="list-group list-group-flush mt-0" id="menuList">
    <li class="list-group-item list-group-item-action">
        <a href="<?php echo $gloBaseModule; ?>&show=profile" class="menu-link <?php if ($_GET['show'] == 'profile') echo 'text-dark'; ?>">
            <span><i class="fas fa-user-edit"></i> Profil</span>
        </a>
    </li>
    <li class="list-group-item list-group-item-action bg-light">
        <a href="client" class="menu-link">
            <span class=" text-dark"><i class="fa-fw fas fa-user-circle"></i> Visa Kund</span>
        </a>
    </li>
</ul>