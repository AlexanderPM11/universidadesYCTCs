
  const divBtn = document.querySelector(".btnBar");
  divBtn.addEventListener("click", () => {
    const nav_Cont = document.querySelector(".cont_nav");
    let elementStyle = window.getComputedStyle(nav_Cont);
    let elementDisplay = elementStyle.getPropertyValue("display");

    if (elementDisplay == "flex") {
      nav_Cont.style.display = "none";
    } else {
      nav_Cont.style.display = "flex";
      
    }
  });

  const closeNav=document.querySelectorAll(".closeNav");
  console.log(closeNav)
  closeNav.forEach(nav =>{
      nav.addEventListener("click",()=> {
        const tamano= document.documentElement.clientWidth;
        if(tamano<=945){
          const ul_ConPri = document.querySelector(".cont_nav");
          ul_ConPri.style.display = "none";
        }
          
      }
      )
  });


  const Contmapa = document.querySelector(".Contmapa");
  Contmapa.addEventListener("click", () => {
      const subMap = document.querySelector(".subMap");
      let elementStyle = window.getComputedStyle(subMap);
      let elementDisplay = elementStyle.getPropertyValue("display");
    
      if (elementDisplay == "block") {
        subMap.style.display = "none";
      } else {
        subMap.style.display = "block";
      }
    });

 
    window.addEventListener('resize', ()=>{
      const tamano= document.documentElement.clientWidth;
      if(tamano>947){
        const ul_ConPri = document.querySelector(".cont_nav");
        ul_ConPri.style.display = "flex";
      }
 
    
    });


