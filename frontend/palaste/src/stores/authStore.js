import { computed, reactive, readonly } from 'vue';
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', () => {
  
  const loginInfo = reactive({
    loggedIn: false,
    username: '',
    email: '',
    token: '',
  });

  const setLoginInfo = ({ loggedIn, username, email, token }) => {
    loginInfo.loggedIn = loggedIn;
    loginInfo.username = username;
    loginInfo.email = email;
    loginInfo.token = token;
  };

  const logout = () => {
    setLoginInfo({ loggedIn: false, username: '', email: '', token: '' });
  };

  const getLoginInfo = computed(() => readonly(loginInfo));

  return {
    getLoginInfo,
    setLoginInfo,
    logout
  };
}, {
  persist: true
});
