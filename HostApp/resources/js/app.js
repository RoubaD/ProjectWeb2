import './bootstrap';
import Alpine from 'alpinejs';
import $ from "jquery";
import "select2";
import { gsap } from "gsap";

window.Alpine = Alpine;
Alpine.start();

$(document).ready(function () {
    // Initialize Select2 for dropdowns
    $("#amenities").select2({
        placeholder: "Select amenities",
        allowClear: true,
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form.filter-form");
    const resultsContainer = document.querySelector(".property-list");

    if (!form || !resultsContainer) {
        console.error("Form or results container not found.");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        // Collect form data
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        // Perform AJAX call
        fetch(`/detailedSearch?${queryString}`, {
            method: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                // Render the search results dynamically
                renderResults(data.destinations);

                // Clear inputs **only if search completes successfully**
                clearForm();
            })
            .catch((error) => console.error("Error fetching search results:", error));
    });

    // Function to render search results dynamically
    function renderResults(destinations) {
        resultsContainer.innerHTML = ""; // Clear old results

        if (destinations.length > 0) {
            destinations.forEach((destination) => {
                const propertyCard = `
                    <div class="bg-white rounded-lg shadow-md property-card">
                        <img src="${destination.image}" alt="${destination.name}" class="w-full h-64 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-[#91766e]">${destination.name}</h3>
                            <p class="text-sm text-gray-600"><strong>Price:</strong> $${Number(destination.price).toFixed(2)}</p>
                            <p class="text-sm text-gray-600"><strong>Type:</strong> ${destination.property_type}</p>
                            <p class="text-sm text-gray-600"><strong>Capacity:</strong> ${destination.guest_capacity} guests</p>
                            <p class="text-sm text-gray-600"><strong>Amenities:</strong> ${
                                Array.isArray(destination.amenities)
                                    ? destination.amenities.join(", ")
                                    : "Not specified"
                            }</p>
                        </div>
                    </div>
                `;
                resultsContainer.insertAdjacentHTML("beforeend", propertyCard);
            });

            // Animate new results
            gsap.from(".property-card", {
                opacity: 0,
                scale: 0.9,
                duration: 1,
                stagger: 0.2,
            });
        } else {
            resultsContainer.innerHTML = `<p class="col-span-full text-center text-[#91766e]">No destinations match your criteria.</p>`;
        }
    }

    // Function to clear form inputs
    function clearForm() {
        form.reset();
        if (window.$) {
            $("#amenities").val(null).trigger("change");
        }
    }
});

// GSAP Animations
document.addEventListener("DOMContentLoaded", () => {
    gsap.from(".search-container", { opacity: 0, y: -50, duration: 1 });
    gsap.from(".property-card", {
        opacity: 0,
        scale: 0.9,
        duration: 1,
        stagger: 0.2,
    });
});
