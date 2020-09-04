//import axios from 'axios'


const form = document.querySelector('form');

const LoginUser = (user) => {
    axios.post('http://http://165.232.110.31//api/login', {
            data: {
                email: user.email,
                password: user.password
            }
        })
        .then(response => {

            sessionStorage.setItem('Token', response.data.success.token);
            window.location.href = '/category_list2';

        })
        .catch(error => console.error(error));
};


const formEvent = form.addEventListener('submit', event => {
    event.preventDefault();

    const email = document.querySelector('#user').value;
    const password = document.querySelector('#password').value;

    const user = { email, password };
    LoginUser(user);
});