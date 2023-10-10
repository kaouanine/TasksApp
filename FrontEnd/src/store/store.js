
import { createStore } from 'vuex';

const store = createStore({
  state: {
    authToken: null,
  },
  mutations: {
    setAuthToken(state, token) {
      state.authToken = token;
    },
    clearAuthToken(state) {
      state.authToken = null;
    },
  },
  actions: {
  },
  getters: {
    isAuthenticated: (state) => !!state.authToken,
  },
});

export default store;
