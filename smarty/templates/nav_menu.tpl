<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">{$app_name}</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            {if ($LoggedIn)}
                <li><a href="/user/"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="/user/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            {else}
                <li><a href="/user/register/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/user/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            {/if}
        </ul>
    </div>
</nav>