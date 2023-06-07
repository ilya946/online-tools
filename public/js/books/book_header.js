console.log(location.href)
Array.from(document.querySelectorAll(".links_to_functions a")).forEach(el => {
    if(el.href === location.href){
        el.classList.add("active");
        return 0;
    }
})
