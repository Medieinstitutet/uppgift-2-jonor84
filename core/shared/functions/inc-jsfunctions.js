// Function to generate a random password
function generateRandomPasswordJS(length) {
    // Define character sets
    const capitalLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    const digits = '0123456789';
    const specialCharacters = '!@#$%^&*()-_=+{};:,<.>';

    // Combine character sets
    const allCharacters = capitalLetters + lowercaseLetters + digits + specialCharacters;

    let password = '';
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * allCharacters.length);
        password += allCharacters[randomIndex];
    }

    return password;
}
