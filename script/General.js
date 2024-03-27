console.log("General.js loaded");
function makeCookieUser(username){
    const expiryDate = new Date();
    expiryDate.setMonth(expiryDate.getMonth() + 1);
    document.cookie = `loggedinUser=${username}; expires=${expiryDate.toUTCString()};path=/`;
    console.log("made cookie");
}

function getCookieUser() {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith('loggedinUser=')) {
            const username = cookie.substring('loggedinUser='.length, cookie.length);
            // Save the username in a session variable
            sessionStorage.setItem('username', username);
            return username;
        }
    }
    return "not found";
}
getCookieUser();