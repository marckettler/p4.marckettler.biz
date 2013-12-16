<article class="panel panel-default">
    <div class="page-header">
        <h2 class="text-center">Create a new User Account <small>All fields are required!</small></h2>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/users/p_create">
            <div class="form-group">
                <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="First Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Last Name" required>
                </div>
            </div>
            <?= $common_form_inputs; ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</article>