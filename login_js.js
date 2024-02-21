const container = document.getElementById('container');
const registerBtn = document.getElementById('admin');
const loginBtn = document.getElementById('student');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});