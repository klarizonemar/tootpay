<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Users <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ route('users.index') }}">All</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{{ route('users.admin') }}">Administrators</a></li>
        <li><a href="{{ route('users.cashier') }}">Cashiers</a></li>
        <li><a href="{{ route('users.cardholder') }}">Cardholders</a></li>
        <li><a href="{{ route('users.guest') }}">Guests</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> User</a></li>
    </ul>
</li>