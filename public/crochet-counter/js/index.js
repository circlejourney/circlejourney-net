var counter, row, activeIndex, database;
var projectList = [];

document.addEventListener('deviceready', onDeviceReady, false);


// INIT REQUEST HANDLER

var openRequest = window.indexedDB.open("crochetProjectList", 1);

openRequest.onsuccess = function (e) {
	
	database = e.target.result;
	redrawList();
	
};

document.addEventListener("backbutton", onBackKeyDown, false);

function onBackKeyDown(e) {
	if($(".project-list-page").hasClass("hidden")) {
		openHomePage();
	} else {
		throw new Error("exit");
	}
}

openRequest.onerror = function(e) {}

openRequest.onupgradeneeded = function (e) { // first time
	var database = e.target.result;
	
	var objectStore = database.createObjectStore('crochetprojects', { keyPath: 'date' } );
	objectStore.createIndex('name', 'name', { unique: false });
	objectStore.createIndex('cleanName', 'cleanName', { unique: false });
	objectStore.createIndex('row', 'row', { unique: false });
	objectStore.createIndex('stitch', 'stitch', { unique: false });
	
	objectStore.transaction.oncomplete = function(e) {
		var projectStore = database.transaction('crochetprojects', 'readwrite').objectStore('crochetprojects');
		
		projectStore.add({
			"name": "Example Project",
			"cleanName": "Example-Project",
			"row": 1,
			"stitch": 0,
			"date": 1641529607
		});
		
		projectStore.add({
			"name": "Example Project 2",
			"cleanName": "Example-Project-2",
			"row": 5,
			"stitch": 4,
			"date": 1641529595
		});
	}
}



function onDeviceReady() {
    console.log('Running cordova-' + cordova.platformId + '@' + cordova.version);
	
	setTimeout(function(){
		$(".loading").fadeTo(1200, 0, "swing", function(){
			$(this).addClass("hidden");
		})
	}, 800);
	
	$(".back-arrow").click(openHomePage);
}

function redrawList() {
	
	projectList = [];
	
	var projectStore = database.transaction('crochetprojects').objectStore('crochetprojects');
	var myIndex = projectStore.index("name");
	
	myIndex.openCursor().onsuccess = function(e) {
		
		var cursor = e.target.result;
		if(cursor) {
			
			projectList.push(cursor.value);
			cursor.continue(); // moves cursor, fires another success event if there is another entry
			
		} else { // when list has been looped through completely
	
			$(".project-list-wrapper").empty()
			
			$.each(projectList, function(i, val) {
				var thisRow = $(".template-row").clone().removeClass("template-row").addClass(i);
				
				$(thisRow).find(".project-name").text(val.name);
				$(thisRow).find(".project-stitch").html("Row " + val.row + "<br>Stitch " + val.stitch);
				
				$(thisRow).click( function(){
					activeIndex = i;
					$(".project-page").removeClass("hidden");
					$(".project-list-page").addClass("hidden");
					$("#row-counter").val(projectList[activeIndex].row);
					$("#stitch-counter").val(projectList[activeIndex].stitch);
					$("#project-name-input").val(projectList[activeIndex].name);
				} );
				
				$(".project-list-wrapper").prepend(thisRow);
			});
			
		}
		
	}
	
}

function redrawListNew() {
	
}

function updateDB() {
	var updateProjectRequest = database
		.transaction("crochetprojects", "readwrite")
		.objectStore("crochetprojects")
		.put(projectList[activeIndex]);
	updateProjectRequest.onsuccess = function(e){
		console.log("updated current project to database");
	};
}

function addStitch() {
	projectList[activeIndex].stitch++;
	$("#stitch-counter").val(projectList[activeIndex].stitch);
	
	updateDB();
}

function addRow() {
	projectList[activeIndex].row++;
	projectList[activeIndex].stitch = 0;
	$("#row-counter").val(projectList[activeIndex].row);
	$("#stitch-counter").val(projectList[activeIndex].stitch);
	
	updateDB();
}

function inlineUpdateProp(target, prop) {
	if(target.value == "") return false;
	projectList[activeIndex][prop] = parseInt(target.value) || target.value;
	
	updateDB();
}

function openPage(pageClass) {
	$(".panel").addClass("hidden");
	$("."+pageClass).removeClass("hidden");
}

function openHomePage() {
	redrawList();
	openPage("project-list-page");
	activeIndex = null;
}

function addProject() {
	var cleanName = $("#new-project-name").val().replace(/[\W]/g, "-");
	
	var newProject = {
		"name": $("#new-project-name").val(),
		"cleanName": cleanName,
		"row": 1,
		"stitch": 0,
		"date": Date.now()
	};
	
	projectList = [...projectList, newProject];
	
	var newProjectRequest = database.transaction("crochetprojects", "readwrite").objectStore("crochetprojects").add(newProject);
	
	newProjectRequest.onsuccess = function(e) {
		openHomePage();
	}
}

function deleteProject() {
	var confirm = window.confirm("Are you sure you want to delete this project?");
	
	if(!confirm) return false;
	
	var deleteProjectRequest = database
		.transaction(["crochetprojects"], "readwrite")
		.objectStore("crochetprojects")
		.delete(projectList[activeIndex].date);
		
	deleteProjectRequest.onsuccess = function() {
		openHomePage();
	}
	
}