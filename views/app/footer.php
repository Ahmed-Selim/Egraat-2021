</main>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert bg-<?= $_SESSION['msg_type'] ?> alert-dismissible fade show text-center text-white" role="alert" id="msg">
            <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </button> -->
            <strong><?= $_SESSION['msg_title'] ?></strong>
            <span><?php echo $_SESSION['msg']; unset($_SESSION['msg']) ; ?></span>
        </div>
    <?php endif  ?>
    
    <script src="//localhost/pro/resources/js/jquery-3.6.0.min.js"></script>
    <script src="//localhost/pro/resources/js/bootstrap.min.js"></script>
    <script src="//localhost/pro/resources/js/html2pdf.bundle.min.js"></script>
    <script src="//localhost/pro/resources/js/index.js"></script>
</body>
</html>