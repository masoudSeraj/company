import { defineStore } from "pinia";

export const useTimerStore = defineStore("timer", { 
    state: () => ({
        timer: null,
        totalMilliseconds: null,
    }),

    actions: {
        async countdown(totalMilliseconds){
             this.totalMilliseconds = await totalMilliseconds;
        },

        resetTimer() {
            this.timer = null;
        },

        setTimer(timer)
        {
            this.timer = timer || 2 * 60 * 1000;
        }
    }
 });