import { computed, reactive, readonly, ref } from 'vue';
import { defineStore } from 'pinia';
import { getUserProfile, getUserOrdersAndRequests } from '@/comunication_manager';

export const useAuthStore = defineStore('auth', () => {
  // Estado de autenticación (tu estructura actual)
  const loginInfo = reactive({
    loggedIn: false,
    username: '',
    email: '',
    token: '',
  });

  // Nuevo estado para datos de perfil y pedidos
  const profileData = reactive({
    userDetails: null,
    orders: [],
    projectRequests: [],
    isLoading: false,
    error: null
  });

  // Métodos existentes (sin cambios)
  const setLoginInfo = ({ loggedIn, username, email, token }) => {
    loginInfo.loggedIn = loggedIn;
    loginInfo.username = username;
    loginInfo.email = email;
    loginInfo.token = token;
  };

  const logout = () => {
    setLoginInfo({ loggedIn: false, username: '', email: '', token: '' });
    // Limpiar también los datos del perfil
    profileData.userDetails = null;
    profileData.orders = [];
    profileData.projectRequests = [];
  };

  // Nuevos métodos para manejar datos del perfil
  const fetchUserProfile = async () => {
    try {
      profileData.isLoading = true;
      profileData.error = null;
      const response = await getUserProfile();
      profileData.userDetails = response;
      return response;
    } catch (error) {
      profileData.error = 'Error al cargar el perfil';
      throw error;
    } finally {
      profileData.isLoading = false;
    }
  };

  const fetchUserOrdersAndRequests = async () => {
    try {
      profileData.isLoading = true;
      profileData.error = null;
      const response = await getUserOrdersAndRequests();
      profileData.orders = response.orders || [];
      profileData.projectRequests = response.projectRequests || [];
      return response;
    } catch (error) {
      profileData.error = 'Error al cargar pedidos y solicitudes';
      throw error;
    } finally {
      profileData.isLoading = false;
    }
  };

  const fetchAllProfileData = async () => {
    await Promise.all([
      fetchUserProfile(),
      fetchUserOrdersAndRequests()
    ]);
  };

  // Getters existentes (sin cambios)
  const getLoginInfo = computed(() => readonly(loginInfo));

  // Nuevos getters para datos del perfil
  const getUserProfileData = computed(() => readonly(profileData.userDetails));
  const getUserOrders = computed(() => readonly(profileData.orders));
  const getUserProjectRequests = computed(() => readonly(profileData.projectRequests));
  const getProfileLoadingState = computed(() => profileData.isLoading);
  const getProfileError = computed(() => profileData.error);

  return {
    // Métodos y getters existentes
    getLoginInfo,
    setLoginInfo,
    logout,
    
    // Nuevos métodos y getters
    fetchUserProfile,
    fetchUserOrdersAndRequests,
    fetchAllProfileData,
    getUserProfileData,
    getUserOrders,
    getUserProjectRequests,
    getProfileLoadingState,
    getProfileError
  };
}, {
  persist: {
    key: 'auth',
    paths: ['loginInfo'], // Solo persiste la info de login
    // No persistimos profileData porque son datos temporales
  }
});