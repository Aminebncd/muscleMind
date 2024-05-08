

// Simple JavaScript code to change the view of the card from front to back and vice versa
document.getElementById("frontBtn").addEventListener("click", function() {
    document.getElementById("Frontview").style.display = "inline";
    document.getElementById("Backview").style.display = "none";
});

document.getElementById("backBtn").addEventListener("click", function() {
    document.getElementById("Backview").style.display = "inline";
    document.getElementById("Frontview").style.display = "none";
});