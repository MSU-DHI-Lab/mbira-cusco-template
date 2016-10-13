<?php
include 'lib/site.php';
include 'app/inc/head.php';
include 'app/inc/left-sidebar.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if($id == 0) {
        $id = 1;
    }
    $exhibit = $exhibits->get($id);
}else {
    header('Location: ./exhibits.php');
}
?>


<div class="main">

    <div class="exhibit-img">
        <div class="container">
            <div class="exhibit-title">
                <h1><?php echo $exhibit->getName(); ?></h1>
            </div>
        </div>
    </div>

    <div class="container exhibit-description">
        <p>
            <?php echo "This Exhibit Currently Doesn't Have Any Content"; ?>
        </p>
    </div>


    </div>

</div>

<?php
include 'app/inc/footer.php';
?>
