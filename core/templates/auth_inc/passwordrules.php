<style>
    .list-group-item {
        padding: 6px;
    }
</style>
<span class="font-weight-bold text-center mb-2">Lösenordet måste vara minst 8 tecken långt och innehålla:</span>
<? $CHECKDOT = "<i class='fa-regular fa-fw fa-circle-check'></i>"; ?>
<ol class="list-group list-group-ordered p-1">
    <li class="list-group-item list-group-item-action text-dark">
        <div class="ms-2 me-auto">
            <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 stor bokstav</div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action text-dark">
        <div class="ms-2 me-auto">
            <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 liten bokstav</div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action text-dark">
        <div class="ms-2 me-auto">
            <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 siffra</div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action text-dark">
        <div class="ms-2 me-auto">
            <div class="fw-bold"><? echo $CHECKDOT; ?> Minst 1 av dessa specialtecken:</div>
            <span>! @ # $ % ^ & * ( ) - _ = + { } ; : , < . ></span>
        </div>
    </li>
</ol>