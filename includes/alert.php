<?php
session_start();
?>
<script src="../JS/sweetalert.min.js"></script>

<script>
<?php
if(isset($_SESSION['status']) && isset($_SESSION['status_icon']) && isset($_SESSION['status_text']) && $_SESSION['status_icon'] != '') {
?>
Swal.fire({
    title: "<?php echo $_SESSION['status']; ?>",
    icon: "<?php echo $_SESSION['status_icon']; ?>",
    text: "<?php echo $_SESSION['status_text']; ?>",
    
});
<?php
    unset($_SESSION['status']);
    unset($_SESSION['status_icon']);
    unset($_SESSION['status_text']);
}
?>
</script>

