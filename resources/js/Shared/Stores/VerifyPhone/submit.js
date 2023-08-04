import { defineStore } from "pinia";
import { routes } from '@/Shared/routes.js'
import axios from 'axios';

export const useSubmitStore = defineStore("submit", {
    state: () => ({
        isSubmitting: false,
    }),

    actions: {
        async submit(code, userId, redirection) {
            return axios.post(
                routes().verification.submit.path, 
                { 
                    code:   code,
                    userId: userId,
                    redirection: redirection
                })
                .then(response => {
                    return response
                })
        },

        submitting(){
            this.isSubmitting = true;
        },
        
        submitted(){
            this.isSubmitting = false;
        }
    }
});