const navBar=document.getElementById('nav-bar'),
    toggelButton=document.getElementById('toggel-button'),
    navClose=document.getElementById('nav-close');


    if(toggelButton){
        toggelButton.addEventListener("click",()=>{
            navBar.classList.add('show_nav')
            
            console.log('valider')
        
        })
    }

    if(navClose){
        navClose.addEventListener('click',()=>{
            navBar.classList.remove('show_nav')
        })
    }