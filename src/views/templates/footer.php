    <footer class="footer">
        <div>
            <span>Desenvolvido com</span> 
            <span class="icofont-heart text-danger"></span> 
            <span>por Cod<span class="text-danger" alt="amor">3</span>r</span>
        </div>
    </footer>
    <script src="/assets/js/toogleSidebar.js">
    </script>
    <script>
        let activeClock = document.querySelector('.active-clock');
        let arrayHora = activeClock.innerHTML.trim().split(':');
        // console.log(arrayHora);
        let hora = new Date();
        hora.setHours(arrayHora[0]);
        hora.setMinutes(arrayHora[1]);
        hora.setSeconds(arrayHora[2]);
        // console.log(hora);
        hora.setSeconds(hora.getSeconds()+1);
    
        setInterval(()=>{
            hora.setSeconds(hora.getSeconds()+1);
            let stringTime = `${hora.getHours()}:${hora.getMinutes()}:${hora.getSeconds()}`;
            arrayTime =stringTime.trim().split(':');
            
            for(index in arrayTime){
                
                if(arrayTime[index].length == 1) arrayTime[index]= '0'+arrayTime[index];
            }
            stringTime = arrayTime.join(':');
            activeClock.innerHTML = stringTime;
                
   
            
        
        },1000);
    </script>
    
    </body>
</html>