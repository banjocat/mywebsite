<?php include 'header.php';?>
<div id='game-instructions' class='right-panel'>
Loading . . .
</div>
<canvas width=400 height=400 id="canvas" ></canvas>

<script>

function createArray(length) {
    var arr = new Array(length || 0),
        i = length;

    if (arguments.length > 1) {
        var args = Array.prototype.slice.call(arguments, 1);
        while (i--) arr[length - 1 - i] = createArray.apply(this, args);
    }

    return arr;
}

function SpaceInvaderStart() {

    var back;

    this.setup = function() {
        back = new jaws.Sprite( {image: "start.png", x:0, y:0 } );
        $('#game-instructions').html( 
            "Move with (d f) or (j k), space to fire. " +
            "It is based off the old game space invaders. " +
            "It was written in javascript using the " +
            "<a href='http://www.jawsjs.com'>jaws.js</a> game engine. " +
            "It is a very simple engine and I recommend it for quick games.");
    }

    this.update = function() {

        if (jaws.pressed("space") ) {
            jaws.switchGameState(SpaceInvaderGame);
        }
    }

    this.draw = function() {
        jaws.clear();
        back.draw();
    }
}

function SpaceInvaderWinner() {

    var back,
        newGameCountDown;  // To prevent skipping over space if killed mid fire

    this.setup = function() {
        newGameCountDown = 40;
        back = new jaws.Sprite( {image: "win.png", x: 0, y: 0} );
    }

    this.update = function() {

        if (newGameCountDown > 0) {
            newGameCountDown += -1;
        }

        if (newGameCountDown <= 0 && jaws.pressed("space") ) {

            if (newGameCountDown <= 0) {
                jaws.switchGameState(SpaceInvaderGame);
            }
        }
    }

    this.draw = function() {
        jaws.clear();
        back.draw();
    }
}

function SpaceInvaderGameOver() {

    var back,
        newGameCountDown;  // To prevent skipping over space if killed mid fire

    this.setup = function() {
        newGameCountDown = 40;
        back = new jaws.Sprite( {image: "end.png", x: 0, y: 0} );
    }

    this.update = function() {

        if (newGameCountDown > 0) {
            newGameCountDown += -1;
        }

        if (newGameCountDown <= 0 && jaws.pressed("space") ) {

            if (newGameCountDown <= 0) {
                jaws.switchGameState(SpaceInvaderGame);
            }
        }
    }

    this.draw = function() {
        jaws.clear();
        back.draw();
    }
}

function SpaceInvaderGame() {


    var HEIGHT = $('#canvas').attr('height'),
        WIDTH =  $('#canvas').attr('width'),
        BOX_START_OFFSET = HEIGHT / 40, // How far the player is from the bottom
        PLAYER_SPEED = 4,
        BOX_WIDTH = WIDTH / 12,
        BOX_HEIGHT = BOX_WIDTH / 3,
        BULLET_SIZE = BOX_WIDTH / 4,
        BADGUY_SIZE = BULLET_SIZE * 2,
        BADGUY_SPACE_BETWEEN = BADGUY_SIZE,
        BADGUY_DOWN_SPEED = 20,
        BADGUY_STARTING_SPEED = 1,
        BADGUY_SPEED_INCREASE_ON_DEATH = 1.08,
        BADGUY_NUMBER_X = 6,
        BADGUY_NUMBER_Y = 4,
        BULLET_SPEED = 5,
        RATE_OF_FIRE = 20,
        player = {},
        box = new jaws.Rect(0, HEIGHT - BOX_HEIGHT - BOX_START_OFFSET, BOX_WIDTH, BOX_HEIGHT),
        badGuys = {},
        bullet = false;

    badGuys.list = createArray(BADGUY_NUMBER_X, BADGUY_NUMBER_Y);

    badGuys.setup = function() {

        this.speed = BADGUY_STARTING_SPEED;
        this.direction = 1;
        this.goDown = false;

        for (var i = 0; i < BADGUY_NUMBER_X; i += 1) 
            for (var j = 0; j < BADGUY_NUMBER_Y; j += 1) 
                badGuys.list[i][j] =  new jaws.Rect( 
                        i * ( BADGUY_SIZE + BADGUY_SPACE_BETWEEN), j * (BADGUY_SIZE + BADGUY_SPACE_BETWEEN), BADGUY_SIZE, BADGUY_SIZE);
    };

    badGuys.drawAll =  function() {
        for (var i = 0; i < BADGUY_NUMBER_X; i += 1) 
            for (var j = 0; j < BADGUY_NUMBER_Y; j += 1) 
                if (badGuys.list[i][j] ) {badGuys.list[i][j].draw(); }
    };


    badGuys.updateAll = function() {

        var xCheck = 0,
            goDownNow = badGuys.goDown,
            currentDirection = badGuys.direction,
            winner = true;

        for (var i = 0; i < BADGUY_NUMBER_X; i += 1) {
            for (var j = 0; j < BADGUY_NUMBER_Y; j += 1)  {

                if (badGuys.list[i][j] ) {

                    if (box && box.collideRect(badGuys.list[i][j]) ) {
                        winner = false;
                        jaws.switchGameState(SpaceInvaderGameOver);
                    }
                    else if (bullet && bullet.collideRect(badGuys.list[i][j]) ) {
                        badGuys.list[i][j] = false;
                        bullet = false;
                        badGuys.speed *= BADGUY_SPEED_INCREASE_ON_DEATH;
                    }
                    else if (goDownNow === true) {
                        winner = false;
                        badGuys.goDown = false;
                        badGuys.list[i][j].move(0, BADGUY_DOWN_SPEED);

                        if (badGuys.list[i][j].y >= HEIGHT) {
                            jaws.switchGameState(SpaceInvaderGameOver);
                        }
                    }
                    else {
                        winner = false;
                        badGuys.list[i][j].move(badGuys.speed * currentDirection, 0);
                        xCheck = badGuys.list[i][j].x;

                        if (currentDirection > 0 && xCheck >= (WIDTH - BADGUY_SIZE) ) {
                            badGuys.direction = -1;
                            badGuys.goDown = true;
                        }
                        else if (currentDirection <= 0 && xCheck < 0) {
                            badGuys.direction = 1;
                            badGuys.goDown = true;
                        }
                    }                

                }
            }
        }
        if (winner) {
            jaws.switchGameState(SpaceInvaderWinner);
        }
    }

    this.setup = function() {
        player.reloadWait = 0;
        badGuys.setup();
    }

    this.update = function() {

        if (jaws.pressed("d") || jaws.pressed("j") ) {

            if (box.x >= PLAYER_SPEED)
                box.move(PLAYER_SPEED * -1, 0);
            else
                box.moveTo(0, box.y);
        }

        if (jaws.pressed("f") || jaws.pressed("k")) {

            if (box.x < (WIDTH - BOX_WIDTH) ) {
                box.move(PLAYER_SPEED, 0);
            }
            else {
                box.moveTo(WIDTH - BOX_WIDTH, box.y);
            }
        }

        if (jaws.pressed("space") && player.reloadWait == 0 ) {
            if (bullet == false)  {
                bullet = new jaws.Rect( (box.x + (BOX_WIDTH / 2) - (BULLET_SIZE / 2 ) ), box.y, BULLET_SIZE, BULLET_SIZE);
            }
        }

        if (bullet) {
            bullet.move( 0,  BULLET_SPEED * -1);

            if ( (bullet.y + BULLET_SIZE) <= 0) {
                bullet = false;
            }
        }

        badGuys.updateAll();

    }


    this.draw = function() {
        jaws.clear();
        $('#canvas').css("background", "black");
        box.draw();

        if (bullet) {
            bullet.draw();
        }
        badGuys.drawAll();

    }
}

jaws.assets.add("start.png");
jaws.assets.add("end.png");
jaws.assets.add("win.png");
jaws.start(SpaceInvaderStart);
</script>
