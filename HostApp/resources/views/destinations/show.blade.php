@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #fcece3, #ffffff);
        color: #91766e;
    }

    .container {
        padding: 20px;
        max-width: 800px;
        margin: auto;
    }

    .property-details {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .reservation-section {
        text-align: center;
        margin-top: 20px;
    }

    .reserve-button {
        background: #91766e;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .reserve-button:hover {
        background: #b7a7a9;
    }

    /* Popup Calendar Styles */
    .calendar-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        z-index: 1000;
    }

    .calendar-popup h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .calendar-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        text-align: center;
    }

    .calendar-cell {
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .calendar-cell:hover {
        background: #fcece3;
    }

    .calendar-cell.selected {
        background: #91766e;
        color: white;
    }

    .calendar-cell.in-range {
        background: #f7e7e3;
        color: #91766e;
    }

    .calendar-popup button,
    .calendar-popup select {
        margin-top: 15px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background: #91766e;
        color: white;
        transition: background 0.3s ease;
    }

    .calendar-popup button:hover {
        background: #b7a7a9;
    }

    .calendar-popup select {
        background: #f9f9f9;
        color: #91766e;
    }
</style>

<div class="container">
    <div class="property-details">
        <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}">
        <h1>{{ $destination->name }}</h1>
        <p><strong>Landmark:</strong> {{ $destination->landmark }}</p>
        <p><strong>Price:</strong> ${{ number_format($destination->price, 2) }} per night</p>
        <p><strong>Property Type:</strong> {{ $destination->property_type }}</p>
        <p><strong>Guest Capacity:</strong> {{ $destination->guest_capacity }}</p>

        <!-- Reserve Button -->
        <div class="reservation-section">
            <button id="reserve-button" class="reserve-button">Reserve</button>
        </div>

        <!-- Calendar Popup -->
        <div id="calendar-popup" class="calendar-popup">
            <div class="calendar-navigation">
                <button id="prev-month">&laquo; Previous</button>
                <div>
                    <select id="year-select"></select>
                    <span id="month-name"></span>
                </div>
                <button id="next-month">Next &raquo;</button>
            </div>
            <div id="calendar" class="calendar-grid"></div>
            <button id="confirm-button">Confirm</button>
        </div>

        <a href="{{ route('destinations') }}" class="back-button">Back to Destinations</a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const reserveButton = document.getElementById("reserve-button");
        const calendarPopup = document.getElementById("calendar-popup");
        const confirmButton = document.getElementById("confirm-button");
        const prevMonthButton = document.getElementById("prev-month");
        const nextMonthButton = document.getElementById("next-month");
        const yearSelect = document.getElementById("year-select");
        const monthName = document.getElementById("month-name");
        const calendar = document.getElementById("calendar");

        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth();
        let selectedDates = [];

        reserveButton.addEventListener("click", () => {
            calendarPopup.style.display = "block";
            populateYearSelect();
            generateCalendar();
        });

        prevMonthButton.addEventListener("click", () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar();
        });

        nextMonthButton.addEventListener("click", () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar();
        });

        yearSelect.addEventListener("change", (e) => {
            currentYear = parseInt(e.target.value);
            generateCalendar();
        });

        confirmButton.addEventListener("click", async () => {
            if (selectedDates.length === 2) {
                const [startDate, endDate] = selectedDates;

                try {
                    // Check if the user is authenticated
                    const response = await fetch('/api/check-auth');
                    const data = await response.json();
                    

                    if (data.authenticated) {
                        // Submit the reservation
                        const reservationResponse = await fetch('/reservation', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({
                                start_date: startDate,
                                end_date: endDate,
                                destination_id: {{ $destination->id }},
                            }),
                        });

                        const result = await reservationResponse.json();

                        if (reservationResponse.ok) {
                            alert("Reservation successful!");
                            // Optionally, redirect to the reservation details page
                            window.location.href = '/reservations/' + result.id;
                        } else {
                            alert("There was an issue creating your reservation. Please try again.");
                        }
                    } else {
                        // Redirect to login page if not authenticated
                        window.location.href = '/login';
                    }
                } catch (error) {
                    alert('An error occurred. Please try again.');
                    console.error(error);
                }
            } else {
                alert("Please select a start and end date.");
            }
        });


        function populateYearSelect() {
            yearSelect.innerHTML = "";
            for (let year = currentYear - 5; year <= currentYear + 5; year++) {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;
                if (year === currentYear) option.selected = true;
                yearSelect.appendChild(option);
            }
        }

        function generateCalendar() {
            calendar.innerHTML = "";
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();

            monthName.textContent = new Date(currentYear, currentMonth).toLocaleString("default", {
                month: "long"
            });

            let startDate = selectedDates[0];
            let endDate = selectedDates[1];

            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement("div");
                calendar.appendChild(emptyCell);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const cell = document.createElement("div");
                cell.classList.add("calendar-cell");
                const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
                cell.dataset.date = formattedDate;
                cell.textContent = day;

                if (startDate && endDate && formattedDate > startDate && formattedDate < endDate) {
                    cell.classList.add("in-range");
                }

                if (selectedDates.includes(formattedDate)) {
                    cell.classList.add("selected");
                }

                cell.addEventListener("click", () => {
                    if (!cell.classList.contains("selected")) {
                        if (selectedDates.length < 2) {
                            selectedDates.push(formattedDate);
                        } else {
                            selectedDates = [formattedDate];
                        }
                    } else {
                        selectedDates = selectedDates.filter(date => date !== formattedDate);
                    }
                    generateCalendar();
                });

                calendar.appendChild(cell);
            }
        }
    });
</script>

@endsection