<h1>Pay your resit fees</h1>


<?php if ($_SESSION['user_paid_resits']){
    echo "You already paid your resit fees.";
} else if (!$_SESSION['user_number_resits']){
    echo "Congratulations, you passed all your modules. You don't have any resit.";
} else { ?>




<div class='row'>
    <div class='col-md-8 text-center col-md-offset-2'>
<h2>To pay : £<?php echo (int) $_SESSION['user_number_resits'] * 10?>,00</h2>
    </div>
</div>

<form id="fees-pay">
    <div class='row'>
        <div class='col-md-2 col-md-offset-3'>
            <input type="radio" name="card" id="cb-button" required=""/>
            <label class="card-icon" id='cb-card' for="cb-button"> </label>
        </div>

        <div class='col-md-2' >
            <input type="radio" name="card" id="mastercard-button" > 
            <label class="card-icon" id='mastercard-card' for="mastercard-button"> </label>
        </div>

        <div class='col-md-2'>
            <input type="radio"  name="card" id="visa-button"> 
            <label class="card-icon" id='visa-card' for="visa-button"> </label>
        </div>
    </div>
<div class="title-spacer"></div>


    <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">

        <div class="form-group">
            <label for="name">Name of the card owner</label>
            <input type="text" class="form-control" id="name" placeholder="John DOE" required="">
        </div>
        <div class="form-group">
            <label for="cardnumb">Card number</label> <small>without spaces</small>
            <input type="text" class="form-control" id="cardnumb" autocomplete="off"   maxlength="16" placeholder="1234567812349876" required>
        </div>

        <div class="form-inline">
            <div class="form-group">
                <label for="expdate">Expiry date</label><br/>
                <input type="text" class="form-control" id="expdate" placeholder="MM/YYYY" maxlength="7" required>
            </div>
            <div class="form-group">
                <label for="crypto">Cryptogram code</label><br/>
                <input type="text" class="form-control" id="crypto" maxlength="3" placeholder='987' required>
            </div>
            <div class="form-group"><br/> 
            <input type="hidden" name="controller" value="exam"/>
            <input type="hidden" name="action" value="resitfeessuccess"/>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pay £<?php echo (int) $_SESSION['user_number_resits'] * 10?>,00</button>
            </div>
        </div>

    </div>




</form>
<?php } ?>