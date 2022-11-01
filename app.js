const addBtn = document.getElementById("addBtn") ;
const formTitle = document.getElementById("form-title");
const updateBtn = document.getElementById("task-update-btn");
const saveBtn = document.getElementById("task-save-btn");


function resetForm(){
    document.getElementById('task-title').value = '';
    document.getElementById('task-type-feature').checked = true;
    document.getElementById('task-priority').value = '';
    document.getElementById('task-status').value = '';
    document.getElementById('task-date').value = '';
    document.getElementById('task-description').value = '';
}
function changeFormStatus(){
    formTitle.innerHTML='ADD TASK';
    saveBtn.style.display='inline-block';
    updateBtn.style.display='none';
    resetForm();
}

function fullForm(id,title,type,priority,status,date,description)
{
    // console.log(id,title,type,priority,status,date,description);

    formTitle.innerHTML='EDIT THE TASK';
    saveBtn.style.display='none';
    updateBtn.style.display='inline-block';
    
    document.getElementById('idT').value = id;
    document.getElementById('task-title').value = title;
    if(type == 1){
    document.getElementById('task-type-feature').checked = true;
    }else{
    document.getElementById('task-type-bug').checked = true;}
    document.getElementById('task-priority').value = priority;
    document.getElementById('task-status').value = status;
    document.getElementById('task-date').value = date;
    document.getElementById('task-description').value = description;
}
