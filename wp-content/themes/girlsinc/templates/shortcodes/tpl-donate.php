<?php use Roots\Sage\Assets; ?>

<div class="donate-inner">
    <h3>Donate</h3>
    <p>Give to ensure girls have the experiences and opportunities to thrive.</p>
    <form action="https://www.classy.org/checkout/donation" method="GET" target="_blank" novalidate>
        <div class="row">
            <div class="col-12">
                <label for="donate-amt">I want to donate:</label>
            </div>
        </div>
        <div class="donation-amt-btns radio-btns row">
            <div class="radio-group col">
                <input type="radio" name="amount" value="100" id="amount-100">
                <label for="amount-100">$100</label>
            </div>
            <div class="radio-group col">
                <input type="radio" name="amount" checked="checked" value="50" id="amount-50">
                <label for="amount-50">$50</label>
            </div>
            <div class="radio-group col">
                <input type="radio" name="amount" value="25" id="amount-25">
                <label for="amount-25">$25</label>
            </div>
            <div class="radio-group col">
                <input type="radio" name="amount" value="10" id="amount-10">
                <label for="amount-10">$10</label>
            </div>
            <div class="radio-group col">
                <input type="radio" name="amount" value="" id="amount-other">
                <label for="amount-other">Other</label>
            </div>
        </div>
        <div class="form-group row" id="other-amount-text-group">
            <div class="col-12">
                <input class="form-control" type="number" value="" id="other-amount-text-input" placeholder="Enter Amount $">
            </div>
        </div>
        <div class="row check-box-holder">
            <div class="col-12">
                <input type="radio" name="recurring" class="radio-button" value="0" id="single-donation" />
                <label for="single-donation">
                    <img class="radio-box" src="<?= Assets\asset_path('images/red-check.jpg') ?>" style="display: none;">
                    <div class="radio-box"></div><span>Single Donation</span>
                </label>


                <input type="radio" name="recurring" checked="checked" class="radio-button" value="1" id="monthly-donation" />
                <label for="monthly-donation">
                    <img class="radio-box" src="<?= Assets\asset_path('images/red-check.jpg') ?>" style="display: none;">
                    <div class="radio-box"></div><span>Monthly Donation</span>
                </label>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <input type="submit" id="submit-btn" value="Donate" />
                <input type="hidden" name="eid" value="147155">
            </div>
        </div>
    </form>
</div>
