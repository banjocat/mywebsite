<?php include 'header.php';?>
<h5>Conway's Life</h5>
<p>
This is a Jquery plugin I wrote that will
create a random Conway's Life board of a size specificed.
I have two smaller boards below. To see it pushing its
extreme at 60x60 go <a href='big_life.php'>here</a>
</p>

<h5>A 5 by 5 board</h5>
<div id='10x10-life'>
</div>
<button id='10x10-restart'>
Restart
</button>
<h5>A 25 by 25 board</h5>
<div id='25x25-life'>
</div>
<button id='25x25-restart'>
Restart
</button>

<script src='assets/underscore-min.js'></script>
<script src='assets/pixi.js'></script>
<script src='assets/life.js'></script>
<script src='assets/graphic-life.js'></script>
<script>
$(document).ready(function()
    {
        var life_5 = $('#10x10-life').Life({
            xmax:10,
            ymax:10,
            box_size:20,
        });
        var life_25 = $('#25x25-life').Life({
            xmax:25,
            ymax:25,
            box_size:10,
        });

        $('#10x10-restart').click(function() {
            life_5.restart();
        });

        $('#25x25-restart').click(function() {
            life_25.restart();
        });
    });
</script>

<?php include 'footer.php';?>