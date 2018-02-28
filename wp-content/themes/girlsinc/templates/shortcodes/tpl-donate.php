<?php use Roots\Sage\Assets; ?>

<div class="donate-inner">
    <h3>Donate</h3>
    <p>Give to ensure girls have the experiences and opportunities to thrive.</p>
    <div class="row">
        <div class="col-md-12">
            <a href="https://crm.bloomerang.co/HostedDonation?ApiKey=pub_318e7c35-a482-11e7-afbe-024e165d44b3&WidgetId=202752" id="donate-btn">Click here to donate now</a>
            <?php if (! is_page(694)) {
                echo '<a href="/donate" style="margin-left: 30px;">Learn More</a>';
            }
            ?>
        </div>
    </div>
</div>
