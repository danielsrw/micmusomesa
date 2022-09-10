<form class="row contact_form" action="" method="POST">
	<div class="col-md-12">
		<div class="form-group">
            <div class="input-group">
              	<div class="input-group-prepend">
                	<span class="input-group-text bg-default text-white">
                		<i class="fa fa-money"></i>
                	</span>
              	</div>
              	<input type="text" class="form-control" id="inCost" placeholder="Sale Price" value="<?php echo $price ?>">
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
              	<div class="input-group-prepend">
                	<span class="input-group-text bg-default text-white">
                		<i class="fa fa-money"></i>
                	</span>
              	</div>
              	<input type="text" class="form-control" id="inDown" placeholder="Down Payment">
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
              	<div class="input-group-prepend">
                	<span class="input-group-text bg-default text-white">
                		<i class="fa fa-calendar-o"></i>
                	</span>
              	</div>
              	<input type="text" class="form-control" id="inAPR" placeholder="Loan Term (Years)">
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
              	<div class="input-group-prepend">
                	<span class="input-group-text bg-default text-white">
                		<i class="fa fa-percent"></i>
                	</span>
              	</div>
              	<input type="text" class="form-control" id="inPeriod" placeholder="Interest Rate">
            </div>
        </div>
		<div class="form-group">
			<button type="button" id="btnCalculate" class="btn btn-sm primary-btn">
            	Calculate
            </button>
        </div>
		<div class="form-group">
            <p id="outMontly" style="color: green;"></p>
        </div>
	</div>
</form>

<script>
    //Formula: c = ( r * p ) / (1 - Math.pow((1 + r) , (-n) ))

    //function for Calculate Mortgage
    /**
     * @param p = float (loan)
     * @param r = (interst as percentage(montly interst rate))
     * @param n = (term in years (montly Pay))
     */
    function calculateMortgage(p,r,n) {
        //convert this percent to decimal
        r = percentToDecimal(r);

        //convert years to month
        n = yearsToMonths(n);

        var pmt = ( r * p ) / (1 - Math.pow((1 + r) , (-n) ));

        return parseFloat(pmt.toFixed(2));
    }
    //Convert percent to decimal
    function percentToDecimal(percent) {
        return (percent/12)/100;
    }
    //Convert Years to Month
    function yearsToMonths(year) {
        return year * 12;
    }
    // Post Total amount
    function postPayments(payment) {
        var htmlEl = document.getElementById('outMontly');
        //using innerText for Display our value

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'RWF',
        });

        htmlEl.innerText = "Monthly Payment " + formatter.format(payment);
    }

    //using document.getElementById for Make our HTML btn Calculate
    var btn = document.getElementById('btnCalculate');
    btn.onclick = function() {
        //cost of House
       var cost = document.getElementById('inCost').value;

       //(پیش قسط)
       var downPayment = document.getElementById('inDown').value;
       //interst rate
       var interst = document.getElementById('inAPR').value;
       //time like year
       var term   = document.getElementById('inPeriod').value;

       //Validation
       if (cost < 0 || downPayment < 0 || interst < 0 || term <0) {
           alert("Invalid Number");
           return false;
       }
       if (cost == "" || downPayment == "" || interst == "" || term == "") {
           alert("Please Fill All");
           return false;
       }

       var amount = cost - downPayment;
       //Calculate all
       var pmt = calculateMortgage(amount,interst,term);
       //post final result
       postPayments(pmt);
    };
</script>