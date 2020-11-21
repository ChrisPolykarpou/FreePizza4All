<html>
<?php include('templates/header.php') ?>
<style>
    .main {
        margin-top: 62px;
    }

    .button {
        padding: 20px;
    }
</style>
<div class="center main">
    <h2 class="grey-text">Thank you!</h2>
    <h3 class="grey-text">Email with order information is now sent to you!</h3>
    <div class="center button">
        <button id="myBtn" class="btn brand z-depth 0">Return to Home</button>
    </div>
</div>
<script>
    let btn = document.getElementById('myBtn');
    btn.addEventListener('click', function() {
        document.location.href = '<?php echo "index.php"; ?>';
    });
</script>
<?php include('templates/footer.php') ?>

</html>