import { computed, reactive, readonly, ref } from 'vue';
import { defineStore } from 'pinia';
import { getUserProfile, getUserOrdersAndRequests } from '@/comunication_manager';

export const useAuthStore = defineStore('auth', () => {

  const loginInfo = reactive({
    loggedIn: false,
    username: '',
    email: '',
    token: '',
  });

  const profileData = reactive({
    userDetails: null,
    orders: [],
    projectRequests: [],
    isLoading: false,
    error: null,
    lastFetch: null
  });

  const setLoginInfo = ({ loggedIn, username, email, token }) => {
    loginInfo.loggedIn = loggedIn;
    loginInfo.username = username;
    loginInfo.email = email;
    loginInfo.token = token;
    
    if (!loggedIn) {
      resetProfileData();
    }
  };

  const resetProfileData = () => {
    profileData.userDetails = null;
    profileData.orders = [];
    profileData.projectRequests = [];
    profileData.error = null;
  };

  const logout = () => {
    setLoginInfo({ loggedIn: false, username: '', email: '', token: '' });
    resetProfileData();
  };

  const fetchUserProfile = async () => {
    try {
      profileData.isLoading = true;
      profileData.error = null;
      const response = await getUserProfile();
      profileData.userDetails = {
        ...response,
        created_at: response.created_at || new Date().toISOString()
      };
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
      const response = await getUserOrdersAndRequests();
      
      // Procesar pedidos
      profileData.orders = (response.orders || []).map(order => ({
        ...order,
        created_at: order.created_at || new Date().toISOString(),
        status: order.status || 'pending',
        items: order.items || [],
        total: order.total || 0
      }));
      
      // Procesar proyectos (adaptado a tu estructura)
      profileData.projectRequests = (response.projectRequests || []).map(project => ({
        id: project.id,
        project_type: project.project_type || 'other',
        description: project.description || '',
        files: project.files || [],
        status: project.status || 'pending',
        created_at: project.created_at || new Date().toISOString(),
        updated_at: project.updated_at || new Date().toISOString(),
        budget: project.budget || '',
        timeline: project.timeline || '',
        notes: project.notes || '',
        // Detalles específicos
        stairs_details: project.stairs_details || null,
        railings_details: project.railings_details || null,
        doors_details: project.doors_details || null,
        other_details: project.other_details || null
      }));
      
      return response;
    } catch (error) {
      profileData.error = 'Error al cargar pedidos y proyectos';
      throw error;
    } finally {
      profileData.isLoading = false;
      profileData.lastFetch = new Date().toISOString();
    }
  };

  const fetchAllProfileData = async () => {
    if (!loginInfo.loggedIn) return;
    
    try {
      profileData.isLoading = true;
      await Promise.all([
        fetchUserProfile(),
        fetchUserOrdersAndRequests()
      ]);
    } catch (error) {
      console.error('Error loading profile data:', error);
      throw error;
    } finally {
      profileData.isLoading = false;
    }
  };

  // Getters optimizados para ProfileView.vue
  const getLoginInfo = computed(() => readonly(loginInfo));
  const getUserProfileData = computed(() => profileData.userDetails);
  const getUserOrders = computed(() => profileData.orders);
  const getUserProjectRequests = computed(() => profileData.projectRequests);
  const getProfileLoadingState = computed(() => profileData.isLoading);
  const getProfileError = computed(() => profileData.error);
  const shouldRefreshData = computed(() => {
    if (!profileData.lastFetch) return true;
    return (new Date() - new Date(profileData.lastFetch)) > (5 * 60 * 1000); // 5 minutos
  });

  return {
    // Autenticación
    getLoginInfo,
    setLoginInfo,
    logout,
    
    // Datos de perfil
    fetchUserProfile,
    fetchUserOrdersAndRequests,
    fetchAllProfileData,
    getUserProfileData,
    getUserOrders,
    getUserProjectRequests,
    getProfileLoadingState,
    getProfileError,
    shouldRefreshData
  };
}, {
  persist: {
    key: 'auth',
    paths: ['loginInfo'],
  }
});