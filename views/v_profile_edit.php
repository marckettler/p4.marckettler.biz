<article class="panel panel-default">
    <div class="page-header">
        <h2 class="text-center">Edit your Profile by changing the fields below.</h2>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/profile/p_edit">
            <div class="form-group">
                <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" id="inputFirstName" value="<?=$user->first_name;?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" id="inputLastName" value="<?=$user->last_name;?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control<? if(isset($email_error)) echo ' alert-danger';?>" id="inputEmail" value="<?=$user->email;?>" required>
                    <? if(isset($email_error)) echo "<strong class='text-danger'>Email was not unique</strong>";?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a class="btn btn-danger" href="/profile/view">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</article>