// Get the anchor link element
const scrollToCategoriesLink = document.getElementById("scrollToCategories");
const scrollToPartnersLink = document.getElementById("scrollToPartners");
const scrollToEquipmentsLink = document.getElementById("scrollToEquipments");
const scrollToVitaminsLink = document.getElementById("scrollToVitamins");


// Get the section you want to scroll to
const categoriesSection = document.getElementById("categories-section");
const partnersSection = document.getElementById("partners-section");
const equipmentsSection = document.getElementById("equipments-section");
const vitaminsSection = document.getElementById("vitamins-section");

// Add a click event listener to the anchor link
scrollToCategoriesLink.addEventListener("click", function(event) {
    // Prevent the default behavior of the anchor link (to avoid jumping to the top of the page)
    event.preventDefault();

    // Scroll to the "Categories" section
    categoriesSection.scrollIntoView({ behavior: "smooth" });
});
scrollToPartnersLink.addEventListener("click", function(event) {
    // Prevent the default behavior of the anchor link (to avoid jumping to the top of the page)
    event.preventDefault();

    // Scroll to the "Categories" section
    partnersSection.scrollIntoView({ behavior: "smooth" });
});
scrollToEquipmentsLink.addEventListener("click", function(event) {
    // Prevent the default behavior of the anchor link (to avoid jumping to the top of the page)
    event.preventDefault();

    // Scroll to the "Categories" section
    equipmentsSection.scrollIntoView({ behavior: "smooth" });
});

scrollToVitaminsLink.addEventListener("click", function(event) {
    // Prevent the default behavior of the anchor link (to avoid jumping to the top of the page)
    event.preventDefault();

    // Scroll to the "Categories" section
    vitaminsSection.scrollIntoView({ behavior: "smooth" });
});