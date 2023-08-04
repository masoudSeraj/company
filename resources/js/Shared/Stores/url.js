import { defineStore } from "pinia";

export const useUrlStore = defineStore('url', {
    url: '',

    getters: {
        queryParameters: (store) => {
            return store.url.searchParams;
        },
    },

    actions:{
        setUrl(url){
            this.url = new URL(url);
        }
    }
})