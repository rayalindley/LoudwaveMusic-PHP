document.addEventListener("DOMContentLoaded", function() {
    const container = document.querySelector('.container');
    const seats = container.querySelectorAll('.row .seat:not(.occupied)');
    const count = document.getElementById('count');
    const total = document.getElementById('total');
    const updateButton = document.getElementById('updateButton');
    let ticketPrice = 6204; // Replace 10 with the actual ticket price fetched from the server
    let selectedSeats = [];

    // Update total and count
    // Update total and count
function updateSelectedCount() {
    const selectedSeatsCount = selectedSeats.length;
    console.log("Selected seats count:", selectedSeatsCount);
    count.innerText = selectedSeatsCount;
    const totalPrice = selectedSeatsCount * ticketPrice;
    console.log("Total price:", totalPrice);
    total.innerText = totalPrice;
}


    // Seat click event
    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
            if (selectedSeats.length < 5 || e.target.classList.contains('selected')) {
                e.target.classList.toggle('selected');
                const seatIndex = [...seats].indexOf(e.target);
                const row = Math.floor(seatIndex / 8); // Adjust based on your seat layout
                const column = seatIndex % 8;
                const seat = [row, column];
                const seatStr = JSON.stringify(seat);

                if (selectedSeats.map(JSON.stringify).includes(seatStr)) {
                    selectedSeats = selectedSeats.filter(s => JSON.stringify(s) !== seatStr);
                } else {
                    selectedSeats.push(seat);
                }

                updateSelectedCount();
            } else {
                alert('You can only select a maximum of 5 seats.');
            }
        }
    });

    // Initial count and total
    updateSelectedCount();

    // Button to update JSON
    updateButton.addEventListener('click', () => {
        const concertId = 11; // Replace with the actual concert ID
        const jsonData = JSON.stringify(selectedSeats);
        console.log('Updated booked seats data:', jsonData);

        // Send the selected seats to the server
        fetch('update_seat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                concertId: concertId,
                selectedSeats: jsonData
            })
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data === "Success") {
                alert('Seats updated successfully!');
                selectedSeats = [];
                seats.forEach(seat => seat.classList.remove('selected'));
                updateSelectedCount();
            } else {
                alert('Error updating seats: ' + data);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});