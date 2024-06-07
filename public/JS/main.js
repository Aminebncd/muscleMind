
console.log("JS file loaded");

// Simple JavaScript code to change the view of the card from front to back and vice versa
document.getElementById("frontBtn").addEventListener("click", function() {
    // console.log("front button clicked");
    document.getElementById("Frontview").style.display = "inline";
    document.getElementById("Backview").style.display = "none";
});

document.getElementById("backBtn").addEventListener("click", function() {
    document.getElementById("Backview").style.display = "inline";
    document.getElementById("Frontview").style.display = "none";
});

// same thing here but with the user trackings and activity
document.getElementById("activityButton").addEventListener("click", function() {
    console.log("activity button clicked");
    document.getElementById("Frontview").style.display = "block";
    document.getElementById("Backview").style.display = "none";
});

document.getElementById("progressButton").addEventListener("click", function() {
    console.log("progress button clicked");
    document.getElementById("Frontview").style.display = "block";
    document.getElementById("Backview").style.display = "none";
});