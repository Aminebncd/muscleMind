
// just to ensure that the dom is fully loaded before running the script
document.addEventListener('DOMContentLoaded', (event) => {
    console.log("ici");

    // had an issue with the activity and progress buttons
    // they were not working properly because the script was also looking
    // for the front and back buttons which were not present in the activity page
    // that led to the whole script being ignored
    // so now I'm checking if the buttons are present before adding the event listeners
    // works fine now
    // i love javascript
    let activityButton = document.getElementById('activityButton');
    let progressButton = document.getElementById('progressButton');
    let frontBtn = document.getElementById('frontBtn');
    let backBtn = document.getElementById('backBtn');

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
});