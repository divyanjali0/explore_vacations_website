// Initialize AOS
AOS.init();

// Navbar custom js to set active
function setActiveLink() {
    // Get the current page URL and extract the last word
    var currentPageUrl = window.location.href;

    // Extract the file name from the URL without the extension
    var fileNameWithoutExtension = currentPageUrl.substring(currentPageUrl.lastIndexOf('/') + 1).replace(/\..+$/, '');

    // Handle "Home" page case: treat an empty file name or "index" as "home"
    if (fileNameWithoutExtension === "" || fileNameWithoutExtension === "index") {
        fileNameWithoutExtension = "home";
    }

    // Get all navigation links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.toggle('active', link.getAttribute('page-name') === fileNameWithoutExtension);
    });
}
setActiveLink();

// Function to navigate to a section
function scrollToSection(sectionId) {
    var target = document.getElementById(sectionId);
    if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
    }
}