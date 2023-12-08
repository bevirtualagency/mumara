
<?php if(!empty($app_settings['google_analytics'])) { 
    $analyticsCode = $app_settings['google_analytics'];
?>

<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analyticsCode; ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $analyticsCode; ?>');
    </script>
<?php } ?>