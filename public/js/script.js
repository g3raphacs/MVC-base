let twigContainer = null

// Exemple d'utilisation  de la fonction Ajax

// function newScrap(){
    
//     ajax('newScrap' ,null, null , (xhr)=>{
//         ajax('scraplist' ,null, null , (xhr)=>{
//             twigContainer = document.getElementById('scrapitems-container')
//             twigContainer.innerHTML = xhr.responseText
//         })
//     })
// }




// AJAX FUNCTION________________________________________________________________
function ajax (route , form = null , data = null , callback = null){
    let formdata
    if (form){
        formdata = new FormData(form);
    }else{
        formdata = new FormData()
    }
    if(data){
        for (const [key, value] of Object.entries(data)) {
            formdata.append(key, value);
          }
    }
    const xhr = new XMLHttpRequest();
    const phproute = route;

    xhr.open('POST', phproute, true);
    xhr.send(formdata);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if(callback !== null){
                callback(xhr)
            }
        }
    }
}