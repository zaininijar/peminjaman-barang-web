<div class="py-6 px-6 text-center">
    <p class="mb-0">Copyright &copy; <a href="#" target="_blank"
            class="pe-1 text-primary text-decoration-underline">PeminjamanBarang</a></p>
</div>
</div>
</div>
</div>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/js/mansory.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
$('.grid').masonry({
    // options
    itemSelector: '.grid-item',
    columnWidth: 89
});
</script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>

<?php if(isset($_GET['page']) && $_GET['page'] == "dashboard") : ?>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<?php endif; ?>


</body>

</html>