<!DOCTYPE html>
<head>
<title>Triangle Archive</title>
<meta charset="utf-8" />
<link href='http://fonts.googleapis.com/css?family=Lora:400,400italic|Ubuntu:700' rel='stylesheet' type='text/css'>
<style type="text/css">
    /* general */    
    body {
        font-family: 'Lora', serif;
        background-color: black;
        color: white;
    }
    
    a {
        color: #aaf;
    }
    
    a:hover {
        color: #fff;
    }
    
    .filename {
        font-family: 'Courier New', sans-serif;
    }
    
    #content {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        padding: 0;
    }
    
    h1, h2, h3, h4, h5 {
        font-family: 'Ubuntu', sans-serif;
    }
    
    h3, h4 {
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    h1, h2, #footer {        
        width: 100%;
        background-color: #414;        
        padding-top: 2px;
        padding-bottom: 2px;
        color: white;
        text-align: center;
    }
    
    #header {
        position:absolute;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-top: 0;
    }
    
    .animation-name {
        font-family: 'Ubuntu', sans-serif;
        font-weight: 700;
    }
    
    .animation-play-canvas {
        position: absolute;
    }    
    
    .name-cell {
        white-space: nowrap;
    }
    
    .librariesList a {
        padding-right: 1em;
    }
    
    #animationsTable {
        padding: 0;
        overflow: hidden;
        margin: 0 auto;
    }
    
    .descript-cell {
        padding-left: 0.5em;
        padding-right: 0.5em;
    }
    
    .row[data-mode="mosaic"]>.name-desc-cell {
        display: none;
    }
    
    .row[data-mode="expanded"] {
        display: inline-table;
    }
    
    .row[data-mode="mosaic"] {
        display: inline-block;
        vertical-align: top;
        margin: 0;
        padding: 0;
    }
    
    .row[data-mode="mosaic"]>.preview-cell {
        display: block;
    }
    
    .row[data-mode="mosaic"]>.cell {
        vertical-align: top;
    }
    
    .row[data-mode="expanded"]>.cell {
        display: table-cell;
        vertical-align: middle;
    }
    
    .noscript-name-desc-cell {
        padding-top: 2ex;
        position: relative;
        width: 330px;
        top: -330px;
    }
    
    .animation-link {
        color: #79f;
        text-decoration: none;
    }
    
    .animation-link:hover {
        color: #79f;
        text-decoration: underline;
    }    
    
    /* default: large 1000+ */
    #content {
        width: 1000px;
    }
    
    .row[data-mode="expanded"] {
        width: 660px;   /* content width * 2/3 */
        height: 330px;  /* content width * 1/3 */
    }
    
    .row[data-mode="mosaic"],
    .animation-preview,
    .animation-play-canvas,
    .noscript-name-desc-cell {
        width: 330px;   /* content width * 1/3 */
        height: 330px;  /* content width * 1/3 */
    }
    
    .noscript-name-desc-cell {
        top: -330px;    /* content widht * 1/3 */
        padding-top: 1.4ex;
    }
    
    .name-cell {
        padding-left: 0.5em;
        padding-bottom: 0;
        margin: 0;
    }
    
    .animation-name {
        font-size: 40pt;
    }
    
    .descript-cell {
        font-size: 14pt;
        margin: 0;
    }
    
    /* medium-large screens: 640-1000 width */
    @media (max-width: 1000px) {
        #content {
            width: 640px;
        }
        
        .row[data-mode="expanded"] {
            width: 426px;   /* content width * 2/3 */
            height: 213px;  /* content width * 1/3 */
        }
        
        .row[data-mode="mosaic"],
        .animation-preview,
        .animation-play-canvas,
        .noscript-name-desc-cell {
            width: 210px;   /* content width * 1/3 */
            height: 210px;  /* content width * 1/3 */
        }
        
        .noscript-name-desc-cell {
            top: -210px;    /* content widht * 1/3 */
            padding-top: 1.4ex;
        }
        
        .name-cell {
            padding-left: 0.5em;
            padding-bottom: 0;
            margin: 0;
        }
        
        .animation-name {
            font-size: 30pt;
        }
        
        .descript-cell {
            font-size: 11pt;
            margin: 0;
        }     
    }
    
    /* medium screens: 480-640 width */
    @media (max-width: 640px) {
        #content {
            width: 480px;
        }
        
        .row[data-mode="expanded"] {
            width: 320px;   /* content width * 2/3 */
            height: 160px;  /* content width * 1/3 */
        }
        
        .row[data-mode="mosaic"],
        .animation-preview,
        .animation-play-canvas,
        .noscript-name-desc-cell {
            width: 156px;   /* content width * 1/3 */
            height: 156px;  /* content width * 1/3 */
        }
        
        .noscript-name-desc-cell {
            top: -156px;    /* content widht * 1/3 */
            padding-top: 1.4ex;
        }
        
        .name-cell {
            padding-left: 0.5em;
            padding-bottom: 0;
            margin: 0;
        }
        
        .animation-name {
            font-size: 24pt;
        }
        
        .descript-cell {
            font-size: 10pt;
            margin: 0;
        }     
    }
    
    /* small screens: 480 width */
    @media (max-width: 480px) {
        #content {
            width: 320px;            
        }
    
        .row[data-mode="expanded"] {
            width: 212px;   /* content width * 2/3 */
            height: 106px;  /* content width * 1/3 */
        }
        
        .row[data-mode="mosaic"],
        .animation-preview,
        .animation-play-canvas,
        .noscript-name-desc-cell {
            width: 103px;   /* content width * 1/3 */
            height: 103px;  /* content width * 1/3 */
        }
        
        .noscript-name-desc-cell {
            top: -103px;    /* content widht * 1/3 */
            padding-top: 1.4ex;
        }
        
        .name-cell {
            padding-left: 0.5em;
            padding-bottom: 0;
            margin: 0;
        }
        
        .animation-name {
            font-size: 14pt;
        }
        
        .descript-cell {
            font-size: 8pt;
            margin: 0;
        }                
    }
       
</style>    
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<div id="content">
    <h1 id="header">Triangle Archive</h1>
    
    
    
    <?php
        $directory = "a";
        $animations = scandir($directory);    
    ?>
    
    <div id="animationsOverview">
        <h2>Overview of Animations</h2>
        <div id="animationsTable">
            <?php
                foreach (array_slice($animations, 2) as $name) {
                    $gif_url = "$directory/$name/screencap.gif";
                    $img_url = "$directory/$name/screenshot.png";
                    $txt_url = "$directory/$name/description.txt";
            ?>
                <div class="row" data-mode="mosaic">
                    
                    
                    <div class="cell preview-cell">
                        <canvas class="animation-play-canvas" width="250" height="250">
                            <a href="<?php echo $gif_url; ?>"
                                class="nocanvas-play-link">
                                Play .gif
                            </a>
                        </canvas>
                        <img class="animation-preview"
                            src="<?php echo $img_url; ?>" 
                            data-name="<?php echo $name; ?>"
                            data-gif-url="<?php echo $gif_url; ?>"
                            data-img-url="<?php echo $img_url; ?>" 
                            alt="<?php echo $name; ?>"  />                        
                    </div>
                    
                    <noscript>
                        <div class="cell noscript-name-desc-cell">
                            <div class="cell name-cell">
                                <a class="animation-link animation-name"
                                    href="<?php echo "$directory/$name"; ?>">
                                    <?php echo $name; ?>
                                </a>
                            </div>
                            
                            <div class="cell descript-cell">
                                <p class="animation-description">
                                    <?php echo file_get_contents($txt_url); ?>
                                </p>
                            </div>
                        </div>
                    </noscript>
                    
                    <div class="cell name-desc-cell">
                        <div class="cell name-cell">
                            <a class="animation-link animation-name"
                                href="<?php echo "$directory/$name"; ?>">
                                <?php echo $name; ?>
                            </a>
                        </div>
                        
                        <div class="cell descript-cell">
                            <p class="animation-description">
                                <?php echo file_get_contents($txt_url); ?>
                            </p>
                        </div>
                    </div>
                </div>
            
            <?php
                }            
            ?>            
        </div>
    </div>
    
    <div id="introText">
        <h1>About the Archive</h1>
        <p>Welcome to the archive of triangle animations! All the animations
        are produced with HTML5's canvas and JavaScript. A screenshot and
        <span class="filename">.gif</span> preview animation are provided. Visit the links to see the
        animation in full. All the samples are self-contained in their 
        directories, and they consist of an 
        <span class="filename">index.html</span> file, and a
        <span class="filename">game.js</span> file, describing the program.
        Some might be controllable. Everything is free to use and reuse for 
        anything, by anyone.</p>
        
        <h3>Libraries</h3>
        <p>Currently only one library is used to produce the animations.</p>
        
        <ul class="librariesList">
            <li><a href="underscorejs.org">Underscore.js</a> Underscore is a 
                library for manipulating data structures. I use it because I 
                like higher-order list operations and I don't feel entirely
                convinced that every browser supports them.</li>
        </ul>        
        
        <p>For making this portal site, another library was used.</p>
        
        <ul class="librariesList">
            <li><a href="jquery.com">jQuery</a> jQuery is (mainly) a library
                for manipulating DOM elements, and it abstracts away many
                browser differences. I use it because it makes handling the
                preview images and such very easy.</li>
        </ul>
    </div>
    
    <div id="footer">
        Last modified: 
        <?php echo date ("F d Y H:i:s.", getlastmod()); ?>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var previews = $('.preview-cell');
        
        function drawPlayIcon(ctx, x, y, r, a) {
            ctx.fillStyle = 'rgba(255, 255, 255, ' + a + ')';
            ctx.beginPath();
            ctx.arc(x, y, r, 0, 2 * Math.PI, false);
            ctx.arc(x, y, r - r / 4, 0, 2 * Math.PI, true);
            ctx.fill();
            
            ctx.fillStyle = 'rgba(0, 0, 0, ' + a + ')';
            ctx.beginPath();
            ctx.arc(x, y, r - r / 4, 0, 2 * Math.PI, true);
            ctx.fill();
            
            ctx.fillStyle = 'rgba(255, 255, 255, ' + a + ')';
            ctx.beginPath();
            var rArrow = r - r/4;
            ctx.moveTo( x + Math.cos(2 * Math.PI) * rArrow, 
                        y + Math.sin(2 * Math.PI) * rArrow);
            ctx.lineTo( x + Math.cos(2 * Math.PI * 1/3) * rArrow,
                        y + Math.sin(2 * Math.PI * 1/3) * rArrow);
            ctx.lineTo( x + Math.cos(2 * Math.PI * 2/3) * rArrow,
                        y + Math.sin(2 * Math.PI * 2/3) * rArrow);
            ctx.closePath();
            ctx.fill();
        }
        
        function drawSmallPlayIcon(canvas) {
            var w = canvas.width,
                h = canvas.height,
                ctx = canvas.getContext('2d');
                
            var smallPlayR = 40;
            var buffer = 10;
            
            drawPlayIcon(ctx, buffer + smallPlayR, h - smallPlayR - buffer, smallPlayR, 0.25);
        }
        
        function drawLargePlayIcon(canvas) {
            var w = canvas.width,
                h = canvas.height,
                ctx = canvas.getContext('2d');
                
            var buffer = 10;
            
            drawPlayIcon(ctx, w / 2, h / 2, Math.min(w, h) / 2 - buffer, 0.2);
        }
        
        function clear(canvas) {
            var w = canvas.width,
                h = canvas.height,
                ctx = canvas.getContext('2d');
                
            ctx.clearRect(0, 0, w, h);
        }
        
        var Load = (function () {
            var loaders = [];
            var circleSpeed = 0.01;
            
            function start(canvas) {
                if (!isLoading(canvas)) {
                    var loader = {
                        canvas: canvas,
                        timeout: null,
                        value: 0,
                        stop: function() {
                            stop(canvas);
                        }
                    };
                    loaders.push(loader);
                    draw(loader);
                    
                    var fps = 60;
                    
                    var step = function() {
                        update(loader);
                        draw(loader);
                        
                        loader.timeout = setTimeout(function() { step(); }, 1000 / fps);
                    }
                    step();
                }
            }
            
            function update(loader) {
                loader.value += circleSpeed;
            }
            
            function draw(loader) {
                /* value between 0 and 1 indicates angle */
                var numDots = 16;
                var dotSize = 8;
                var buffer = 40;
                
                var w = loader.canvas.width,
                    h = loader.canvas.height;
                    
                var r = Math.min(w, h) / 2 - dotSize - buffer;
                
                clear(loader.canvas);
                
                var ctx = loader.canvas.getContext('2d');
                var v = loader.value % 1;
                
                for (var i = 0; i < numDots; i++) {
                    ctx.fillStyle = 'rgba(255, 255, 255, ' + (0.4 - 0.3 * (((v * numDots) + (numDots - i)) % numDots) / numDots) + ')';
                    ctx.beginPath();
                    ctx.arc(h / 2 + Math.cos(i / numDots * 2 * Math.PI) * r,
                            w / 2 + Math.sin(i / numDots * 2 * Math.PI) * r,
                            dotSize, 0, 2*Math.PI, false);
                    ctx.fill();
                }
                
            }
            
            function findLoaderIndex(canvas) {
                for (var i = 0; i < loaders.length; i++) {
                    if (loaders[i].canvas === canvas) return i;
                }
                return undefined;
            }
            
            function stop(canvas) {
                var i = findLoaderIndex(canvas);
                if (i !== undefined) {
                    clear(canvas);
                    clearTimeout(loaders[i].timeout);
                    loaders = loaders.slice(0, i).concat(loaders.slice(i + 1));
                }
            }
            
            function isLoading(canvas) {
                return findLoaderIndex(canvas) !== undefined;
            }
                
            return {
                start: start,
                stop: stop,
                isLoading: isLoading
            };
        }());
        
        function play(img) {
            $(img).attr('src', $(img).attr('data-gif-url'));
        }
        
        function stop(img) {
            $(img).attr('src', $(img).attr('data-img-url'));
        }
        
        function isPlaying(img) {
            return $(img).attr('src') === $(img).attr('data-gif-url');
        }
        
        function mosaicAll() {
            var rows = $('.row');
            rows.each(function(i, r) {
                $(r).attr('data-mode', 'mosaic');
                var img = $(r).find('.animation-preview');
                stop(img);
                var canvas = $(r).find('.animation-play-canvas')[0];
                clear(canvas);
                drawSmallPlayIcon(canvas);
            });
        }
        
        function inCanvas(canvas, x, y) {            
            var rect = canvas.getBoundingClientRect();
            return  x > rect.left && x < rect.right &&
                    y > rect.top  && y < rect.bottom;
        }
        
        previews.each(function(i, p) {
            var preview = p;
            var img = $(preview).find('.animation-preview');
            
            // no canvas
            var nocanvasLink = $(preview).find('.nocanvas-play-link');
            $(nocanvasLink).on('click', function(evt) {
                evt.preventDefault();
                play(img);
            });
            
            var canvas = $(preview).find('.animation-play-canvas')[0];
            drawSmallPlayIcon(canvas);
            
            var row = $(canvas).closest('.row');
            
            $(canvas).on('mouseenter', function() {
                if (!isPlaying(img) && row.attr('data-mode') !== 'mosaic') {
                    clear(canvas);
                    drawLargePlayIcon(canvas);
                }
            });
            
            $(canvas).on('mouseleave', function() {
                if (!isPlaying(img)) {
                    clear(canvas);
                    drawSmallPlayIcon(canvas);
                }
            });
            
            $(canvas).on('click', function(e) {
                if (row.attr('data-mode') === 'mosaic') {
                    mosaicAll();
                    row.attr('data-mode', 'expanded');
                    if (inCanvas(canvas, e.clientX, e.clientY)) {
                        clear(canvas);
                        drawLargePlayIcon(canvas);
                    }
                } else {
                    if (isPlaying(img)) {
                        Load.stop(canvas);
                        stop(img);
                        clear(canvas);
                        if (row.attr('data-mode') === 'mosaic')
                            drawSmallPlayIcon(canvas);
                        else
                            drawLargePlayIcon(canvas);
                    } else {
                        loader = Load.start(canvas);                  
                        play(img);
                        img.on('load', function() { Load.stop(canvas); });
                        clear(canvas);
                    }
                }
            });
        });
    });
</script>
</body>