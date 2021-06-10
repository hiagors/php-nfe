function setSelected(el){
    var elements = document.getElementsByClassName('tab');   
    for (let element of elements){
        element.style.display = 'none';
    }
    document.getElementById(el).style.display  = 'block';            
}