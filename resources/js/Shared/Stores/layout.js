import { defineStore } from 'pinia'

export const useLayoutStore = defineStore({
    id:'layout',
    state: () => ({
        backgroundImage: 'background.jpg',
        root:   'https://sunnyrlube.com/'
    }),

    actions: {

    }
  })
