import { ref, computed, reactive } from 'vue'

import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', () => {

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


  const getLoginInfo = computed(() => loginInfo);

  return {
    getLoginInfo, loginInfo, setLoginInfo,

  }
}, {
  persist: true
})
