
//Laisser la navbar fixed au defilement 


//querySelector permet de chercher dans le dom par id 
const navbar = document.querySelector('.navbar');

if (navbar){
    //Fait référence à la fenetre
    window.addEventListener('scroll',() => {
        //si dans le document , le body à été scrollé à  la hauter de la navbar
        if (document.body.scrollTop > navbar.offsetHeight || 
            document.documentElement.scrollTop > navbar.offsetHeight )
            {
                navbar.classList.add('fixed-top');
            } else{
                navbar.classList.remove('fixed-top');
            }
    });

}