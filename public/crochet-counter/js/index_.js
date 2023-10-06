/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

// Wait for the deviceready event before using any of Cordova's device APIs.
// See https://cordova.apache.org/docs/en/latest/cordova/events/events.html#deviceready
var counter, row, projectList, activeIndex;

document.addEventListener('deviceready', onDeviceReady, false);



var openRequest = window.indexedDB.open("crochetProjectList", 1);

openRequest.onsuccess = function (e) {
	database = e.target.result;
	console.log(e);
};

openRequest.onerror = function(e) {}

openRequest.onupgradeneeded = function (e) { // first time
	var database = e.target.result;
	
	var objectStore = database.createObjectStore('projects', { keyPath: 'projectID' });
	objectStore.createIndex('name', 'name', { unique: false });
	objectStore.createIndex('row', 'row', { unique: false });
	objectStore.createIndex('stitch', 'stitch', { unique: false });
	
	objectStore.transaction.oncomplete = function (e) {
		var customerStore = db.transaction('projects').objectStore('projects');
		customerStore.add(proj);
	}
}

function onDeviceReady() {
	
	projectList = {
		"one": {
			"name": "ProjectName",
			"row": 1,
			"stitch": 0
		},
		"two": {
			"name": "ProjectName2",
			"row": 1,
			"stitch": 4
		}
	};
    console.log('Running cordova-' + cordova.platformId + '@' + cordova.version);
    document.getElementById('deviceready').classList.add('ready');
	
	redrawList();
	
	$(".back-arrow").click(openHomePage);
	
	$(".update-prop-input").click(function(e){
		e.target.setSelectionRange(0, e.target.value.length);
	});
}

function redrawList() {
	$(".project-list-wrapper").empty()
	
	$.each(projectList, function(i, val) {
		var thisRow = $(".template-row").clone().removeClass("template-row").addClass(i);
		
		$(thisRow).find(".project-name").text(val.name);
		$(thisRow).find(".project-stitch").text("Row " + val.row + " stitch " + val.stitch);
		
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

function addStitch() {
	projectList[activeIndex].stitch++;
	$("#stitch-counter").val(projectList[activeIndex].stitch);
}

function addRow() {
	projectList[activeIndex].row++;
	projectList[activeIndex].stitch = 0;
	$("#row-counter").val(projectList[activeIndex].row);
	$("#stitch-counter").val(projectList[activeIndex].stitch);
}

function inlineUpdateProp(val, prop) {
	if(val == "") return false;
	projectList[activeIndex][prop] = parseInt(val) || val;
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
	var sanitisedName = $("#new-project-name").val().replace(/[\W]/g, "-");
	
	projectList[$("#new-project-name").val()] = {
		"name": $("#new-project-name").val(),
		"row": 1,
		"stitch": 0
	};
	
	openHomePage();
}