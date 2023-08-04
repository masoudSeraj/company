import { defineStore } from 'pinia'
import { routes } from '@/Shared/routes.js'
import axios from 'axios';


export const useRequestStore = defineStore('request', {
    
    state: () => ({
        disabled: true,
        response: null,
    }),

    actions: {
         async request(userId) {     
            const response = await axios
                .get(routes().verification.request.path + '/' + userId)
            return response;
        },
        enableRequest(){
            this.disabled = false;
        },
        disableRequest(){
            this.disabled = true;
        },
    },

})