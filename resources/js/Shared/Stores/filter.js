import { defineStore } from 'pinia'
import { router } from '@inertiajs/vue3'

export const useFilterStore = defineStore({
    id:'filter',
    
    state: () => ({
        checkSelection: [],
        checkSelectionBrand: [],
        checkboxWatcher: [],
        checkedIds: null,
        sort: null,
        search: null,
        toggler: false,
        url: '',
        searchQuery: null,
        isCategoryBoxHidden: true
    }),

    getters: {
        decodeHTMLEntities: () => {
            return (text) => {
                let textArea = document.createElement('textarea');
                textArea.innerHTML = text;
                return textArea.value;
            }
        },

        currentUrl(){
            return window.location.href;
        },

        currentSearchParams()
        {
            return (new URL(this.url)).searchParams;
        },

        searchQueryExists() {
            return this.url ? !!this.currentSearchParams.get('search') : false;
        },

        checkSelectionQueryExists() {
            return this.url ? !!this.currentSearchParams.get('checkSelection') : false;
        },

        selectionCount()
        {
            return this.checkSelection.length
        },

        checkedValue: (store) => {
            return (id) => {
                return !!store.checkSelection?.find(element => element.id == id)
            }
        },

        checkedValueBrand:(store) =>  {
            return (id) => {
                return !!store.checkSelectionBrand?.find(element => element.id == id)
            }
        }
    },

    actions: {
        updateFilter(){
            const uri = this.checkSelection?.map((check)=>{
                return check.id
            });

            const brandUri = this.checkSelectionBrand?.map((check)=> check.id)

            router.get("/filters/products?checkSelection=" + uri + "&checkSelectionBrand=" + brandUri, 
            {
                'sort'  :   this.sort,
                'search'    :   this.search
            },
            {
                preserveState: true,
            },)
        },

        updateSort(sort)
        {
            this.sort = sort
        },

        searchText(textSearch)
        {
            this.search = textSearch
        },

        filterTogller()
        {
            this.toggler = !this.toggler;
        },

        closeLeft()
        {
            this.toggler = false;
        },

        setCurrentUrl(url)
        {
            this.url = url
        },

        removeCategory(categoryId)
        {
            this.checkSelection.splice(this.checkSelection.findIndex(element => element.id === categoryId), 1)
            localStorage.removeItem(categoryId)
            this.updateFilter();
        },

        showCategoryBox()
        {
            this.isCategoryBoxHidden = false;
        },

        hideCategoryBox()
        {
            this.isCategoryBoxHidden = true;
        },

        setCheckSelection(selectionObject){
            this.checkSelection.push(selectionObject);
        },

        setCheckSelectionBrand(selectionObject){
            this.checkSelectionBrand.push(selectionObject);
        },

        removeCheckSelection(categoryId)
        {
            this.checkSelection.splice(this.checkSelection.findIndex(element => element.id === categoryId), 1)
        },

        removeCheckSelectionBrand(brandId)
        {
            this.checkSelectionBrand.splice(this.checkSelectionBrand.findIndex(element => element.id === brandId), 1)
        },
        
        flushSelection()
        {
            this.checkSelection = [];
            this.checkSelectionBrand = [];
        },
        setCheckboxWatcher(checkboxWatcher)
        {
            this.checkboxWatcher = checkboxWatcher
        }
    }
  })