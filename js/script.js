/* ========================================
   RESQFOOD JAVASCRIPT
   ======================================== */


/* Claim Food */

function claimFood(button, foodName) {

    button.textContent = "✓ Food Claimed";
    button.classList.add("claimed");
    button.disabled = true;

    document.getElementById("notificationText").textContent =
        foodName + " has been reserved for pickup.";

    document
        .getElementById("claimNotification")
        .classList.add("show");

}


/* Close Notification */

function closeNotification() {

    document
        .getElementById("claimNotification")
        .classList.remove("show");

}


/* Search Food */

function searchFood() {

    const searchValue =
        document.getElementById("foodSearch").value.toLowerCase();

    const cards =
        document.querySelectorAll(".rescue-card");

    cards.forEach(function(card) {

        const cardText =
            card.textContent.toLowerCase();

        if (cardText.includes(searchValue)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }

    });

}


/* Filter Food */

function filterFood() {

    const filterValue =
        document.getElementById("foodFilter").value;

    const cards =
        document.querySelectorAll(".rescue-card");

    cards.forEach(function(card) {

        const category =
            card.getAttribute("data-category");

        if (filterValue === "all" || category === filterValue) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }

    });

}
/* ========================================
   DONATION FORM
   ======================================== */

function submitDonation(event) {

    event.preventDefault();

    const foodName =
        document.getElementById("foodName").value;

    document.getElementById("donateNotification").classList.add("show");

    document.getElementById("donateForm").reset();

}


/* Close Donation Notification */

function closeDonationNotification() {

    document
        .getElementById("donateNotification")
        .classList.remove("show");

}