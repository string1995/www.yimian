console.clear();
var GAME_STATES;
(function (GAME_STATES) {
    GAME_STATES["ready"] = "READY";
    GAME_STATES["playing"] = "PLAYING";
    GAME_STATES["ended"] = "ENDED";
    GAME_STATES["paused"] = "PAUSED";
})(GAME_STATES || (GAME_STATES = {}));
var SOUND;
(function (SOUND) {
    SOUND["move"] = "move";
    SOUND["dead"] = "dead";
    SOUND["collect"] = "collect";
    SOUND["start"] = "start";
})(SOUND || (SOUND = {}));
var App = /** @class */ (function () {
    function App() {
        this.setupUI();
        this.setupGame();
    }
    App.prototype.setupUI = function () {
        var _this = this;
        this.score = document.getElementById('score');
        this.container = document.getElementById('container');
        this.boardContainer = document.getElementById('board-container');
        var startButton = Rx.Observable.fromEvent(document.getElementById('start-button'), 'click');
		
        startButton.subscribe(function (e) { console.log('click'); _this.startGame(); });
    };
    App.prototype.setupGame = function () {
        var _this = this;
        var board = document.getElementById('board');
        this.game = new Snake(board);
        this.game.score.subscribe(function (score) { return _this.score.innerHTML = String(score); });
        this.game.state.subscribe(function (state) {
            _this.gameState = state;
            _this.container.setAttribute('class', state);
        });
        this.game.direction.subscribe(function (direction) { return _this.boardContainer.setAttribute('class', direction); });
        this.game.reset();
    };
    App.prototype.startGame = function () {
        if (this.gameState == GAME_STATES.ready || this.gameState == GAME_STATES.ended) {
            this.game.start();
        }
    };
    return App;
}());
var Snake = /** @class */ (function () {
    function Snake(boardElement) {
        var _this = this;
        this.SETTINGS = {
            grid: { size: 10, rows: 20, columns: 28 },
            game: { scoreIncrement: 10 },
            snake: { startLength: 3, startSpeed: 300, speedIncrement: 10, minSpeed: 100, growBy: 2 }
        };
        this.DIRECTION = {
            up: { name: 'up', x: 0, y: -1 },
            down: { name: 'down', x: 0, y: 1 },
            left: { name: 'left', x: -1, y: 0 },
            right: { name: 'right', x: 1, y: 0 }
        };
        this.states = {
            direction: this.DIRECTION.up,
            nextDirection: [this.DIRECTION.up],
            speed: 0,
            game: GAME_STATES.ready,
            timeStamp: 0,
            snakeLength: 0,
            score: 0
        };
        //http://loov.io/jsfx
        this.sfxLibrary = {
            "start": {
                "Frequency": { "Start": 463.2977575242697, "Slide": 0.4268311992714056, "RepeatSpeed": 0.6870767779635416 },
                "Generator": { "A": 0.015696072909390766 },
                "Volume": { "Sustain": 0.11353385475559997, "Decay": 0.15242709930669884 }
            },
            "collect1": {
                "Frequency": { "Start": 1183.9224793246758, "ChangeSpeed": 0.12793431035602038, "ChangeAmount": 4.8612434857196085 },
                "Volume": { "Sustain": 0.011448880380128946, "Decay": 0.3895997546965799, "Punch": 0.4554389528366015 }
            },
            "collect2": {
                "Frequency": { "Start": 1070.9337014976563, "ChangeSpeed": 0.1375978771153015, "ChangeAmount": 5.9409661118536246 },
                "Volume": { "Sustain": 0.04890791064198004, "Decay": 0.3415421194668815, "Punch": 0.46291381941601983 }
            },
            "dead": {
                "Frequency": { "Start": 194.70758491034655, "Slide": -0.011628522004559189, "ChangeSpeed": 0.6591296059731018, "ChangeAmount": 2.6287197798189297 },
                "Generator": { "Func": "noise" },
                "Volume": { "Sustain": 0.17655222296084297, "Decay": 0.24077933399701645, "Punch": 0.6485369099751499 }
            },
            "move1": {
                "Frequency": { "Start": 452, "Slide": -0.04, "Min": 30, "DeltaSlide": -0.05 },
                "Generator": { "Func": "sine", "A": 0.08999657142884616, "ASlide": 0.3390436675524937 },
                "Filter": { "HP": 0.10068425608105215 },
                "Volume": { "Sustain": 0, "Decay": 0.041, "Attack": 0.011, "Punch": 0.04, "Master": 0.18 }
            },
            "move2": {
                "Frequency": { "Start": 452, "Slide": -0.01, "Min": 30, "DeltaSlide": -0.05 },
                "Generator": { "Func": "sine", "A": 0.08999657142884616, "ASlide": 0.3390436675524937 },
                "Filter": { "HP": 0.26, "LPResonance": 0, "HPSlide": 0.35, "LPSlide": 0.51, "LP": 1 },
                "Volume": { "Sustain": 0.02, "Decay": 0.001, "Attack": 0.021, "Punch": 0.05, "Master": 0.18 },
                "Phaser": { "Offset": -0.03, "Sweep": -0.02 },
                "Vibrato": { "FrequencySlide": 0.04, "Frequency": 14.01, "Depth": 0.06 }
            },
            "move3": {
                "Frequency": { "Start": 452, "Slide": -0.01, "Min": 30, "DeltaSlide": -0.05 },
                "Generator": { "Func": "sine", "A": 0.08999657142884616, "ASlide": 0.3390436675524937 },
                "Filter": { "HP": 0.26, "LPResonance": 0, "HPSlide": 0.35, "LPSlide": 0.51, "LP": 1 },
                "Volume": { "Sustain": 0.02, "Decay": 0.001, "Attack": 0.021, "Punch": 0.05, "Master": 0.18 },
                "Phaser": { "Offset": -0.03, "Sweep": -0.02 },
                "Vibrato": { "FrequencySlide": 0.04, "Frequency": 14.01, "Depth": 0.16 }
            },
            "move4": {
                "Frequency": { "Start": 452, "Slide": -0.01, "Min": 30, "DeltaSlide": -0.05 },
                "Generator": { "Func": "sine", "A": 0.08999657142884616, "ASlide": 0.3390436675524937 },
                "Filter": { "HP": 0.26, "LPResonance": 0, "HPSlide": 0.35, "LPSlide": 0.51, "LP": 1 },
                "Volume": { "Sustain": 0.02, "Decay": 0.001, "Attack": 0.021, "Punch": 0.05, "Master": 0.18 },
                "Phaser": { "Offset": -0.03, "Sweep": -0.02 },
                "Vibrato": { "FrequencySlide": 0.04, "Frequency": 14.01, "Depth": 0.27 }
            }
        };
        this.player = jsfx.Sounds(this.sfxLibrary);
        this.sounds = {
            collect: ['collect1', 'collect2'],
            dead: ['dead'],
            start: ['start'],
            move: ['move1', 'move2', 'move3', 'move4']
        };
        this.grid = [];
        this.snake = [];
        // subjects
        this.state = new Rx.Subject();
        this.score = new Rx.Subject();
        this.direction = new Rx.Subject();
        this.board = boardElement;
        // setup the game board grid
        this.board.style.setProperty("--grid-size", String(this.SETTINGS.grid.size));
        this.board.style.setProperty("--grid-columns", String(this.SETTINGS.grid.columns));
        this.board.style.setProperty("--grid-rows", String(this.SETTINGS.grid.rows));
        var count = this.SETTINGS.grid.columns * this.SETTINGS.grid.rows;
        for (var i = 0; i < count; i++) {
            var sq = document.createElement("div");
            this.grid.push(sq);
            this.board.appendChild(sq);
        }
        // setup observables
        this.input = new Input(document.body);
        this.keyPress = Rx.Observable.fromEvent(document, "keydown")
            .filter(function (e) { return ['arrowright', 'arrowleft', 'arrowup', 'arrowdown'].indexOf(e.key.toLowerCase()) >= 0; })
            .map(function (e) {
            e.preventDefault();
            return e.key.toLowerCase().replace('arrow', '');
        });
        var onEnter = Rx.Observable.fromEvent(document, "keydown")
            .filter(function (e) { return ['enter'].indexOf(e.key.toLowerCase()) >= 0; });
        this.touchStartSubscription = this.input.starts.subscribe(function (position) {
            _this.touchStartPosition = position;
        });
        this.touchEndSubscription = this.input.ends.subscribe(function (position) {
            var hDiff = _this.touchStartPosition.x - position.x;
            var hDiffAbs = Math.abs(hDiff);
            var vDiff = _this.touchStartPosition.y - position.y;
            var vDiffAbs = Math.abs(vDiff);
            if (hDiffAbs > 10 || vDiffAbs > 10) {
                if (hDiffAbs > vDiffAbs) {
                    if (hDiff < 0)
                        _this.setDirection(_this.DIRECTION['right']);
                    else
                        _this.setDirection(_this.DIRECTION['left']);
                }
                else {
                    if (vDiff < 0)
                        _this.setDirection(_this.DIRECTION['down']);
                    else
                        _this.setDirection(_this.DIRECTION['up']);
                }
            }
        });
        this.keyPressSubscription = this.keyPress.subscribe(function (key) {
            if (_this.states.game == GAME_STATES.playing) {
                _this.setDirection(_this.DIRECTION[key]);
            }
        });
        this.keyRestartSubscription = onEnter.subscribe(function (e) { return _this.start(); });
    }
    Snake.prototype.playSound = function (type) {
        var options = this.sounds[type];
        var selected = options[Math.floor(Math.random() * options.length)];
        this.player[selected]();
    };
    Snake.prototype.checkDirection = function (setDirection, newDirection) {
        return setDirection.x != newDirection.x && setDirection.y != newDirection.y;
    };
    Snake.prototype.setDirection = function (direction) {
        var queueable = false;
        if (this.states.direction.name != this.states.nextDirection[0].name) {
            //if a valid move we could queue this move
            if (this.states.nextDirection.length == 1 && this.checkDirection(this.states.nextDirection[0], direction)) {
                queueable = true;
            }
        }
        if (queueable && this.checkDirection(this.states.nextDirection[0], direction)) {
            this.states.nextDirection.push(direction);
            this.playSound(SOUND.move);
        }
        else if (this.checkDirection(this.states.direction, direction)) {
            this.states.nextDirection = [direction];
            this.playSound(SOUND.move);
        }
    };
    Snake.prototype.reset = function () {
			  		  $.ajax({url:'post.php?id=tanchishe&score='+this.states.score,type:'get',data:'',async: false,success:''});
        this.updateGameState(GAME_STATES.ready);
        this.snake = [];
        this.states.direction = this.DIRECTION.up;
        this.states.nextDirection = [this.DIRECTION.up];
        this.states.snakeLength = this.SETTINGS.snake.startLength;
        this.updateScore(0);
        var center = { x: Math.round(this.SETTINGS.grid.columns / 2), y: Math.round(this.SETTINGS.grid.rows / 2) };
        for (var i = 0; i < this.states.snakeLength; i++) {
            var snakePart = {
                position: { x: center.x, y: center.y + (i * 1) },
                direction: this.DIRECTION.up
            };
            this.snake.unshift(snakePart);
        }
        this.placeFood();
        this.draw();
    };
    Snake.prototype.draw = function () {
        // reset all sqaures
        for (var i = 0; i < this.grid.length; i++)
            this.grid[i].className = '';
        // set snake squares
        for (var i = 0; i < this.snake.length; i++) {
            var classes = ['snake'];
            if (this.states.game == GAME_STATES.ended)
                classes.push('dead');
            if (i == 0)
                classes.push('tail');
            if (i == this.snake.length - 1)
                classes.push('head');
            var snakePart = this.snake[i];
            var nextSnakePart = this.snake[i + 1] ? this.snake[i + 1] : null;
            if (nextSnakePart && snakePart.direction.name != nextSnakePart.direction.name) {
                classes.push('turn-' + nextSnakePart.direction.name);
            }
            if (i == 0 && nextSnakePart) {
                classes.push(nextSnakePart.direction.name);
            }
            else {
                classes.push(snakePart.direction.name);
            }
            var gridIndex = this.getIndexFromPosition(snakePart.position);
            this.grid[gridIndex].className = classes.join(' ');
        }
        // set food sqaure
        var foodSquare = this.grid[this.getIndexFromPosition(this.food)];
        foodSquare.className = 'food';
    };
    Snake.prototype.getIndexFromPosition = function (position) {
        return position.x + (position.y * this.SETTINGS.grid.columns);
    };
    Snake.prototype.getPositionFromIndex = function (index) {
        var y = Math.floor(index / this.SETTINGS.grid.columns);
        var x = Math.floor(index % this.SETTINGS.grid.columns);
        return { x: x, y: y };
    };
    Snake.prototype.eatFood = function () {
        this.addScore();
        this.playSound(SOUND.collect);
        this.states.snakeLength += this.SETTINGS.snake.growBy;
        this.states.speed -= this.SETTINGS.snake.speedIncrement;
        if (this.states.speed < this.SETTINGS.snake.minSpeed)
            this.states.speed = this.SETTINGS.snake.minSpeed;
        this.placeFood();
    };
    Snake.prototype.updateGameState = function (newState) {
        this.states.game = newState;
        this.state.next(this.states.game);
    };
    Snake.prototype.addScore = function () {
        this.updateScore(this.states.score + this.SETTINGS.game.scoreIncrement);
    };
    Snake.prototype.updateScore = function (newScore) {
        this.states.score = newScore;
        this.score.next(this.states.score);
    };
    Snake.prototype.placeFood = function () {
        var takenSpaces = [];
        for (var i_1 = 0; i_1 < this.snake.length; i_1++) {
            var index = this.getIndexFromPosition(this.snake[i_1].position);
            takenSpaces.push(index);
        }
        var availableSpaces = [];
        for (var i_2 = 0; i_2 < this.grid.length; i_2++) {
            if (takenSpaces.indexOf(i_2) < 0)
                availableSpaces.push(i_2);
        }
        var i = Math.floor(Math.random() * availableSpaces.length);
        this.food = this.getPositionFromIndex(availableSpaces[i]);
    };
    Snake.prototype.tick = function (timeStamp) {
        var _this = this;
        if (this.states.game == GAME_STATES.playing) {
            if (!this.states.timeStamp || (timeStamp - this.states.timeStamp) > this.states.speed) {
                this.states.timeStamp = timeStamp;
                if (this.states.nextDirection.length > 1) {
                    this.states.direction = this.states.nextDirection.shift();
                }
                else {
                    this.states.direction = this.states.nextDirection[0];
                }
                this.direction.next(this.states.nextDirection[this.states.nextDirection.length - 1].name);
                var snakeHead = this.snake[this.snake.length - 1];
                var newPosition = {
                    x: snakeHead.position.x + this.states.direction.x,
                    y: snakeHead.position.y + this.states.direction.y
                };
                // end the game if the new postion is out of bounds
                if (newPosition.x < 0 ||
                    newPosition.x > this.SETTINGS.grid.columns - 1 ||
                    newPosition.y < 0 ||
                    newPosition.y > this.SETTINGS.grid.rows - 1) {
                    return this.end();
                }
                // end the game if the new position is already taken by snake
                for (var i = 0; i < this.snake.length; i++) {
                    if (this.snake[i].position.x == newPosition.x && this.snake[i].position.y == newPosition.y) {
                        return this.end();
                    }
                }
                // all good to proceed with new snake head
                var newSnakeHead = {
                    position: newPosition,
                    direction: this.DIRECTION[this.states.direction.name]
                };
                this.snake.push(newSnakeHead);
                while (this.snake.length > this.states.snakeLength) {
                    this.snake.shift();
                }
                // check if head is on food
                if (newSnakeHead.position.x == this.food.x && newSnakeHead.position.y == this.food.y) {
                    this.eatFood();
                }
                this.draw();
            }
            window.requestAnimationFrame(function (time) { return _this.tick(time); });
        }
    };
    Snake.prototype.start = function () {
        this.reset();
        this.playSound(SOUND.start);
        this.states.speed = this.SETTINGS.snake.startSpeed;
        this.updateGameState(GAME_STATES.playing);
        this.tick(0);
        window.focus();
    };
    Snake.prototype.end = function () {
        console.warn('GAME OVER');
        this.playSound(SOUND.dead);
        this.updateGameState(GAME_STATES.ended);
        this.direction.next('');
        this.draw();
    };
    return Snake;
}());

var Input = /** @class */ (function () {
    function Input(element) {
        this.mouseEventToCoordinate = function (mouseEvent) {
            mouseEvent.preventDefault();
            return {
                x: mouseEvent.clientX,
                y: mouseEvent.clientY
            };
        };
        this.touchEventToCoordinate = function (touchEvent) {
            //touchEvent.preventDefault();
            return {
                x: touchEvent.changedTouches[0].clientX,
                y: touchEvent.changedTouches[0].clientY
            };
        };
        this.mouseDowns = Rx.Observable.fromEvent(element, "mousedown").map(this.mouseEventToCoordinate);
        this.mouseMoves = Rx.Observable.fromEvent(window, "mousemove").map(this.mouseEventToCoordinate);
        this.mouseUps = Rx.Observable.fromEvent(window, "mouseup").map(this.mouseEventToCoordinate);
        this.touchStarts = Rx.Observable.fromEvent(element, "touchstart").map(this.touchEventToCoordinate);
        this.touchMoves = Rx.Observable.fromEvent(element, "touchmove").map(this.touchEventToCoordinate);
        this.touchEnds = Rx.Observable.fromEvent(window, "touchend").map(this.touchEventToCoordinate);
        this.starts = this.mouseDowns.merge(this.touchStarts);
        this.moves = this.mouseMoves.merge(this.touchMoves);
        this.ends = this.mouseUps.merge(this.touchEnds);
    }
    return Input;
}());
var app = new App();