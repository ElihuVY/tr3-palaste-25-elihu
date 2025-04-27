export const laravel = {
  //google_npm_hoghtst_80
    URL: "https://palaste.com/api"
  };
  
  const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  };
  
  export async function register(param) {
    const URL = `${laravel.URL}/register`;
    const response = await fetch(URL, {
      method: 'POST',
      mode: 'cors',
      credentials: 'include',
      headers,
      body: JSON.stringify(param)
    });
    const data = await response.json();
    if (data.token) {
      localStorage.setItem('token', data.token);
    }
    return data;
  }
  
  export async function login(param) {
    const URL = `${laravel.URL}/login`;
    try {
      const response = await fetch(URL, {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        headers,
        body: JSON.stringify(param)
      });
  
      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Error en el inicio de sesión');
      }
  
      const data = await response.json();
      if (data.token) {
        localStorage.setItem('token', data.token);
      }
      return data;
    } catch (error) {
      console.error('Login error:', error);
      throw error;
    }
  }
  
  export async function logout() {
    const URL = `${laravel.URL}/logout`;
    try {
      const response = await fetch(URL, {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        headers: {
          ...headers,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      });
  
      if (!response.ok) {
        throw new Error('Error al cerrar sesión');
      }
  
      localStorage.removeItem('token');
      return await response.json();
    } catch (error) {
      console.error('Logout error:', error);
      throw error;
    }
  }

  export async function submitProjectRequest(formData) {
    const URL = `${laravel.URL}/project-requests`;
    try {
      const response = await fetch(URL, {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json'
        }
      });
  
      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Error en el envío de la solicitud');
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error al enviar la solicitud de proyecto:', error);
      throw error;
    }
  }
  
  export async function getProducts() {
    const URL = `${laravel.URL}/products`;
    try {
      const response = await fetch(URL, {
        method: 'GET',
        headers
      });
  
      if (!response.ok) {
        throw new Error(`Error ${response.status}: ${response.statusText}`);
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error fetching products:', error);
      throw error;
    }
  }
  
  export async function getUserProfile() {
    const URL = `${laravel.URL}/user/profile`;
    try {
      const response = await fetch(URL, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
          ...headers,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      });
  
      if (!response.ok) {
        throw new Error('Failed to fetch user profile');
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error fetching user profile:', error);
      throw error;
    }
  }
  
  export async function getUserOrdersAndRequests() {
    const URL = `${laravel.URL}/perfil/datos`;
    try {
      const response = await fetch(URL, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
          ...headers,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      });
  
      if (!response.ok) {
        throw new Error(`Error ${response.status}: ${response.statusText}`);
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error fetching user orders and requests:', error);
      throw error;
    }
  }
  
  export async function changePassword(data) {
    const URL = `${laravel.URL}/user/cambiar-contra`;
    try {
      const response = await fetch(URL, {
        method: 'POST',
        mode: 'cors',
        credentials: 'include',
        headers: {
          ...headers,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify(data)
      });
  
      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Error al cambiar la contraseña');
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error changing password:', error);
      throw error;
    }
  }
  
  export async function getCurrentUser() {
    const URL = `${laravel.URL}/user`;
    try {
      const response = await fetch(URL, {
        method: 'GET',
        mode: 'cors',
        credentials: 'include',
        headers: {
          ...headers,
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      });
  
      if (!response.ok) {
        throw new Error('Failed to fetch current user');
      }
  
      return await response.json();
    } catch (error) {
      console.error('Error fetching current user:', error);
      throw error;
    }
  }
  