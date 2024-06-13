
// just to ensure that the dom is fully loaded before running the script
// document.addEventListener('DOMContentLoaded', (event) => {
    console.log("ici");
    
    var burgerMenu = document.getElementById('burger-menu');
    var closeMenu = document.getElementById('close-menu');
    var menu = document.getElementById('menu');
    
    burgerMenu.addEventListener('click', () => {
    menu.classList.remove('menu-open');
    console.log("ici3");
    });
    
    closeMenu.addEventListener('click', () => {
        menu.classList.add('menu-open');
        console.log("ici4");
    });


    var activityButton = document.getElementById('activityButton');
    var progressButton = document.getElementById('progressButton');
    var frontBtn = document.getElementById('frontBtn');
    var backBtn = document.getElementById('backBtn');

    if (activityButton && progressButton) {
        activityButton.addEventListener('click', function() {
            console.log("activity button clicked");
            document.getElementById('ACTIVITY').style.display = "block";
            document.getElementById('PROGRESS').style.display = "none";
        });

        progressButton.addEventListener('click', function() {
            console.log("progress button clicked");
            document.getElementById('PROGRESS').style.display = "block";
            document.getElementById('ACTIVITY').style.display = "none";
        });
    }

    if (frontBtn && backBtn) {
        frontBtn.addEventListener("click", function() {
            console.log("front button clicked");
            document.getElementById("Frontview").style.display = "inline";
            document.getElementById("Backview").style.display = "none";
        });
        
        backBtn.addEventListener("click", function() {
            console.log("back button clicked");
            document.getElementById("Backview").style.display = "inline";
            document.getElementById("Frontview").style.display = "none";
        });
    }

    console.log("la");
// });