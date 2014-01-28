<?php include 'header.php';?>
<h5>60x60 Conway's Life</h5>
<p>
This is where it starts to slow down.
Eventually as the cell number goes down it speeds back up.
It only checks cells that are alive so less cells means
quicker.
</p>
<p>
How large it really can go is dependant on what is running it.
An ipad would have a hard time running this 60x60 but can handle
the previous just fine. A decent desktop will run the below.
</p>
<div id='life'>
</div>
<button id='restart'>
Restart
</button>
<script src='assets/underscore-min.js'></script>
<script src='assets/pixi.js'></script>
<script src='assets/life.js?v=1'></script>
<script src='assets/graphic-life.js?v=1'></script>

<script>
$(document).ready(function() {
    var life = $('#life').Life({
        xmax:60,
        ymax:60,
        box_size:10,
    });
    $('#restart').click(function() {
        life.restart();
    });
});
</script>
<?php include 'footer.php';?>
