export const laravel = { URL: "http://127.0.0.1:8000/api" };

const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
  
  
  export async function register(param) {
    const URL = `${laravel.URL}/register`;
    const response = await fetch(URL, {
        method: 'POST',
        mode: 'cors',
        credentials: 'include', 
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            name: param.name,
            email: param.email,
            password: param.password,
            password_confirmation: param.password_confirmation
        })
    });
    const data = await response.json();
    return data;
}

    export async function login(param) {
        const URL = `${laravel.URL}/login`;
        const response = await fetch(URL, {
            method: 'POST',
            mode: 'cors',
            credentials: 'include', 
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: param.email,
                password: param.password
            })
        });
    
        const data = await response.json();
        console.log(data)
        return data;
    }
  

    
  