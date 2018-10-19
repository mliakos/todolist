//SVG codes variable declaration

var completeSVG = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><circle cx="25" cy="25" r="25"/><polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="38,15 22,33 12,25 "/>'
    
var removeSVG = '<svg class="remove" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 486.4 486.4" style="enable-background:new 0 0 486.4 486.4;" xml:space="preserve"><g><g><path d="M446,70H344.8V53.5c0-29.5-24-53.5-53.5-53.5h-96.2c-29.5,0-53.5,24-53.5,53.5V70H40.4c-7.5,0-13.5,6-13.5,13.5S32.9,97,40.4,97h24.4v317.2c0,39.8,32.4,72.2,72.2,72.2h212.4c39.8,0,72.2-32.4,72.2-72.2V97H446c7.5,0,13.5-6,13.5-13.5S453.5,70,446,70z M168.6,53.5c0-14.6,11.9-26.5,26.5-26.5h96.2c14.6,0,26.5,11.9,26.5,26.5V70H168.6V53.5z M394.6,414.2c0,24.9-20.3,45.2-45.2,45.2H137c-24.9,0-45.2-20.3-45.2-45.2V97h302.9v317.2H394.6z"/><path d="M243.2,411c7.5,0,13.5-6,13.5-13.5V158.9c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v238.5C229.7,404.9,235.7,411,243.2,411z"/><path d="M155.1,396.1c7.5,0,13.5-6,13.5-13.5V173.7c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v208.9C141.6,390.1,147.7,396.1,155.1,396.1z"/><path d="M331.3,396.1c7.5,0,13.5-6,13.5-13.5V173.7c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v208.9C317.8,390.1,323.8,396.1,331.3,396.1z"/>' 

//Trigger input with Enter key

var input = document.getElementById("main_input");


input.addEventListener("keyup", function(event) {
    if(event.keyCode === 13) {
        document.getElementById("submit_btn").click();
    main_input.value='' //Delete form input when submited
    }
});

//Various Functions

function addItem(value) {
    var list = document.getElementById('tasks'); //Unordered List
    
    var item = document.createElement('li'); //List Item
    item.innerText = value; //<li> value
    
    var buttons = document.createElement('div'); // Div
    buttons.classList.add('buttons'); // class = "buttons"
    
    var remove = document.createElement('button'); //Remove Button
    remove.classList.add('remove'); // class = "remove"
    remove.innerHTML = removeSVG; // <button> SVG CODE </button>
    var sub_button = document.getElementById('submit_btn');
    
    //Event Listener for removing item
    remove.addEventListener('click', removeItem);

    var complete = document.createElement('button'); //Complete Button
    complete.classList.add ('complete'); // class = "complete"
    complete.innerHTML = completeSVG; // <button> SVG CODE </button>
    
    //Event Listener for completing item
    complete.addEventListener('click', completeItem);
    
    
    //Appending SVG code to Button Tags
    buttons.appendChild(complete); 
    buttons.appendChild(remove); 
    item.appendChild(buttons);
    
    //Appending <li> to list
    list.insertBefore(item, list.childNodes[0]);
    
    sub_button.addEventListener('click', hideListA);
    sub_button.addEventListener('click', hideListB);
    remove.addEventListener('click', hideListA);
    complete.addEventListener('click', hideListA);
    remove.addEventListener('click', hideListB);
    complete.addEventListener('click', hideListB);
}

function removeItem() {
    var item = this.parentNode.parentNode;
    var parent = item.parentNode;
    
    parent.removeChild(item);
}

function completeItem() {
    var item = this.parentNode.parentNode;
    var parent = item.parentNode;
    var id = parent.id;
    
    //Check if item should be added to the completed list or to be re-added the todo list 
    var target = (id === 'tasks') ? document.getElementById('completed_tasks'):document.getElementById('tasks');
    
    parent.removeChild(item);
    target.insertBefore(item, target.childnodes);
}

  
var sub_button = document.getElementById('submit_btn'); //submit button

sub_button.addEventListener('click',function(){ //Event Listener
    var value = document.getElementById("main_input").value;//Grabbing input value
    if(value){
        addItem(value)
        main_input.value='' //Delete form input when submited
    }; //Adding item to list
})

//Remove To-do title if list is empty

var firstList = document.querySelector('ul#tasks');
//
//window.setInterval(function (){
//  if(firstList.childElementCount == 0){
//    document.querySelector('p#todo').style.display='none'}
//else{document.querySelector('p#todo').style.display='block'}  
//}, 10)

//Remove Done title if list is empty

var secondList = document.querySelector('ul#completed_tasks');
//
//
//window.setInterval(function (){
//  if(secondList.childElementCount == 0){
//    document.querySelector('p#done').style.display='none'}
//else{document.querySelector('p#done').style.display='block'}  
//}, 10)



//Removing paragraphs functions (if lists are empty)


function hideListA(){
    if(firstList.childElementCount > 0){
        document.querySelector('p#todo').style.display='block'}
    else{document.querySelector('p#todo').style.display='none'}
}

function hideListB(){
    if(secondList.childElementCount > 0){
        document.querySelector('p#done').style.display='block'}
    else{document.querySelector('p#done').style.display='none'}  
}

window.setInterval(hideListA,10);












