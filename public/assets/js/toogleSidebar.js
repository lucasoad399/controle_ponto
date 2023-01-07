// (function toogleSidebar(){
    let toogle = document.querySelector('.menu-toogle');
   
    const body = document.querySelector('body');
    toogle.addEventListener('click', (e)=>{
    e.stopPropagation();
    body.classList.toggle('aside-hide');

    console.log('meu pau');
    // //setando o relógio animado
    let activeClock = document.querySelector('.testexpto');
    // activeClock.innerHTML = 'CU';
    // let interval = setInterval(()=>{
    //     activeClock.innerHTML= 'Cu';
    // },1000);
});
// })();


  

