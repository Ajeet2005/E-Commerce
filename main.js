<script>
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
        // Check and update each element only if it exists in the HTML
        if (document.getElementById('user-fullname')) document.getElementById('user-fullname').innerText = userData.fullName;
        if (document.getElementById('user-firstname')) document.getElementById('user-firstname').innerText = userData.firstName;
        if (document.getElementById('user-lastname')) document.getElementById('user-lastname').innerText = userData.lastName;
        if (document.getElementById('user-email')) document.getElementById('user-email').innerText = userData.email;
        if (document.getElementById('user-phone')) document.getElementById('user-phone').innerText = userData.phone;
        if (document.getElementById('user-birthdate')) document.getElementById('user-birthdate').innerText = userData.birthdate;
        if (document.getElementById('display-country')) document.getElementById('display-country').innerText = userData.country;
        if (document.getElementById('display-city')) document.getElementById('display-city').innerText = userData.city;
    });

    function updateAddress() {
        const country = document.getElementById('country') ? document.getElementById('country').value : '';
        const city = document.getElementById('city') ? document.getElementById('city').value : '';

        if (country && city) {
            // Update the display only if elements exist
            if (document.getElementById('display-country')) document.getElementById('display-country').innerText = country;
            if (document.getElementById('display-city')) document.getElementById('display-city').innerText = city;

            // Save changes (e.g., to the database or object)
            userData.country = country;
            userData.city = city;
            
            alert("Address updated successfully!");
        } else {
            alert("Please enter both country and city.");
        }
    }

    function logout() {
        // Redirect to logout page or clear session if needed
        window.location.href = 'logout.php';
    }
</script>
