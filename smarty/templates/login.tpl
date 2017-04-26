{extends file="main.tpl"}

{block name=body}
    {if ($LoggedIn)}
        You Are Signed in as someone.
    {else}
        <form class="form-signin" method="post" action="{$location}">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required
                   autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Sign-In">Sign in</button>
        </form>
    {/if}
{/block}
