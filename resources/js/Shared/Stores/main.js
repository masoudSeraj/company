import { defineStore } from 'pinia'

export const useMainStore = defineStore('main', {
    state: () => ({
        products: {
            random: [],
            text: ''
        }
    }),
    getters: {
        dottingText: (state) => {
            console.log(state.products.text)
            // let originalWords = state.products.text.split(" ");
            // let reducedWords = state.products.text.split(" ").splice(0, 10);
            // return originalWords.length > 10 ? reducedWords.join(" ") + '...' : reducedWords.join(" ");
        }
    },
    actions: {
        randomProducts(){
            axios.get(route('product.random'))
                .then((response) => {
                    this.products.random = response.data.data
            });
        }
    }

})
