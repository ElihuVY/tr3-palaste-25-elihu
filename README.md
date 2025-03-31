# Palaste - Plataforma de Soldadura

## Descripción
Palaste es una plataforma web diseñada para una empresa de soldadura que permite a los usuarios explorar productos, realizar compras y solicitar proyectos personalizados. La aplicación cuenta con un sistema de autenticación, una tienda con categorías y un apartado especial donde los usuarios pueden especificar detalles de sus proyectos y enviarlos al backend para su procesamiento.

## Tecnologías Utilizadas
- **Frontend:** Vue.js
- **Backend:** Laravel
- **Base de Datos:** MySQL (o la base de datos que estés utilizando)
- **Autenticación:** Laravel Sanctum / JWT (especificar si usaste algún método particular)
- **Estilos:** TailwindCSS / Bootstrap (según corresponda)

## Características Principales
- **Registro y Login:** Permite a los usuarios crear una cuenta e iniciar sesión de forma segura.
- **Tienda con Categorías:** Sección donde los clientes pueden explorar y comprar productos de soldadura organizados por categorías.
- **Sistema de Pedidos Personalizados:** Los usuarios pueden enviar solicitudes específicas con detalles sobre su proyecto de soldadura.
- **Gestión de Usuarios y Pedidos:** Sección de administración para gestionar pedidos y solicitudes de los clientes.

## Instalación y Configuración
### Requisitos previos
- Node.js y npm instalados
- PHP y Composer instalados
- Base de datos configurada (MySQL, PostgreSQL, etc.)

### Pasos de instalación
1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/tu_usuario/palaste.git
   cd palaste
   ```
2. **Instalar dependencias del backend:**
   ```bash
   cd backend
   composer install
   ```
3. **Configurar variables de entorno:**
   Copiar el archivo `.env.example` a `.env` y configurar la base de datos y claves necesarias.
   ```bash
   cp .env.example .env
   ```
   Luego ejecutar:
   ```bash
   php artisan key:generate
   ```
4. **Ejecutar migraciones y seeders:**
   ```bash
   php artisan migrate --seed
   ```
5. **Iniciar el servidor backend:**
   ```bash
   php artisan serve
   ```
6. **Instalar dependencias del frontend:**
   ```bash
   cd frontend
   npm install
   ```
7. **Iniciar el servidor frontend:**
   ```bash
   npm run dev
   ```

## Uso
- Accede a la aplicación en `http://localhost:8000` para la API y `http://localhost:5173` (o el puerto de Vue) para la interfaz de usuario.
- Regístrate e inicia sesión para acceder a la tienda y realizar pedidos.
- Usa el formulario de solicitudes personalizadas para enviar proyectos a medida.

## Contribuciones
Si deseas contribuir, abre un _issue_ o envía un _pull request_.

## Licencia
Este proyecto está bajo la licencia MIT.

---
Desarrollado con ❤️ por el equipo de Palaste

