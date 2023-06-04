<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../../img/logo/logo_title.png" type="image/x-icon">
<title><?= $Title ?></title>
<link rel="stylesheet" href="../../style/all.css">
<link rel="stylesheet" href="../../style/plugins.css">
<link rel="stylesheet" href="../../style/navigation.css">
<link rel="stylesheet" href="../../style/topbar.css">
<link rel="stylesheet" href="../../style/bottom_bar.css">
<link rel="stylesheet" href="../../style/formHeader.css">
<!-- <link rel="stylesheet" href="../../style/popup.css"> -->

<div class="popup" id="popup">
    
</div>

<script async>
    setInterval('load_msg()', 1000);

    function load_msg() {
        $('#popup').load('../../config/confirm_pass.php');
    }
</script>