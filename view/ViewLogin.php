<div class="row" id="login">


    <div class="col-md-6" id="login-postcard">
    </div>



    <div class="col-md-6">
        <h2>Log in</h2>
        <p>Blanditiis voluptatem ex eos dolore et. <br/>Qui tempora nemo corrupti dolorem impedit repudiandae eligendi tenetur. Autem ullam est quae similique ut. Corrupti labore est molestias temporibus. Deleniti corrupti et modi accusamus quis dolorem culpa harum.
        </p>
        <form method="POST" action='.'>
            <div class="form-group">
                <input type="email" class="form-control" id="login" placeholder="Email" name="login" value="<?php echo isset($login) ? $login : "";?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pwd" placeholder="Password" name="pwd">
            </div>
            
            <input type="hidden" name="action"  value="verify"/>

            <button type="submit" id="btnlogin" class="btn btn-default">Log in</button>
        </form>

    </div>
</div>