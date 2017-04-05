<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">{$app_name}</a>
        </div>
        <ul class="nav navbar-nav">
            <li {if !isset($data)}class="active"{/if}><a href="/">Home</a></li>
            <li><a href="#">Store</a></li>
            {if ($LogedIn)}
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Network
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">main.slayer1of1.players.net</a></li>
                        <li><a href="#">...</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Panel
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/network/">Networks</a></li>
                        <li><a href="/admin/computer/">Computers</a></li>
                        <hr/>
                        <li><a href="/admin/computer/add/">Add Computer</a></li>
                        <li><a href="/admin/info/">PhpInfo</a></li>
                    </ul>
                </li>
            {/if}
        </ul>
        <ul class="nav navbar-nav navbar-right">
            {if ($LogedIn)}
                <li><a href="/profile/"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            {else}
                <li><a href="/register/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            {/if}
        </ul>
    </div>
</nav>