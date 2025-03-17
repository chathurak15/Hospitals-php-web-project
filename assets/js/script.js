document.addEventListener('DOMContentLoaded', function() {
    // Tab Functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
});

// DOM Elementsz
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    // Function to get current page name from URL
    function getCurrentPage() {
        const path = window.location.pathname;
        const filename = path.split("/").pop();
        return filename ? filename.replace(".php", "") : "dashboard";
    }

    // Function to update active states
    function updateActiveStates() {
        const currentPage = getCurrentPage();

        // Remove all active classes
        document.querySelectorAll(".nav-link, .dropdown-item").forEach(item => {
            item.classList.remove("active");
        });

        // Add active class to the correct page
        const activeLink = document.querySelector(`[data-page="${currentPage}"]`);
        if (activeLink) {
            activeLink.classList.add("active");

            // If it's inside a dropdown, open the dropdown
            const parentDropdown = activeLink.closest(".nav-dropdown");
            if (parentDropdown) {
                parentDropdown.classList.add("active");
            }
        }
    }

    // Toggle dropdown menu
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();

            const parentDropdown = this.closest(".nav-dropdown");

            // Close all dropdowns before opening a new one
            document.querySelectorAll(".nav-dropdown").forEach(dropdown => {
                if (dropdown !== parentDropdown) {
                    dropdown.classList.remove("active");
                }
            });

            // Toggle current dropdown
            parentDropdown.classList.toggle("active");
        });
    });

    // Run function on page load
    updateActiveStates();
});


// Close sidebar when clicking outside on mobile
document.addEventListener('click', (e) => {
    if (window.innerWidth <= 768) {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnToggleBtn = toggleSidebarBtn.contains(e.target);
        
        if (!isClickInsideSidebar && !isClickOnToggleBtn && sidebar.classList.contains('active')) {
            closeSidebar();
        }
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active');
    }
});

// Example notification system
const notificationBtn = document.querySelector('.notification-btn');
notificationBtn.addEventListener('click', () => {
    alert('Notifications feature coming soon!');
});

// Example search functionality
const searchInput = document.querySelector('.search-box input');
searchInput.addEventListener('input', (e) => {
    console.log('Searching for:', e.target.value);
    // Implement search functionality here
});

// Example add patient functionality
const addPatientBtn = document.querySelector('.add-patient-btn');
if (addPatientBtn) {
    addPatientBtn.addEventListener('click', () => {
        alert('Add patient feature coming soon!');
    });
}

