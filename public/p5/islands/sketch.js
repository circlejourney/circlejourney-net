var consonants = "bcdfghjklmnpqrstvwxyz";
var vowels = "aeiou";
var tooltipDisplayed = false;
var tooltip = "";
var score = 0;
var citiesLeft = 6;
var activeBtn = null;
var btnHeight = 75;

var grid = {
    init: false,
    width: 50,
    height: 50,
    tileSize: 12,
    genIterations: 9,
    conSize: 40,
    conCount: 5,
	hilliness: 0,
	wetness: 3,
	idealScore: 0,
	riverScore: 4,
	seaScore: 3,
	cityScore: 3,
	maxDepletion: 100,
	densThreshold: 7,
    tileTypes: {
        land: {
            col: null
        },
        peak: {
            col: null
        },
        sea: {
            col: null
        },
        coast: {
            col: null
        },
        river: {
            col: null
        },
        coastnew: {
            col: null
        },
        city: {
            col: null
        },
        cityinner: {
            col: null
        },
		shallow: {
			col: null
		}
    },
    
    tilemap: [],
	
	peaks: [],
    
    cities: {},
    
    continents: {},
    
    createTilemap: function() {
        for(var i = 0; i < this.width; i++) {
            this.tilemap[i] = [];
            for(var j = 0; j < this.height; j++) {
                this.tilemap[i][j] = {
                    "type": "sea",
                    "depth": this.genIterations + 1
                };
            }
        }
    },
    
    randomTile: function() {
        return {x: floor(random(this.width)), y: floor(random(this.height))};
    },
    
    update: function() {
        var ran = random();
		for(var key in this.cities) {
			this.cities[key].update();
		}
    },
    
    getPixIndex: function(x, y) {
        return (x + y * this.width) * 4;
    },
    
    genName: function() {
        var name = "";
        var len = random(3, 10);
        for(var i=0;i<20;i++) {
            if(i%2 === 0) name += randomFrom(consonants);
            else name += randomFrom(vowels);
        }
        return name.substr(random(10), len);
    },
    
    grow: function() {
        for(var i=0; i < this.width; i++) {
            for(var j = 0; j < this.height; j++) {
                var pix = this.tilemap[i][j];
                if(pix.type == "coast") {
                    pix.type = "land";
                    pix.depletion = this.maxDepletion;
                    for(var k=0; k<4; k++) {
                        var x = i+cos(k*PI/2);
                        var y = j+sin(k*PI/2);
                        var newx = (x + this.width) % this.width;
                        var newy = (y + this.height) % this.height;
                        if(this.tilemap[newx][newy].type == "sea"){
							if(random()>0.3) {
								this.tilemap[newx][newy].type = "coastnew";
								this.tilemap[newx][newy].depth = this.hilliness;
								if(this.hilliness <= 2) this.peaks.push({x: newx, y: newy});
							} else {
								pix.depth = this.hilliness;
								pix.type = "coast";
								break;
							}
						}
                    }
                }
            }
        }
        
        for(var i=0; i<this.width; i++) {
            for(var j=0; j<this.height; j++) {
                var pix = this.tilemap[i][j];
                if(pix.type == "coastnew") {
                    pix.type = "coast";
				}
				if(pix.type == "coast") {
					var landlocking = 0;
					for(var k =0; k<9; k++) {
						var x = i+k%3-1;
						var y = j+floor(k/3)-1;
						var newx = (x + this.width) % this.width;
						var newy = (y + this.height) % this.height;
						if(this.tilemap[newx][newy].type == "coast" || this.tilemap[newx][newy].type == "land") {
							landlocking++;
						}
					}
					if(landlocking == 9) {
					    pix.type = "land";
                        pix.depletion = this.maxDepletion;
					}
				}
            }
        }
    },
    
    seedContinent: function() {
        var tiles = [];
        var conName = this.genName();
        
        seedTile = this.randomTile();
        
        seedLength = floor(random(2*this.conSize/3, this.conSize));
        for(var i=0; i<seedLength; i++) {
			this.peaks.push(seedTile);
            this.tilemap[seedTile.x][seedTile.y].type = "coast";
            this.tilemap[seedTile.x][seedTile.y].depth = 0;
            
            seedTile.x = (seedTile.x + floor(2-random(3)) + this.width) % this.width;
            seedTile.y = (seedTile.y + floor(2-random(3)) + this.height) % this.height;
        }
    },
    
    spawnCity: function(tile) {
        if(this.tilemap[tile.x][tile.y].type == "land" || this.tilemap[tile.x][tile.y].type == "coast") {
            
            var cityName = this.genName();
            this.tilemap[tile.x][tile.y].type = "city";
            this.tilemap[tile.x][tile.y].city = cityName;
            this.tilemap[tile.x][tile.y].epiTimer = 0;
            this.cities[cityName] = new City(cityName, tile, 1);
            citiesLeft--;
        }
    },
	
	drawRiver: function() {
		var head = randomFrom(this.peaks);
		while(this.tilemap[head.x][head.y].type != "sea" && this.tilemap[head.x][head.y].type != "river") {
		    if(this.tilemap[head.x][head.y].type == "land") this.tilemap[head.x][head.y].type = "river";
		    else if(this.tilemap[head.x][head.y].type == "coast") this.tilemap[head.x][head.y].type = "sea";
		    var max = head;
			for(var i=0;i<9;i++) {
			    if(i==4) i++;
				var x = (head.x+i%3-1 + this.width) % this.width;
				var y = (head.y+floor(i/3)-1 + this.height) % this.height;
				if(this.tilemap[x][y].depth >= this.tilemap[max.x][max.y].depth) {
					max = {"x": x, "y": y};
				}
			}
			head = max;
		}
	},
    
    stepMap: function() {
        if(frameCount/10 <= 1) {
            for(var i=0; i<this.conCount; i++) this.seedContinent();
        }
        else if(frameCount/10 <= this.genIterations + 1) {
			this.hilliness++;
			this.grow(this.hilliness);
		}
		
		else if(frameCount/10 <= this.genIterations + 5) {
    		this.drawRiver();
    		this.init = true;
		} else {
            this.update();
		}
		
    	this.idealScore = (this.hilliness-2 + this.riverScore + this.seaScore*2 + this.cityScore)/this.densThreshold;
    },
    
    getFoodScore: function(tile) {
        var thisTile = grid.tilemap[tile.x][tile.y];
        var foodScore = 0;
        var hasSea = 0;
        var hasRiver = 0;
        var hasCity = 0;
        foodScore += thisTile.depth;
        for(var i=0; i<9; i++){
			var x = (tile.x+i%3-1 + grid.width) % grid.width;
			var y = (tile.y+floor(i/3)-1 + grid.height) % grid.height;
            if(grid.tilemap[x][y].type == "river") {
                hasRiver++;
            } else if(grid.tilemap[x][y].type == "sea" || grid.tilemap[x][y].type == "coast") {
                hasSea++;
            } else if (grid.tilemap[x][y].type == "cityinner") {
                hasCity++;
            }
        }
        foodScore += hasSea*this.seaScore + hasRiver*this.riverScore + hasCity * this.cityScore;
        return foodScore;
    }
};
    
class City {
    constructor(name, seedTile, pop) {
        this.name = name;
        this.tiles = [seedTile];
        this.pop = pop;
        this.foodScore = 0;
        this.exploring = 0;
        this.maxPop = pop;
        this.updateFoodScore();
        this.innerTiles = [];
        this.minX = seedTile.x;
        this.minY = seedTile.y;
        this.maxX = seedTile.x + 1;
        this.maxY = seedTile.y + 1;
    }
    
    update() {
        this.updateFoodScore();
        var roll = random(this.foodScore);
        if(roll > grid.idealScore/2) { //is the amount of food they got this roll enough for them to grow
            this.pop++;
            if(this.maxPop < this.pop) {
                this.maxPop = this.pop;
            }
        } else if(roll < grid.idealScore/6) { //is the amount of food too low to meet basic needs? -> death
            this.pop--;
            if(this.pop == 0) {
                for(var i=0;i< this.tiles.length;i++) {
                    grid.tilemap[this.tiles[i].x][this.tiles[i].y].type = "land";
                }
                delete grid.cities[this.name];
                return;
            }
        }
        var dens = this.pop/this.tiles.length;
        if(dens >= grid.densThreshold && random()>0.8) {
            this.sort();
            this.grow();
        } else if(dens < 4 && this.tiles.length > 1) {
            this.sort();
            this.shrink();
        } else if(dens > 12 && this.epiTimer == 0) {
                this.pop = floor(this.pop*random(0.3, 0.7));
                for(var i=0; i<this.tiles.length; i++) {
                grid.tilemap[this.tiles[i].x][this.tiles[i].y].epiTimer = 30;
                console.log("Epidemic!");
            }
         }
        if(this.pop > 100) {
            this.exploring = true;
        }
        
        updateScore();
    }
    
    sort() {
        this.tiles.sort(function(a, b){
            return 0.5-random(1);
        });
    }

    grow() {
        for(var i=0;i<this.tiles.length;i++) {
            var seedTile = this.tiles[i];
            var centrality = 0;
            for(var j=0; j<9; j++){
                var x = (seedTile.x+j%3-1 + grid.width) % grid.width;
                var y = (seedTile.y+floor(j/3)-1 + grid.height) % grid.height;
                if(grid.tilemap[x][y].type == "land" && grid.getFoodScore({"x":x, "y":y})/grid.densThreshold > this.foodScore*0.7) {
                    grid.tilemap[x][y].type = "city";
                    grid.tilemap[x][y].city = this.name;
                    grid.tilemap[x][y].epiTimer = 0;
                    this.tiles.push({"x":x, "y":y});
                    this.updateMinMax();
                    return;
                } else if(grid.tilemap[x][y].type != "land") {
                    centrality++
                }
            }
            if(centrality >= 9) {
                this.innerTiles.push(this.tiles[0]);
                grid.tilemap[this.tiles[0].x][this.tiles[0].y].type = "cityinner";
            }
        }
    }
    
    shrink() {
        console.log("Shrinking "+this.name+" from "+this.tiles.length);
        var deadTile = this.tiles.splice(this.tiles.length-1, 1)[0];
        console.log("Size is now "+this.tiles.length);
        grid.tilemap[deadTile.x][deadTile.y].type = "land";
        this.updateMinMax();
    }
    
    updateFoodScore() {
        var grossFoodScore = 0;
        for(var i=0;i<this.tiles.length;i++) {
            grossFoodScore += grid.getFoodScore(this.tiles[i]);
        }
        this.foodScore = grossFoodScore / this.pop;
    }
    
    updateMinMax() {
        this.minX = grid.width;
        this.minY = grid.height;
        this.maxX = 0;
        this.maxY = 0;
        for(var i = 0; i < this.tiles.length; i++) {
            if(this.tiles[i].x < this.minX) this.minX = this.tiles[i].x;
            if(this.tiles[i].y < this.minY) this.minY = this.tiles[i].y;
            if(this.tiles[i].x+1 > this.maxX) this.maxX = this.tiles[i].x+1;
            if(this.tiles[i].y+1 > this.maxY) this.maxY = this.tiles[i].y+1;
        }
    }
}

function updateScore() {
    var tempScore = 0;
    for(var key in grid.cities) {
        tempScore += grid.cities[key].maxPop;
    }
    score = tempScore;
}

function randomFrom(arr) {
    return(arr[floor(random(arr.length-1))]);
}

function setup() {
    frameRate(40);
	noStroke();
    textFont("Trebuchet MS");
    var mycanvas = createCanvas(grid.width * grid.tileSize + grid.tileSize*30, grid.height * grid.tileSize);
    
    mycanvas.parent("main");
	
    grid.tileTypes.peak.col = color(240, 220, 90);
	grid.tileTypes.land.col = color(150, 210, 160);
    grid.tileTypes.sea.col = color(90, 120, 220);
    grid.tileTypes.city.col = color(220, 70, 60);
    grid.tileTypes.cityinner.col = color(220, 100, 220);
    grid.tileTypes.coast.col = color(150, 190, 200);
    grid.tileTypes.river.col = color(150, 190, 200);
	
    grid.createTilemap();
    
    table = createElement("table");
    table.id = "scoreboard";
    table.parent()
}

function draw() {
    if(frameCount % 10 == 0) {
        grid.stepMap();
    }
    for(var i = 0; i < grid.width; i++) {
        for(var j = 0; j < grid.height; j++) {
            var col = grid.tileTypes[grid.tilemap[i][j].type].col;
			if(grid.tilemap[i][j].type == "land") {
				col = lerpColor(grid.tileTypes.land.col, grid.tileTypes.peak.col, (grid.hilliness-grid.tilemap[i][j].depth)/grid.genIterations);
				//col = color(240-7*grid.tilemap[i][j].depth, 220, 90+10*grid.tilemap[i][j].depth);
			} else if(grid.tilemap[i][j].type == "city") {
			    var dens = grid.cities[grid.tilemap[i][j].city].pop/grid.cities[grid.tilemap[i][j].city].tiles.length;
			    var lowcol = color(250, 220-(20-grid.densThreshold)*dens, 20+dens*(20-grid.densThreshold));
			    var hicol = color(220, 220-(20-grid.densThreshold)*dens, 20+dens*(20-grid.densThreshold));
			    col = lerpColor(lowcol, hicol, grid.tilemap[i][j].depth/grid.hilliness);
			}
			if(grid.tilemap[i][j].epiTimer > 0) {
			    col = lerpColor(col, color(0,140,80), grid.tilemap[i][j].epiTimer/30);
			    grid.tilemap[i][j].epiTimer--;
			}
            fill(col);
            rect(i*grid.tileSize, j*grid.tileSize, grid.tileSize, grid.tileSize);
        }
    }
    
    fill(250);
    rect(grid.width*grid.tileSize, 0, grid.tileSize*30, height);
    if(grid.init) {
        
        var indent = 15 + grid.width*grid.tileSize;
        textAlign(LEFT);
        fill(50);
        textSize(16);
        text("Click a land tile to start a city!", indent, 20);
        
        if(activeBtn != null) {
            var activeCity = grid.cities[Object.keys(grid.cities)[activeBtn]];
            if(activeCity) {
                fill("rgba(200,255,200,0.5)");
                rect(indent, 40+activeBtn*75, grid.tileSize*30-30, btnHeight-15);
                
                stroke(100, 50, 50);
                strokeWeight(2);
                noFill();
                var x = (activeCity.minX-0.5) * grid.tileSize;
                var y = (activeCity.minY-0.5) * grid.tileSize;
                var w = (activeCity.maxX+0.5) * grid.tileSize - x;
                var h = (activeCity.maxY+0.5) * grid.tileSize - y;
                rect(x, y, w, h, 10);
                noStroke();
            }
        }
        
        var i = 0;
        for(var key in grid.cities) {
            fill(50);
            textStyle(BOLD);
            textSize(14);
            var texttop = i*btnHeight+50;
            var cityName = key[0].toUpperCase() + key.substr(1);
            text(cityName, indent, texttop)
            
            textStyle(NORMAL);
            textSize(12)
            text("Population "+grid.cities[key].pop, indent, texttop+15);
            text("Area "+grid.cities[key].tiles.length, indent, texttop+30);
            if(grid.cities[key].foodScore<grid.idealScore/2) fill(240, 0, 0);
            else fill(0,210,20);
            text("Food: "+grid.cities[key].foodScore.toFixed(1), indent, texttop+45);
            i++
        }
        fill(65);
        textSize(14);
        text("Cities left to place: "+citiesLeft, indent, height-20);
        textAlign(RIGHT)
        text("Score: "+score, width-20, height-20);
    }
    
    if(tooltipDisplayed) {
        textAlign(CENTER);
        fill("rgba(0, 0, 0, 0.5)");
        rect(mouseX, mouseY, 20+tooltip.length*10, 40);
        fill(255);
        textSize(14);
        text(tooltip, mouseX + 10+tooltip.length*5, mouseY+20);
    }
}

function mousePressed() {
    var x = floor(mouseX/grid.tileSize);
    var y = floor(mouseY/grid.tileSize);
    if(x<grid.width && y<grid.height && grid.init && citiesLeft > 0) {
        grid.spawnCity({"x": x, "y": y});
    }
}

function mouseMoved() {
    var x = floor(mouseX/grid.tileSize);
    var y = floor(mouseY/grid.tileSize);
    if(x<grid.width && y<grid.height && x>0 && y>0) {
        if(grid.tilemap[x][y].type == "city" || grid.tilemap[x][y].type =="cityinner") {
            tooltipDisplayed = true;
            tooltip = grid.tilemap[x][y].city;
            tooltip = tooltip[0].toUpperCase() + tooltip.substr(1);
        } else {
            tooltipDisplayed = false;
        }
    }
    
    var indent = 15 + grid.width*grid.tileSize;
    if(mouseX > indent && mouseX < indent + grid.tileSize*30-30 && mouseY > 40 && mouseY < 40+Object.keys(grid.cities).length*btnHeight) {
        activeBtn = floor((mouseY-40)/btnHeight);
    } else {
        activeBtn = null;
    }
}