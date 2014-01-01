var game = {
    timeouts: [],
    canvasListeners: [],
    backgroundColor: 'black',
    objects: [],
    currentMousePosition: {x: 0, y: 0},

    create: function(
        canvas,
        dom
    ) { 
        return _(this).extend({
            canvas: canvas,
            dom: dom
        });
    },
    
    init: function() {
        var s = this;
        
        s.canvas.onclick = function(evt) {
            _(s.canvasListeners).each(function(fun) {
                fun(evt);
            });
        };
        
        s.canvas.addEventListener('mousemove', function(evt) {
            var rect = s.canvas.getBoundingClientRect();
            s.currentMousePosition = {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }, false);
        
        s.canvas.addEventListener('mouseleave', function(evt) {
            s.currentMousePosition = {
                x: -1000,
                y: -1000
            };
        }, false);
        
        s.addCanvasListener(function(evt) { 
            var rect = s.canvas.getBoundingClientRect();
            s.clickObject(evt.clientX - rect.left, evt.clientY - rect.top); 
        });
        
        s.width = canvas.width;
        s.height = canvas.height;
        s.context = canvas.getContext('2d');
        
        s.constants = {
            gravity: 0.01
        };
        
        var adjFunc = function() { s.adjust(); };
        
        s.adjust();
        
        s.play();
        s.generate();   
    },
    
    generate: function() {
        var s = this;
        
        s.createWorld();
    },
    
    adjust: function() {
        var s = this;
    },
    
    addCanvasListener: function(callback) {
        var s = this;
        s.canvasListeners.push(callback);
    },
    
    checkMoveTimers: function() {
        var s = this;
        var resolved = [];
        _(s.timeouts).each(function(t) {
            if (s.steps >= t.init + t.steps) {
                t.callback();
                resolved.push(t);
            }
        });
        _(resolved).each(function(t) {
            s.timeouts = _(s.timeouts).without(t);
        });
    },
    
    play: function() {
        var s = this;
        
        s.steps = 0;
        s.fps = 60;
    
        window.requestAnimFrame = (function() {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
            function(callback) {
                window.setTimeout(callback, 1000 / s.fps);
            };
        })();
        
        s.start = new Date();
        s.clock = 0;
        var step = function() {
            var start = new Date();
            //update
            s.update();
            
            //clear
            s.clear();
            
            //draw
            s.draw();
            
            var now = new Date();
            var time = now - start;
            s.clock = now - s.start;
            
            requestAnimFrame(function() {
                step();
            });
        };
        step();
    },
    
    clickObject: function(x, y) {
        var s = this;
        var nonselected = true;
        _(s.objects).each(function(o) {
            if (o.containsPoint(x, y) && nonselected) {
                o.click();
                nonselected--;
            } else {
                o.unclick();
            }
        });
    },
    
    createWorld: function() {
        var s = this;
        
        var objUpdate = function(antimagnet_position) {
            this.position.x += this.velocity.x;
            this.position.y += this.velocity.y;
            
            var d = Trig.diff(this.g_center, this.position);
            var r = Trig.size(d);
            
            this.velocity.x += d.x / r * s.constants.gravity;
            this.velocity.y += d.y / r * s.constants.gravity;
        }
        
        var newObj = function(g_center, position, velocity, r, c, polygonFunc, drawFunc, containsPointFunc) {
            return {
                g_center: g_center,
                speed: 0,
                size: r,
                color: c,
                velocity: velocity,
                position: position,
                observing: false,
                polygon: polygonFunc,
                containsPoint: containsPointFunc,
                draw: function() {
                    s.context.beginPath();
                    drawFunc.apply(this);
                    s.context.closePath();
                    s.context.fillStyle = this.color;
                    s.context.fill();
                    s.context.lineWidth = 2;
                    if (this.observing) s.context.stroke();
                },
                click: function() { this.observing = true; },
                unclick: function() { this.observing = false; },
                updateFunc: objUpdate
            }
        };
        
        var newTriangle = function(g_center, pos, r, c) {
            var velocity = (function() {                
                var diff = Trig.diff(pos, g_center);
                var a = s.constants.gravity;
                var r = Trig.size(diff);
                var v = Math.sqrt(a*r);
                if (r > 0) {
                    var rotated = Trig.rotate(diff, Math.PI/2)
                    
                    var v_vector = Trig.scale(rotated, v);
                    
                    return v_vector;
                }
                return {x: 0, y: 0};
            }());
            
            var polygonFunc = function() {
                var x = this.position.x,
                    y = this.position.y,
                    r = this.size,
                    d = Trig.direction(this.velocity);
                return [{
                        x: x + Math.cos(d) * 2*r,
                        y: y + Math.sin(d) * 2*r
                    }, {
                        x: x + Math.cos(d + 1/3 * 2 * Math.PI) * r, 
                        y: y + Math.sin(d + 1/3 * 2 * Math.PI) * r
                    }, {
                        x: x + Math.cos(d + 2/3 * 2 * Math.PI) * r, 
                        y: y + Math.sin(d + 2/3 * 2 * Math.PI) * r
                    }                    
                ];
            }
            
            var drawFunc = function() {
                var points = this.polygon();
                s.context.moveTo(points[0].x, points[0].y);
                _(points.slice(1)).each(function(p) {
                    s.context.lineTo(p.x, p.y);
                });
                
                if (this.observing) {
                    var x = this.position.x,
                        y = this.position.y,
                        r = Trig.size(Trig.diff(this.position, this.g_center)),
                        v = this.velocity;
                    
                    var round = function(value, precision) {
                        return Math.round(value * Math.pow(10, precision)) 
                            / Math.pow(10, precision);
                    }
                        
                    s.dom.vSpan.innerHTML = round(Trig.size(this.velocity), 5);
                    s.dom.aSpan.innerHTML = round(Trig.size({
                        x: v.x / r * s.constants.gravity,
                        y: v.y / r * s.constants.gravity
                    }), 5);
                }
                
                var d = Trig.diff(this.g_center, this.position);
                var r = Trig.size(d);
                var a = Math.acos(d.x / r);
            };
            
            var containsPointFunc = function(x, y) {            
                var p = this.polygon();
                var A = 0.5*(-p[1].y * p[2].x + p[0].y * (-p[1].x + p[2].x) + p[0].x * (p[1].y - p[2].y) + p[1].x * p[2].y);
                var s = 1/(2*A) * (p[0].y * p[2].x - p[0].x * p[2].y + (p[2].y - p[0].y) * x + (p[0].x - p[2].x) * y);
                var t = 1/(2*A) * (p[0].x * p[1].y - p[0].y * p[1].x + (p[0].y - p[1].y) * x + (p[1].x - p[0].x) * y);
                return s >= 0 && t >= 0 && (1 - s - t) >= 0;
            };
            
            return newObj(g_center, pos, velocity, r, c, polygonFunc, drawFunc, containsPointFunc);
        };
        
        
        s.objects = [];
        var center = {x: s.width / 2., y: s.height / 2};
        var distance = {
            start: 10, 
            stop: Math.sqrt(Math.pow(s.width/2, 2) + Math.pow(s.height/2, 2)) + 40, 
            step: 30
        };
        _(_.range(distance.start, distance.stop, distance.step)).each(function(r) {
            var numTriangles = 10;
            _(_.range(0, numTriangles)).each(function(i) {
                s.objects.push(newTriangle(
                    center,
                    {
                        x: center.x + Math.cos(2 * Math.PI * i/numTriangles) * r,
                        y: center.y + Math.sin(2 * Math.PI * i/numTriangles) * r
                    },
                    1.6*Math.pow(Math.log(r), 2),
                    Color.gradient(
                        '#ffffff',
                        Color.gradient('#ffffff', '#ffffff', Math.sin(i/numTriangles * Math.PI * 8)), 
                        r/(distance.stop - distance.start))
                    /*Color.gradient(
                        '#000000',
                        Color.gradient('#f00000', '#ff00ff', Math.sin(i/numTriangles * Math.PI * 8)), 
                        r/(distance.stop - distance.start))*/
                ));
            });        
        });       
    },
    
    draw: function() {
        var s = this;
        s.context.beginPath();
        s.context.rect(0, 0, s.width, s.height);
        s.context.fillStyle = s.backgroundColor;
        s.context.fill();
        
        //draw shapes
        _(s.objects).each(function(obj) {
            obj.draw();
        });
    },
    
    clear: function() {
        var s = this;
        s.context.clearRect(0, 0, s.canvas.width, s.canvas.height);
    },
    
    update: function() {
        var s = this;
        
        _(s.objects).each(function(obj) {
            obj.updateFunc();
        });
        
        //console.log(s.currentMousePosition);
        
        s.steps++;
        s.checkMoveTimers();
    },
};

var Color = (function() {
    var prepad = function(str, min_length, padding) {
        if (str.length >= min_length) return str;
        return prepad(padding + str, min_length, padding);
    };
    
    var hex = function(base10number) {
        return (~~(base10number)).toString(16);
    };
    
    var toColor = function(r, g, b) {
        return '#' + _(arguments).map(function(val) {
            return  prepad(hex(val), 2, '0');
        }).join('');
    }
    
    var toValue = function(color) {
        if (color[0] === '#') color = color.slice(1);
        if (color.length === 3) return [
            parseInt(color.slice(0, 1),  16),
            parseInt(color.slice(1, 2),  16),
            parseInt(color.slice(2),     16)
        ];
        if (color.length === 6) return [ 
            parseInt(color.slice(0, 2),  16),
            parseInt(color.slice(2, 4),  16),
            parseInt(color.slice(4),     16)
        ];
        return "Error: not a valid color";
    }
    
    var gradient = function(min, max, value) {
        // min: color, max: color, value: [0,1]
        var min_value = toValue(min);
        var max_value = toValue(max);
        return toColor.apply(null, 
            _(_.zip(min_value, max_value)).map(function(z) {
                return z[0] + value * (z[1] - z[0]);
            })
        );
    }

    var randomColor = (function() {
        var random_hex = function(max) { 
            return hex(Math.random()*max);
        };
        
        return function() {
            return '#' + prepad(random_hex(Math.pow(16, 3)), 3, '0');
        };
    }());
    
    return {
        random: randomColor,
        gradient: gradient
    };
}());

var Trig = {
    size: function(vector) {
        return Math.sqrt(Math.pow(vector.x, 2) + Math.pow(vector.y, 2));
    },
    
    diff: function(vector1, vector2) {
        return {x: vector1.x - vector2.x, y: vector1.y - vector2.y};
    },
    
    dprod: function(vector1, vector2) {
        return vector1.x * vector2.x + vector1.y * vector2.y;
    },
    
    dirvector: {x: 1, y: 0},
    
    angle: function(vector1, vector2) {
        return Math.acos(Trig.dprod(vector1, vector2) / (Trig.size(vector1)*Trig.size(vector2)));
    },
    
    direction: function(vector1) {
        var d = this.angle(vector1, this.dirvector)
        return vector1.y < 0 ? Math.PI * 2 - d : d;
    },
    
    rotate: function(vector, angle) {
        return {
            x: vector.x * Math.cos(angle) - vector.y * Math.sin(angle),
            y: vector.x * Math.sin(angle) + vector.y * Math.cos(angle)
        };
    },
    
    scale: function(vector, size) {
        var v_size = this.size(vector);
        return {
            x: vector.x / v_size * size,
            y: vector.y / v_size * size
        };
    },
    
    toString: function(vector, label) {
        return (label !== undefined ? label + ' = ' : '') 
            + '{x: ' + vector.x + ', y: ' + vector.y + '}, '
            + (label !== undefined ? '|' + label + '|' : 'size') + 
                ' = ' + this.size(vector);
    }
}