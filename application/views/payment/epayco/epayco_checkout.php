<!-- filepath: c:\xampp\htdocs\elevant_academy\application\views\payment\epayco\epayco_checkout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ePayco | <?php echo get_settings('system_name'); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo base_url('assets/payment/css/stripe.css'); ?>" rel="stylesheet">
    <link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/' . get_settings('favicon')); ?>" rel="shortcut icon" />

    <script src="https://checkout.epayco.co/checkout.js"></script>
</head>
<body style="background-color: #fff !important;">
    <?php 
    $epayco_keys = json_decode(get_settings('epayco_keys'));
    $epayco_currency = get_settings('epayco_currency');

    // Conversión de moneda si es necesario
    $usd_to_cop_rate = 4000; // Ajusta esta tasa de cambio según la actual
    if ($epayco_currency == 'COP') {
        $amount_to_pay = $amount_to_pay * $usd_to_cop_rate; // Convierte USD a COP
    }
    ?>

    <div class="package-details" style="width: 100%; float: left">
        <strong>
            <img style="padding-bottom: 25px;" src="<?php echo base_url('assets/payment/epayco.png'); ?>" width="150">
        </strong>
        <br>
        <strong><?php echo site_phrase('customer_name'); ?> | <?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></strong> <br>
        <strong><?php echo site_phrase('amount_to_pay'); ?> | <?php echo $amount_to_pay . ' ' . get_settings('system_currency'); ?></strong> <br>

        <button id="epayco-button" style="padding: 5px; float: none !important; cursor: pointer; background-color: rgb(43, 131, 234); margin-left: auto !important; margin-right: auto !important; width: 200px; padding: 0px; height: 35px; line-height: 35px;"><?php echo get_phrase('pay'); ?></button>
    </div>

    <script>
        var handler = ePayco.checkout.configure({
            key: "<?php echo $epayco_keys[0]->public_key; ?>",
            test: <?php echo $epayco_keys[0]->test_mode == 'sandbox' ? 'true' : 'false'; ?>,
            lang: "es"
        });

        document.getElementById('epayco-button').onclick = function (e) {
            e.preventDefault();

            handler.open({
                name: "<?php echo get_settings('system_name'); ?>",
                description: "<?php echo site_phrase('purchase_description'); ?>",
                invoice: "<?php echo uniqid(); ?>",
                currency: "<?php echo $epayco_currency; ?>", // Moneda configurada
                amount: <?php echo $amount_to_pay; ?>, // Monto convertido si es necesario
                tax_base: "0",
                tax: "0",
                country: "CO",
                external: "false",
                response: "<?php echo site_url('home/epayco_response'); ?>",
                confirmation: "<?php echo site_url('home/epayco_confirmation'); ?>",
                extra1: "<?php echo $user_details['id']; ?>",
                extra2: "<?php echo $amount_to_pay; ?>"
            });
        };
    </script>
</body>
</html>