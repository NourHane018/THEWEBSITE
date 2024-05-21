const MobileNav = () => {
    const headerButton = document.querySelector ('.header__bars');
    const MobileNav = document.querySelector ('.mobile__nav');
    const Mobilelinks = document.querySelectorAll ('.mobile__link');

    let isMobileNavOpen = false; 

    headerButton.addEventListener('click',() => {
        isMobileNavOpen= !isMobileNavOpen;
        if (isMobileNavOpen){
            MobileNav.style.display='flex';
            document.body.style.overflowY = 'hidden'
        }
        else{
            MobileNav.style.display='none';
            document.body.style.overflowY = 'auto'
        }
       
    });
    Mobilelinks.forEach(link => {
        link.addEventListener('click',() => {
            isMobileNavOpen = false;
            MobileNav.style.display='none';
            document.body.style.overflowY = 'auto'
        })
        
    }); 
};



export default MobileNav;
