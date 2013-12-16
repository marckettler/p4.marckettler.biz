<div class="container">
    <article class="panel panel-default">
        <div class="page-header">
            <h2 class="text-center">Log In <small>All fields are required!</small></h2>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="/users/p_login">
            <?  if(isset($error)): ?>
                <div class="text-center text-danger">
                    <h3>Your Login information was incorrect.</h3>
                </div>
            <?  elseif(isset($_GET['email'])):?>
                <div class="text-center text-danger">
                    <h3>Email account in use. <a class="btn btn-danger btn-sm" href="/users/create">Create account</a> or Log In below.</h3>
                </div>
            <?
                endif;
                echo $common_form_inputs;
            ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Sign In!</button>
                    </div>
                </div>
            </form>
        </div>
    </article>
</div>