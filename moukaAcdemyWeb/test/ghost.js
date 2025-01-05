const navMenu=document.getElementById('nav-menu'),
    navClose=document.getElementById('nav-close'),
    toggelButton=document.getElementById('toggel-button'),
    nav__logo=document.querySelector('.nav__logo')


if(toggelButton){
    toggelButton.addEventListener("click",()=>{
        navMenu.classList.add('show-menu')
        nav__logo.classList.add('new-logo')
    
    })
}

if(navClose){
    navClose.addEventListener('click',()=>{
        navMenu.classList.remove('show-menu')
        nav__logo.classList.remove('new-logo')
    })
}


const navLink=document.querySelector('.nav__link');

