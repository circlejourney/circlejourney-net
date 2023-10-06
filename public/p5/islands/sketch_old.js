var consonants = "bcdfghjklmnpqrstvwxyz";
var vowels = "aeiou";

var grid = {
    width: 50,
    height: 50,
    tileSize: 8,
    genIterations: 3,
    conSize: 30,
	hilliness: 0,
	wetness: 3,
	idealScore: 0,
	riverScore: 6,
	seaScore: 4,
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
                    "depth": 100
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
    
    seedContinent: function() {
        var tiles = [];
        var conName = this.genName();
        
        seedTile = this.randomTile();
        console.log("Seeding continent at "+seedTile.x+","+seedTile.y);
        
        seedLength = floor(random(2*this.conSize/3, this.conSize));
        for(var i=0; i<seedLength; i++) {
            tiles.push(seedTile);
			this.peaks.push(seedTile);
            this.tilemap[seedTile.x][seedTile.y].type = "coast";
            this.tilemap[seedTile.x][seedTile.y].continent = conName;
            this.tilemap[seedTile.x][seedTile.y].depth = 0;
            
            seedTile.x = (seedTile.x + floor(2-random(3)) + this.width) % this.width;
            seedTile.y = (seedTile.y + floor(2-random(3)) + this.height) % this.height;
        }
        
        this.continents[conName] = new Continent(conName, tiles);
    },
    
    spawnCity: function(tileX, tileY) {
        var newTile = { x: tileX, y: tileY }; //randomFrom(this.continents[targetContinent].tiles);
        if(this.tilemap[newTile.x][newTile.y].type == "land" || this.tilemap[newTile.x][newTile.y].type == "coast") {
            
            var cityName = this.genName();
            this.tilemap[newTile.x][newTile.y].type = "city";
            this.tilemap[newTile.x][newTile.y].city = cityName;
            this.cities[cityName] = new City(cityName, newTile, 1);
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
    
    initMap: function() {
        for(var i=0;i<3; i++) this.seedContinent();
		for(var i=0; i<this.genIterations; i++) {
			for(var key in this.continents) {
				this.hilliness++;
				this.continents[key].growTerrain(this.hilliness);
			}
		}
		for(var i=0; i<this.wetness; i++) {
		    this.drawRiver();
		}
		this.idealScore = this.hilliness + this.riverScore + this.seaScore;
    },
    
    stepMap: function() {
        if(frameCount/30 <= 1) {
            for(var i=0; i<3; i++) this.seedContinent();
            console.log("Seeding");
        }
        else if(frameCount/30 <= 5) {
			for(var key in this.continents) {
				this.hilliness++;
				this.continents[key].growTerrain(this.hilliness);
			}
		}
		
		else if(frameCount/30 <= 9) {
    		this.drawRiver();
		} else {
            this.update();
		}
		
    	this.idealScore = this.hilliness + this.riverScore + this.seaScore;
    }
};

class Continent {
    
    constructor(name, tiles) {    
        this.name = name;
        this.tiles = tiles;
    }
    
    growTerrain(depth) {
        for(var i=0; i < grid.width; i++) {
            for(var j = 0; j < grid.height; j++) {
                var pix = grid.tilemap[i][j];
                if(pix.type == "coast") {
                    pix.type = "land";
                    for(var k=0; k<4; k++) {
                        var dx = i+cos(k*PI/2);
                        var dy = j+sin(k*PI/2);
                        var newx = (dx + grid.width) % grid.width;
                        var newy = (dy + grid.height) % grid.height;
                        if(grid.tilemap[newx][newy].type == "sea"){
							if(random()>0.3) {
								grid.tilemap[newx][newy].type = "coastnew";
								grid.tilemap[newx][newy].depth = depth;
								if(depth <= 2) grid.peaks.push({x: newx, y: newy});
								grid.tilemap[newx][newy].continent = this.name;
								this.tiles.push({x: newx, y: newy});
							} else {
								pix.depth = depth;
								pix.type = "coast";
								break;
							}
						}
                    }
                }
            }
        }
        
        for(var i=0; i<grid.width; i++) {
            for(var j=0; j<grid.height; j++) {
                var pix = grid.tilemap[i][j];
                if(pix.type == "coastnew") {
                    pix.type = "coast";
				}
				if(pix.type == "coast") {
					var landlocking = 0;
					for(var k =0; k<9; k++) {
						var dx = i+k%3-1;
						var dy = j+floor(k/3)-1;
						var newx = (dx + grid.width) % grid.width;
						var newy = (dy + grid.height) % grid.height;
						if(grid.tilemap[newx][newy].type == "coast" || grid.tilemap[newx][newy].type == "land") {
							landlocking++;
						}
					}
					if(landlocking == 9) pix.type = "land";
				}
            }
        }
    }
}
    
class City {
    constructor(name, seedTile, pop) {
        this.name = name;
        this.innerTiles = [];
        this.outerTiles = [seedTile];
        this.tiles = [seedTile];
        this.pop = pop;
        this.foodScore = 0;
        this.exploring = 0;
        this.getFoodScore();
    }
    
    getFoodScore() {
        var depthScore = 0;
        var hasSea = false;
        var hasRiver = false;
        for(var i=0; i<this.tiles.length; i++) {
            depthScore += grid.tilemap[this.tiles[i].x][this.tiles[i].y].depth;
            for(var i=0; i<9; i++) {
                var x = (seedTile.x + i%3 - 1 + grid.width) % grid.width;
                var y = (seedTile.y + floor(i/3) - 1 + grid.height) % grid.height;
                if(grid.tilemap[x][y].type == "river") {
                    hasRiver = true;
                } else if(grid.tilemap[x][y].type == "sea") {
                    hasSea = true;
                }
            }
        }
        this.foodScore += depthScore/this.tiles.length;
        if(hasRiver) this.foodScore += grid.riverScore;
        if(hasSea) this.foodScore += grid.seaScore;
    }
    
    update() {
        if(random(grid.idealScore) < this.foodScore) {
            this.pop++;
        }
        if(this.pop/(this.innerTiles.length+this.outerTiles.length) > 10 && this.tiles.length < 20) {
            this.grow();
        }
    }

    grow() {
        var seedIndex = floor(random(this.outerTiles.length));
        var nine = [0, 1, 2, 3, 4, 5, 6, 7, 8];
        var choice = null;
        while(choice === null && nine.length > 0) {
            var check = nine.splice(floor(random(nine.length)))[0];
            var x = (this.outerTiles[seedIndex].x + check % 3 - 1 + grid.width) % grid.width;
            var y = (this.outerTiles[seedIndex].y + floor(check/3) - 1 + grid.height) % grid.height;
            console.log(x+","+y);
            if(grid.tilemap[x][y].type == "land" || grid.tilemap[x][y].type == "coast") {
                choice = {"x": x, "y": y};
            }
            if(nine.length === 0) {
                this.innerTiles.push(this.outerTiles.splice());
                seedIndex = floor(random(this.outerTiles.length));
                nine = [0, 1, 2, 3, 4, 5, 6, 7, 8];
            }
        }
        grid.tilemap[x][y].type = "city";
        this.outerTiles.push(choice);
        this.tiles.push(choice);
        this.getFoodScore();
        this.outerTiles.sort(function(a, b) {
            grid.tilemap[b.x][b.y].depth - grid.tilemap[a.x][a.y].depth;
        });
    }
}

function randomFrom(arr) {
    return(arr[floor(random(arr.length-1))]);
}

function setup() {
    frameRate(30);
	noStroke();
    var mycanvas = createCanvas(grid.width * grid.tileSize, grid.height * grid.tileSize);
    
    mycanvas.parent("main");
	
    grid.tileTypes.peak.col = color(240, 220, 90);
	grid.tileTypes.land.col = color(150, 210, 160);
    grid.tileTypes.sea.col = color(90, 120, 220);
    grid.tileTypes.city.col = color(220, 70, 60);
    grid.tileTypes.cityinner.col = color(210, 60, 50);
    grid.tileTypes.coast.col = color(150, 190, 200);
    grid.tileTypes.river.col = color(150, 190, 200);
	
    grid.createTilemap();
}

function draw() {
    if(frameCount % 30 == 0) {
        grid.stepMap();
    }
    for(var i = 0; i < grid.width; i++) {
        for(var j = 0; j < grid.height; j++) {
            var col = grid.tileTypes[grid.tilemap[i][j].type].col;
			if(grid.tilemap[i][j].type == "land") {
				col = lerpColor(grid.tileTypes.peak.col, grid.tileTypes.land.col, grid.tilemap[i][j].depth/grid.hilliness);
				//col = color(240-7*grid.tilemap[i][j].depth, 220, 90+10*grid.tilemap[i][j].depth);
			}
            fill(col);
            rect(i*grid.tileSize, j*grid.tileSize, grid.tileSize, grid.tileSize);
        }
    }
}

function mousePressed() {
    x = floor(mouseX/grid.tileSize);
    y = floor(mouseY/grid.tileSize);
    grid.spawnCity(x, y);
}