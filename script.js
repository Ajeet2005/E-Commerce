<Script>
    // Dummy data for demonstration
let userData = {
    fullName: "John Doe",
    firstName: "John",
    lastName: "Doe",
    email: "test@hash.com",
    phone: "+9771234",
    birthdate: "2000-01-01",
    country: "United Kingdom",
    city: "Leeds, East London"
};

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('user-fullname').innerText = userData.fullName;
    document.getElementById('user-firstname').innerText = userData.firstName;
    document.getElementById('user-lastname').innerText = userData.lastName;
    document.getElementById('user-email').innerText = userData.email;
    document.getElementById('user-phone').innerText = userData.phone;
    document.getElementById('user-birthdate').innerText = userData.birthdate;
    document.getElementById('display-country').innerText = userData.country;
    document.getElementById('display-city').innerText = userData.city;
});

function updateAddress() {
    const country = document.getElementById('country').value;
    const city = document.getElementById('city').value;

    if (country && city) {
        // Update the display
        document.getElementById('display-country').innerText = country;
        document.getElementById('display-city').innerText = city;

        // Save changes (e.g., to the database)
        userData.country = country;
        userData.city = city;
        
        alert("Address updated successfully!");
    }
}

function logout() {
    // Logout functionality, e.g., clear session
    window.location.href = 'logout.php';
}

</Script>