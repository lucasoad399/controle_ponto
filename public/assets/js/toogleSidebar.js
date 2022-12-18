(function toogleSidebar(){
    let toogle = document.querySelector('.menu-toogle');
    const body = document.querySelector('body');
    toogle.addEventListener('click', (e)=>{
    e.stopPropagation();
    body.classList.toggle('aside-hide')
});
})();