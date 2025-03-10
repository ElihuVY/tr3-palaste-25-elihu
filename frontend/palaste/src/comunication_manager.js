export const laravel = { URL: "http://127.0.0.1:8000/api" };

export async function register(param) {
    const URL = `${laravel.URL}/register`;
    const response = await fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            username: param.username,
            email: param.email,
            password: param.password,
        })
    });

    const data = await response.json();
    return data;
}

export async function login(param) {
    const URL = `${laravel.URL}/login`;
    const response = await fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            username: param.username,
            password: param.password
        })
    });

    const data = await response.json();
    console.log(data)
    return data;
}

