const navIcon = document.getElementById("navbar-user");
const poppup = document.getElementById("poppup");
let isOpen = false;
let timeout;

navIcon.addEventListener("mouseover", showPopup);

poppup.addEventListener("focusin", () => {
    clearTimeout(timeout);
});

poppup.addEventListener("mouseleave", () => {
    timeout = setTimeout(() => {
        hidePopup();
    }, 500);
});
poppup.addEventListener("mouseenter", () => {
    console.log("mouse enter in pop");
    clearTimeout(timeout);
});

function showPopup() {
    if (isOpen) return;
    poppup.classList.remove("hidden");
    poppup.classList.add("block");
    isOpen = true;

    clearTimeout(timeout);
    timeout = setTimeout(() => {
        hidePopup();
    }, 5000);
}

function hidePopup() {
    poppup.classList.remove("block");
    poppup.classList.add("hidden");
    isOpen = false;
}
